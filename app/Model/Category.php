<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // The attributes that are mass assignable.
    protected $fillable = [
        'category_name'
    ];
}
