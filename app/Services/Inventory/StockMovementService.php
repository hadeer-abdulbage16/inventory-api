<?php

namespace App\Services\Inventory;

use App\Models\Inventory\StockMovement;
use App\Models\Inventory\Product;
use App\Models\Inventory\ProductStock;
use Illuminate\Support\Facades\Cache;



class StockMovementService
{
    private $cacheTag = 'StockMovement';

    public function list($show_all = false , int $page = 1)
    {
        $cacheKey = $show_all ? "Movement_all" : "Movement_page_{$page}";

        return $query = Cache::remember($cacheKey, 3600 , function () use ($show_all) {
            $query = StockMovement::with('product');
            return $show_all ? $query->get() : $query->paginate(10); 
            
        });
    }


    public function record( array $data) 
    {
        $product = Product::lockForUpdate()->findOrFail($data['product_id']);

        $beforQty = (float) $product->qty;
        $afterQty = $data['movement'] == 'in' 
        ? $beforQty + $data['qty']
        : $beforQty - $data['qty'] ;


        $beforStorqty = 0;
        $afterStorqty = 0;

        if(!empty($data['product_id']))
            {
                $product_stock = ProductStock::where('product_id' , $data['product_id'])
                ->lockForUpdate()->first();
            }

        if(!empty($product_stock))
            {
                $beforStorqty = $product_stock->qty;
                $afterStorqty = $data['movement'] == 'in'
                ? $beforStorqty + $data['qty']
                : $beforStorqty - $data['qty'];
            }    

        $stock_movement = StockMovement::create([
            'product_id' => $data['product_id'],
            'ref_id' => $data['ref_id'],
            'movement' => $data['movement'],
            'qty' => $data['qty'],
            'ref_number' => $data['ref_number'],
            'ref_type' => $data['ref_type'],
            'before_qty' => $beforQty,
            'after_qty' => $afterQty,
            'before_qty_store_wise' => $beforStorqty,
            'after_qty_store_wise' => $afterStorqty,
            'cost_price' => $data['cost_price'],
            'notes' => $data['notes']
        ]);  
        
        Cache::forget('Movement_all');

        return $stock_movement;
            
    }


}