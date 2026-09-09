<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{

    //
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
