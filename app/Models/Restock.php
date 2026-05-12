<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restock
extends Model
{
    protected $fillable = [

        'inventory_id',

        'supplier_id',

        'qty',

        'price',

        'total',

    ];


    // =========================
    // INVENTORY RELATION
    // =========================
    public function inventory()
    {
        return $this->belongsTo(

            Inventory::class

        );
    }


    // =========================
    // SUPPLIER RELATION
    // =========================
    public function supplier()
    {
        return $this->belongsTo(

            Supplier::class

        );
    }
}