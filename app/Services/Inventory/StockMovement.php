<?php

namespace App\Services\Inventory;

use App\Models\Inventory\StockMovement;
use Illuminate\Support\Facades\Cache;



class StockMovementService
{
    private $cacheTag = 'StockMovement';

    public function list($show_all = false , int $page = 1)
    {
        $cacheKey = $show_all ? "Movement_all" : "Movement_page_{$page}"

        return $query = Cache::remember($cacheKey, 3600 , function () use ($show_all) {
            $query = StockMovement::with('product');
            return $show_all ? $query->get() : $query->paginate(10); 
            
        });
    }


}