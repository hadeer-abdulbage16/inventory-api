<?php

namespace App\Services\Transactions;


use App\Models\Transactions\Purchase;
use App\Models\Transactions\PurchaseItem;
use App\Events\Api\Transactions\PurchaseCompletedEvent;


class PurchaseService{
     public function list( $show_all = false , int $page =1)
     {
        $cacheKey = $show_all ? "purchase_all" : "purchase_page_{$page} ";

        return Cache::remember($cacheKey, 3600, function () use ($show_all) {
            $query = Purchase::with('items');
            return $show_all ? $query : $query->paginate(10);
            
        });


     }
    public function store(array $data)
    {
      return DB::transaction(function () use ($data) {
            $total = collect($data[$items]->sum(function ($data){
                return $items['qty'] * $items['price'];
            }));
        
          // create purchase data 
            $purchase = Purchase::create([
             'invoice_number' => $data['invoice_number'],
             'invoice_date' => $data['invoice_date'],
             'total_amount' => $total ,
             'notes' => $data['notes']
            ]);

           // create item 
            foreach($data['items'] as $items)
            {
                $purchase->items()->create([
                    'product_id' => $items['product_id'],
                    'product_code' => $items['product_code'],
                    'product_name' => $items['product_name'],
                    'barcode' => $items['barcode'],
                    'qty' => $items['qty'],
                    'expiry_date' => $items['expiry_date'],
                    'price' => $items['price'],
                    'purchase_id' => $purchase->id
                ]);

            }
            event(new PurchaseEvent($purchase));

            // listen at stock 
            foreach ($data['items'] as $item)
                {
                    event(new PurchaseCompletedEvent(
                        productId: $item['product_id'],
                        purchaseId: $purchase->id,
                        qty: $item['qty'],
                        costPrice: $purchase->total_amount,
                        refNumber: $purchase->invoice_number,
                        notes: $purchase->notes

                    ));
                }





            return $purchase->load('items.product');
      });


    }





}