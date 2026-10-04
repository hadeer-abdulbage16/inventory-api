<?php

namespace App\Services\Transactions;


use App\Models\Transactions\Sale;
use App\Models\Transactions\SaleItem;
use App\Events\Api\Transactions\SaleEvent;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class SaleService {
    public function list($show_all = false , int $page = 1)
    {
        $cacheKey = $show_all ? "sale_all" : "sale_page_{{$page}}";

        return Cache::remember( $cacheKey , 3600, function () use ($show_all) {
            $query = Sale::with('items');
            return $show_all ? $query : $query->paginate(10);
            
        });

    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $total = collect($data['items'])->sum(function ($item){
                return $item['qty'] * $item['price'];
            });

             // create sale data 
            $sale = Sale::create([
             'invoice_number' => $data['invoice_number'],
             'invoice_date' => $data['invoice_date'],
             'total_amount' => $total ,
             'notes' => $data['notes']
            ]);

         // create item 
           foreach($data['items'] as $items)
            {
                $sale->items()->create([
                    'product_id' => $items['product_id'],
                    'product_code' => $items['product_code'],
                    'product_name' => $items['product_name'],
                    'barcode' => $items['barcode'],
                    'qty' => $items['qty'],
                    'expiry_date' => $items['expiry_date'],
                    'price' => $items['price'],
                    'sale_id' => $sale->id
                ]);

            } 

            foreach ($data['items'] as $items)
                {
                    event (new SaleEvent( 
                        productId: $items['product_id'],
                        saleId: $sale->id,
                        qty: $items['qty'],
                        costPrice: $items['price'],
                        refNumber: $sale->invoice_number,
                        notes: $sale->notes
                       
                    ));
                }
            return $sale->load('items.product');   
        });


       
    }

}