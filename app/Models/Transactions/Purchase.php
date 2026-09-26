<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transactions\PurchaseItem;

class Purchase extends Model
{
    //
    protected $guarded = [];
    
    public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }
}
