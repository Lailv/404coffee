<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
class CustomerController extends Controller
{
    public function home()
    {
        return view('customer.home');
    }

    public function menu()
    {
        $coffeeProducts = Product::whereHas(

            'category',

            function ($query) {

                $query->where('name', 'Coffee');

            }

        )->latest()->get();

        $nonCoffeeProducts = Product::whereHas(

            'category',

            function ($query) {

                $query->where('name', 'Non Coffee');

            }

        )->latest()->get();

        $foodProducts = Product::whereHas(

            'category',

            function ($query) {

                $query->where('name', 'Food');

            }

        )->latest()->get();

        return view(

            'customer.menu',

            compact(

                'coffeeProducts',
                'nonCoffeeProducts',
                'foodProducts'

            )

        );
    }

    public function cart()
    {
        return view('customer.cart');
    }

    public function checkout()
    {
        return view('customer.checkout');
    }

    public function storeOrder(Request $request)
    {
        $request->validate([

            'order_type' => 'required',

            'customer_name' => 'required',

            'customer_phone' => 'required',

            'payment_method' => 'required',

        ]);

        $cart = session()->get('cart', []);

        if (count($cart) <= 0) {

            return back()->with(

                'error',

                'Cart is empty.'

            );
        }

        $total = 0;

        foreach ($cart as $item) {

            $total += $item['price'] * $item['qty'];
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE ORDER
        |--------------------------------------------------------------------------
        */

        $order = Order::create([

            'user_id' => auth()->id(),

            'order_number' => 'ORD-' . time(),

            'total_amount' => $total,

            'status' => 'pending',

            'payment_method' => $request->payment_method,

            'customer_name' => $request->customer_name,

            'customer_phone' => $request->customer_phone,

            'customer_address' => $request->customer_address,

            'notes' => $request->notes,

            'order_type' => $request->order_type,

        ]);

        /*
        |--------------------------------------------------------------------------
        | CREATE ORDER ITEMS
        |--------------------------------------------------------------------------
        */

        foreach ($cart as $item) {

            OrderItem::create([

                'order_id' => $order->id,

                'product_id' => $item['id'],

                'qty' => $item['qty'],

                'price' => $item['price'],

                'note' => null,

            ]);
        }

        /*
/*
|--------------------------------------------------------------------------
| PAYMENT FLOW
|--------------------------------------------------------------------------
*/

if ($request->payment_method == 'cash') {

    $order->update([

        'status' => 'paid'

    ]);

    session()->forget('cart');

    return redirect()

        ->route('customer.menu')

        ->with(

            'success',

            'Order placed successfully.'

        );
}

return redirect()->route(

    'customer.payment',

    $order

);
    }

    public function addToCart(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {

            $cart[$product->id]['qty']++;

        } else {

            $cart[$product->id] = [

                'id' => $product->id,

                'name' => $product->name,

                'price' => $product->price,

                'qty' => 1,

            ];
        }

        session()->put('cart', $cart);

        return back()->with(

            'success',

            'Product added to cart.'

        );
    }

    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {

            $action = $request->action;

            if ($action === 'increase') {

                $cart[$id]['qty']++;

            }

            if ($action === 'decrease') {

                $cart[$id]['qty']--;

                if ($cart[$id]['qty'] <= 0) {

                    unset($cart[$id]);
                }
            }

            session()->put('cart', $cart);
        }

        return back();
    }

    public function removeCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {

            unset($cart[$id]);

            session()->put('cart', $cart);
        }

        return back()->with(

            'success',

            'Product removed from cart.'

        );
    }
}