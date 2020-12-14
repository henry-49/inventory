<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    // The attributes that are mass assignable.
    protected $fillable = [
        'details', 'amount',
    ];
}
