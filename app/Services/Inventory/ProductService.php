<?php

namespace App\Services\Inventory;

use App\Models\Inventory\Product;
use App\Models\Inventory\Category;
use Illuminate\Support\Facades\Cache;


class ProductService{

    private string $cacheTag = 'products';
    public function list(  $show_all = false , int $page =1)
    {
        $cacheKey = $show_all ? "product_all" : "product_page_{$page} ";
        return Cache::remember($cacheKey, 3600, function () use ($show_all) {
            $query = Product::with('category');
            return $show_all ? $query->get() : $query->paginate(10);
            
        });
    }

    public function store(array $data)
    {
        $product = Product::Create($data);

        $this->clearCache();
        return $data ;
    }

    public function update(int $id , array $data)
    {
        $product = Product::findOrfail($id);
        $product->update($data);

        Cache::forget("product_{$id}");
        $this->clearCache();

        return $data;
    }

    public function delete(int $id)
    {
        $product = Product::findOrfail($id);

        Cache::forget("product_{$id}");
        $this->clearCache();

        return $product->delete();

    }

    public function search(array $filters)
    {
        $query = Product::query();

        if ($filters['name'] ?? null)
            {
                $query->where('name','like' , '%'.$filters['name'].'%');
            }
        if ($filters['code'] ?? null)
            {
                $query->where('code','like' , '%'.$filters['code'].'%');
            }
        $product = $query->paginate(10);
        return $product;
    }

    public function clearCache()
    {
        Cache::tags('Products')->flush();
    }    


}