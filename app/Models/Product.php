<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'price'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function sell($qty = 1)
    {
        foreach ($this->recipes as $recipe) {
            $inventory = $recipe->inventory;

            $inventory->stock -= ($recipe->quantity * $qty);
            $inventory->save();
        }
    }
}