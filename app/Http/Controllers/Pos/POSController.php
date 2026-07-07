<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class POSController extends Controller
{
    // =========================
    // POS PAGE
    // =========================
    public function index(
        Request $request
    ) {

        // LOGIN
        if (!auth()->check()) {

            return redirect('/login');
        }

        // ONLY CASHIER
        if (
            auth()->user()->role
            !== 'kasir'
        ) {

            abort(
                403,
                'Akses hanya untuk kasir'
            );
        }

        // =========================
        // FILTER
        // =========================
        $category =
            $request->category;

        $search =
            $request->search;

        // =========================
        // PRODUCT FILTER
        // =========================
        $products = Product::with(

            ['recipes.inventory']

        )->when(

            $category &&
            $category != 'all',

            function ($query)
            use ($category) {

                $query->where(
                    'category_id',
                    $category
                );
            }

        )->when(

            $search,

            function ($query)
            use ($search) {

                $query->where(
                    'name',
                    'like',
                    "%{$search}%"
                );
            }

        )->get();

        // =========================
        // TOTAL CART
        // =========================
        $total = 0;

        foreach (

            session('cart', [])

            as $item

        ) {

            $total +=

                $item['price']

                *

                $item['qty'];
        }

        // =========================
        // RECEIPT DATA
        // =========================
        $order = null;

        $items = [];

        if (session('last_order_id')) {

            $order = Order::find(
                session('last_order_id')
            );

            if ($order) {

                $items = OrderItem::where(
                    'order_id',
                    $order->id
                )->get();
            }
        }

        // =========================
        // RETURN VIEW
        // =========================
        return view(

            'kasir.pos',

            compact(

                'products',

                'category',

                'search',

                'total',

                'order',

                'items'
            )
        );
    }
}