<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\OrderItem;
use App\Models\Product;

class Order extends Model
{
    protected $fillable = [

        'order_number',

        'total_amount',

        'payment_method',

        'status',

        'customer_name'
    ];

    // =========================
    // RELATION ITEMS
    // =========================
    public function items()
    {
        return $this->hasMany(
            OrderItem::class
        );
    }

    // =========================
    // CREATE ORDER
    // =========================
    public static function createOrder($items)
    {
        $order = self::create([

            'order_number' =>
                'INV-' . rand(100, 999),

            'total_amount' =>
                0,

            'status' =>
                'completed'
        ]);

        $total = 0;

        foreach ($items as $item) {

            $product = Product::find(
                $item['product_id']
            );

            OrderItem::create([

                'order_id' =>
                    $order->id,

                'product_id' =>
                    $product->id,

                'qty' =>
                    $item['qty'],

                'price' =>
                    $product->price
            ]);

            $product->sell(
                $item['qty']
            );

            $total +=

                $product->price

                *

                $item['qty'];
        }

        $order->update([

            'total_amount' =>
                $total
        ]);

        return $order;
    }
}