<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // TAMBAH INI
use App\Models\Product;
use App\Models\Order; // TAMBAH INI

class POSController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('pos', compact('products'));
    }

    public function store(Request $request)
    {
        Order::createOrder([
            [
                'product_id' => $request->product_id,
                'qty' => $request->qty
            ]
        ]);

        return redirect('/pos');
    }
}