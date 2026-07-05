<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // =========================
    // PROFILE PAGE
    // =========================
    public function index()
    {
        $user = auth()->user();

        $orders = Order::with('items.product')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('customer.profile', compact('user', 'orders'));
    }

    // =========================
    // UPDATE PROFILE
    // =========================
    public function update(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $user = auth()->user();

        $user->update([
            'name'    => $request->name,
            'phone'   => $request->phone,
            'address' => $request->address,
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }

    // =========================
    // ORDER DETAIL
    // =========================
    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.product');

        return view('customer.order-detail', compact('order'));
    }

    // =========================
    // REVIEW / RATING (NO COMMENT VERSION)
    // =========================
    public function review(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        foreach ($order->items as $item) {

            Review::create([
                'user_id' => auth()->id(),
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'rating' => $request->rating,
            ]);

        }

        return back()->with('success', 'Rating berhasil dikirim!');
    }
}