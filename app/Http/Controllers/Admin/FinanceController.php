<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\OrderItem;

class FinanceController extends Controller
{
    public function index()
    {
        // =========================
        // TODAY REVENUE
        // =========================
        $todayRevenue = Order::whereDate(
            'created_at',
            today()
        )->sum('total_amount');

        // =========================
        // MONTHLY REVENUE
        // =========================
        $monthlyRevenue = Order::whereMonth(
            'created_at',
            now()->month
        )->sum('total_amount');

        // =========================
        // TOTAL ORDERS TODAY
        // =========================
        $todayOrders = Order::whereDate(
            'created_at',
            today()
        )->count();

        // =========================
        // TOTAL ORDERS MONTH
        // =========================
        $monthlyOrders = Order::whereMonth(
            'created_at',
            now()->month
        )->count();

        // =========================
        // BEST SELLER
        // =========================
        $bestSeller = OrderItem::selectRaw(
                'product_id, SUM(qty) as total_qty'
            )
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->with('product')
            ->first();

        // =========================
        // RECENT TRANSACTIONS
        // =========================
        $recentOrders = Order::latest()
            ->take(10)
            ->get();

        return view(
            'admin.finance',
            compact(
                'todayRevenue',
                'monthlyRevenue',
                'todayOrders',
                'monthlyOrders',
                'bestSeller',
                'recentOrders'
            )
        );
    }
}