<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // The attributes that are mass assignable.
    protected $fillable = [
        'category_id', 
        'product_name', 
        'product_code', 
        'root', 
        'buying_price', 
        'selling_price', 
        'supplier_id', 
        'buying_date', 
        'image', 
        'product_quantity'
        									
    ];
}
