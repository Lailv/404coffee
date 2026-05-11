@extends('admin.layouts.app')

@section('title', 'Finance')

@section('content')

<link rel="stylesheet"
      href="{{ asset('css/admin/finance.css') }}">

<div class="finance-page">

    <!-- HEADER -->
    <div class="finance-header">

        <div>

            <h1>
                Finance Overview
            </h1>

            <p>
                Monitor revenue, transactions, and business performance
            </p>

        </div>

        <div class="finance-badge">

            ERP Finance System

        </div>

    </div>

    <!-- STATS -->
    <div class="finance-stats">

        <!-- TODAY REVENUE -->
        <div class="finance-card">

            <span>
                Today's Revenue
            </span>

            <h2>

                Rp {{ number_format($todayRevenue, 0, ',', '.') }}

            </h2>

        </div>

        <!-- MONTHLY REVENUE -->
        <div class="finance-card">

            <span>
                Monthly Revenue
            </span>

            <h2>

                Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}

            </h2>

        </div>

        <!-- TODAY ORDERS -->
        <div class="finance-card">

            <span>
                Orders Today
            </span>

            <h2>

                {{ $todayOrders }}

            </h2>

        </div>

        <!-- MONTHLY ORDERS -->
        <div class="finance-card">

            <span>
                Orders This Month
            </span>

            <h2>

                {{ $monthlyOrders }}

            </h2>

        </div>

    </div>

    <!-- BEST SELLER -->
    <div class="best-seller-card">

        <div class="best-header">

            <h2>
                Best Seller Menu
            </h2>

        </div>

        @if($bestSeller)

            <div class="best-item">

                <div>

                    <h3>

                        {{ $bestSeller->product->name }}

                    </h3>

                    <p>

                        Total Sold:
                        {{ $bestSeller->total_qty }}

                    </p>

                </div>

                <div class="best-badge">

                    BEST SELLER

                </div>

            </div>

        @else

            <div class="empty-finance">

                No sales data available

            </div>

        @endif

    </div>

    <!-- RECENT TRANSACTIONS -->
    <div class="transaction-card">

        <div class="transaction-header">

            <h2>
                Recent Transactions
            </h2>

        </div>

        <div class="transaction-table">

            <table>

                <thead>

                    <tr>

                        <th>
                            Order
                        </th>

                        <th>
                            Customer
                        </th>

                        <th>
                            Payment
                        </th>

                        <th>
                            Total
                        </th>

                        <th>
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($recentOrders as $order)

                        <tr>

                            <td>

                                {{ $order->order_number }}

                            </td>

                            <td>

                                {{ $order->customer_name }}

                            </td>

                            <td>

                                {{ strtoupper($order->payment_method) }}

                            </td>

                            <td>

                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}

                            </td>

                            <td>

                                <span class="status-badge">

                                    {{ strtoupper($order->status) }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5">

                                No transaction data

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection