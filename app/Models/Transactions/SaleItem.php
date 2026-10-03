<?php

namespace App\Models\Transactions;
use App\Models\Inventory\ProductStock;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    //
    protected $guarded = [];


    public function product()
    {
        return $this->belongsTo(ProductStock::class);
    }
}
