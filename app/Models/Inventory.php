<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [

        'ingredient_code',

        'name',

        'category',

        'stock',

        'unit',

        'min_stock'
    ];
}