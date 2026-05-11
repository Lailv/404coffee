<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use App\Models\Order;
use App\Models\Inventory;

class DashboardController extends Controller
{
    // =========================
    // DASHBOARD
    // =========================
    public function dashboard()
    {
        // LOGIN CHECK
        if (!auth()->check()) {

            return redirect('/login');
        }

        // ADMIN ONLY
        if (auth()->user()->role !== 'admin') {

            abort(403);
        }

        // DATE
        $today = today()->toDateString();

        $yesterday = today()
            ->subDay()
            ->toDateString();

        // =========================
        // REVENUE
        // =========================
        $todayRevenue = Order::whereDate(
            'created_at',
            $today
        )->sum('total_amount') ?? 0;

        $yesterdayRevenue = Order::whereDate(
            'created_at',
            $yesterday
        )->sum('total_amount') ?? 0;

        $revenueGrowth =
            $yesterdayRevenue > 0

            ? round(
                (
                    ($todayRevenue - $yesterdayRevenue)
                    /
                    $yesterdayRevenue
                ) * 100,
                1
            )

            : 0;

        // =========================
        // ORDERS
        // =========================
        $todayOrders = Order::whereDate(
            'created_at',
            $today
        )->count();

        $yesterdayOrders = Order::whereDate(
            'created_at',
            $yesterday
        )->count();

        $orderGrowth =
            $todayOrders -
            $yesterdayOrders;

        // =========================
        // CRITICAL STOCK
        // =========================
        $criticalStocks = Inventory::whereColumn(
            'stock',
            '<=',
            'min_stock'
        )->count();

        // =========================
        // RECENT ORDERS
        // =========================
        $recentOrders = Order::latest()
            ->take(5)
            ->get();

        // =========================
        // MONTHLY REVENUE
        // =========================
        $monthlyData = Order::selectRaw(
                "
                DATE_FORMAT(created_at, '%b') as month,
                DATE_FORMAT(created_at, '%Y-%m') as month_key,
                SUM(total_amount) as total
                "
            )

            ->where(
                'created_at',
                '>=',
                now()
                    ->subMonths(6)
                    ->startOfMonth()
            )

            ->groupByRaw(
                "
                DATE_FORMAT(created_at, '%Y-%m'),
                DATE_FORMAT(created_at, '%b')
                "
            )

            ->orderByRaw(
                "
                DATE_FORMAT(created_at, '%Y-%m')
                "
            )

            ->get();

        $monthlyLabels = $monthlyData
            ->pluck('month')
            ->toArray();

        $monthlyRevenue = $monthlyData
            ->pluck('total')
            ->map(fn($value) => (int) $value)
            ->toArray();

        // =========================
        // TOP PRODUCTS
        // =========================
        $topProductsRaw = DB::table('order_items')

            ->join(
                'products',
                'order_items.product_id',
                '=',
                'products.id'
            )

            ->selectRaw(
                '
                products.name,
                SUM(order_items.qty) as total_qty
                '
            )

            ->groupBy(
                'products.id',
                'products.name'
            )

            ->orderByDesc('total_qty')

            ->limit(5)

            ->get();

        $maxQty =
            $topProductsRaw->max(
                'total_qty'
            ) ?: 1;

        $topProducts = $topProductsRaw
            ->map(fn($item) => (object) [

                'name' =>
                    $item->name,

                'percentage' =>
                    round(
                        (
                            $item->total_qty
                            /
                            $maxQty
                        ) * 100
                    )
            ]);

        return view(
            'admin.dashboard',
            compact(
                'todayRevenue',
                'todayOrders',
                'criticalStocks',
                'recentOrders',
                'revenueGrowth',
                'orderGrowth',
                'monthlyLabels',
                'monthlyRevenue',
                'topProducts'
            )
        );
    }
}