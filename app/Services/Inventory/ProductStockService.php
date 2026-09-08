<?php

namespace App\Services\Inventory;

use App\Models\Inventory\ProductStock;
use Illuminate\Support\Facades\Cache;


class ProductStockService {
    private $cacheTag = 'productStock';

    public function list( $show_all = false , int $page =1)
    {
        $cacheKey = $show_all ? "product_all" : "product_page_{$page}";

        return $query = Cache::remember( $cacheKey , 3600, function () use($show_all) {
          $query = ProductStock::with('product');
          return $show_all ? $query->get() : $query->paginate(10); 
            
        });

    }

    public function store(array $data)
    {
        $productStock = ProductStock::create($data);
        $this->clearCache();
        return $productStock;
    }

    public function update(array $data , int $id)
    {
        $productStock = ProductStock::findOrFail($id);
        $productStock->update($data);
        
        Cache::forget("product_{$id}");
        return $productStock ;
    }

    public function delete($id)
    {
        $productStock = ProductStock::findOrFail($id);
        return $productStock->delete(); ;
       $this->clearCache();
    }

    public function search(array $filters)
    {
        $query = ProductStock::query();

        if ($filters['product_name'] ?? null)
            {
                $query->where('product_name','like' , '%'.$filters['product_name'].'%');
            }
        if ($filters['product_code'] ?? null)
            {
                $query->where('product_code','like' , '%'.$filters['product_code'].'%');
            }
        $productStock = $query->paginate(10);
        return $productStock;
    }

    public function clearCache()
    {
         Cache::tags('Product_stocks')->flush();
    } 


}

