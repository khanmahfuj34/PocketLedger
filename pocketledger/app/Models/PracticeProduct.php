<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PracticeProduct extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'stock_quantity'
    ];
}
