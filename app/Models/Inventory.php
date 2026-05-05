<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = ['name', 'stock', 'unit', 'min_stock'];
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}