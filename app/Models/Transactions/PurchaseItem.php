<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory\ProductStock;
use App\Models\Transactions\PurchaseInvoice;

class PurchaseItem extends Model
{
    //
    protected $guarded = [];

    public function purchaseInvoice()
    {
        return $this->belongsTo(PurchaseInvoice::class);
    }

    public function product()
    {
        return $this->belongsTo(ProductStock::class);
    }
}
