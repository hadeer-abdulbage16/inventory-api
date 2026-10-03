<?php

namespace App\Models\Transactions;

use App\Models\Transactions\SaleItem;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
    protected $guarded = [];
    
    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }
}
