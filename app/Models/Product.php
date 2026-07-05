<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\Review;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'price',
        'category',
    ];

    // =========================
    // CATEGORY RELATION
    // =========================
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // =========================
    // RECIPES RELATION
    // =========================
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    // =========================
    // REVIEWS RELATION
    // =========================
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // =========================
    // RATING AVERAGE (SAFE FIX)
    // =========================
    public function getRatingAttribute()
    {
        $avg = $this->reviews()->avg('rating');

        return $avg ? round($avg, 1) : 0;
    }

    public function getRatingCountAttribute()
    {
        return $this->reviews()->count();
    }

    // =========================
    // STEP 1 - STOCK (SAFE FIX)
    // =========================
    public function getStockAttribute()
    {
        if (!$this->relationLoaded('recipes')) {
            return 0;
        }

        return $this->recipes->sum(function ($recipe) {
            return optional($recipe->inventory)->stock ?? 0;
        });
    }

    // =========================
    // STOCK STATUS (STEP 2 READY)
    // =========================
    public function getStockStatusAttribute()
    {
        $stock = $this->stock;

        if ($stock <= 0) {
            return 'out';
        }

        if ($stock <= 5) {
            return 'low';
        }

        return 'safe';
    }

    // =========================
    // AUTO REDUCE STOCK
    // =========================
    public function sell($qty = 1)
    {
        foreach ($this->recipes as $recipe) {

            $inventory = $recipe->inventory;

            if ($inventory) {
                $inventory->stock -= ($recipe->quantity * $qty);
                $inventory->save();
            }
        }
    }
}