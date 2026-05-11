<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;

use App\Models\Order;

class KitchenController extends Controller
{
    // =========================
    // KITCHEN PAGE
    // =========================
    public function index()
    {

        $orders = Order::where(
            'status',
            'pending'
        )

        ->latest()

        ->get();

        return view(

            'kitchen.index',

            compact(
                'orders'
            )
        );
    }

    public function done($id)
{
    $order = Order::findOrFail($id);

    $order->update([

        'status' =>
            'completed'
    ]);

    return redirect()->back();
}

}