<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Product;

class CartController extends Controller
{
    // =========================
    // ADD TO CART
    // =========================
    public function addToCart(
        Request $request
    ) {

        // PRODUCT
        $product = Product::findOrFail(
            $request->product_id
        );

        // CART
        $cart = session()->get(
            'cart',
            []
        );

        // CEK PRODUCT
        if (isset($cart[$product->id])) {

            $cart[$product->id]['qty']++;

        } else {

            $cart[$product->id] = [

                'id' =>
                    $product->id,

                'name' =>
                    $product->name,

                'price' =>
                    $product->price,

                'qty' =>
                    1,

                'image' =>
                    $product->image
            ];
        }

        // SAVE SESSION
        session()->put(
            'cart',
            $cart
        );

        return redirect()->back();
    }

    // =========================
    // INCREASE QTY
    // =========================
    public function increaseQty(
        Request $request
    ) {

        $cart = session()->get(
            'cart',
            []
        );

        $id = $request->product_id;

        if (isset($cart[$id])) {

            $cart[$id]['qty']++;

            session()->put(
                'cart',
                $cart
            );
        }

        return redirect()->back();
    }

    // =========================
    // DECREASE QTY
    // =========================
    public function decreaseQty(
        Request $request
    ) {

        $cart = session()->get(
            'cart',
            []
        );

        $id = $request->product_id;

        if (isset($cart[$id])) {

            $cart[$id]['qty']--;

            // HAPUS JIKA 0
            if (
                $cart[$id]['qty']
                <= 0
            ) {

                unset($cart[$id]);
            }

            session()->put(
                'cart',
                $cart
            );
        }

        return redirect()->back();
    }

    // =========================
    // UPDATE QTY (MANUAL INPUT / +/-)
    // =========================
    public function updateQty(
        Request $request
    ) {

        $cart = session()->get(
            'cart',
            []
        );

        $id = $request->product_id;

        if (!isset($cart[$id])) {

            return redirect()->back();
        }

        // MANUAL INPUT QTY
        if ($request->has('qty')) {

            $qty = (int) $request->qty;

            if ($qty < 1) $qty = 1;
            if ($qty > 99) $qty = 99;

            $cart[$id]['qty'] = $qty;
        }

        // INCREASE
        if ($request->action === 'increase') {

            $cart[$id]['qty']++;
        }

        // DECREASE
        if ($request->action === 'decrease') {

            $cart[$id]['qty']--;
        }

        // HAPUS JIKA 0
        if ($cart[$id]['qty'] <= 0) {

            unset($cart[$id]);
        }

        session()->put(
            'cart',
            $cart
        );

        return redirect()->back();
    }

    // =========================
    // REMOVE ITEM
    // =========================
    public function removeItem(
        Request $request
    ) {

        $cart = session()->get(
            'cart',
            []
        );

        $id = $request->product_id;

        if (isset($cart[$id])) {

            unset($cart[$id]);

            session()->put(
                'cart',
                $cart
            );
        }

        return redirect()->back();
    }
}