<?php

namespace App\Models\Inventory;
use App\Models\Inventory\Category;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $guarded = [];

    public function category()
    {
       return $this->belongsTo(category::Class , 'category_id');
    }
}
