<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    // The attributes that are mass assignable.
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'photo', 'shopname'
    ];
}
