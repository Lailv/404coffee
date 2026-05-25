<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'customer')
            ->latest()
            ->get();

        $totalCustomer = $customers->count();

        $activeCustomer = $customers
            ->where('status', 'active')
            ->count();

        $newCustomer = $customers
            ->where(
                'created_at',
                '>=',
                now()->startOfMonth()
            )
            ->count();

        $totalRevenue = $customers->sum('total_spending');

        return view(
            'admin.customer.index',
            compact(
                'customers',
                'totalCustomer',
                'activeCustomer',
                'newCustomer',
                'totalRevenue'
            )
        );
    }
}