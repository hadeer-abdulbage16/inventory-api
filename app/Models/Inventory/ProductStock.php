<?php

namespace App\Models\Inventory;


use App\Models\Inventory\Product;
use Illuminate\Database\Eloquent\Model;


class ProductStock extends Model
{
    //
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
