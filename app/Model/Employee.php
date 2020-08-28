<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // The attributes that are mass assignable.
    protected $fillable = [
        'name', 'email', 'phone', 'salary', 'address', 'nid', 'joining_date'
    ];
}
