<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product
extends Model
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
        return $this->belongsTo(

            Category::class

        );
    }


    // =========================
    // RECIPES RELATION
    // =========================
    public function recipes()
    {
        return $this->hasMany(

            Recipe::class

        );
    }


    // =========================
    // AUTO REDUCE STOCK
    // =========================
    public function sell(
        $qty = 1
    )
    {
        foreach (

            $this->recipes

            as $recipe

        ) {

            $inventory =

                $recipe->inventory;


            $inventory->stock -= (

                $recipe->quantity

                *

                $qty

            );

            $inventory->save();
        }
    }
}