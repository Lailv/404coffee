@extends('admin.layouts.app')

@section('title', 'Customer')

@push('styles')

<link
    rel="stylesheet"
    href="{{ asset('css/admin/customer.css') }}">

@endpush

@section('content')

<div class="customer-page">

    <!-- HEADER -->
    <div class="customer-header">

        <div>

            <h1>
                Customer Management
            </h1>

            <p>
                Monitor customer activity and account information
            </p>

        </div>

    </div>

    <!-- STATS -->
    <div class="stats-grid">

        <div class="stats-card">

            <span class="stats-title">
                Total Customer
            </span>

            <h2>
                {{ $totalCustomer }}
            </h2>

        </div>

        <div class="stats-card">

            <span class="stats-title">
                Active Customer
            </span>

            <h2>
                {{ $activeCustomer }}
            </h2>

        </div>

        <div class="stats-card">

            <span class="stats-title">
                New This Month
            </span>

            <h2>
                {{ $newCustomer }}
            </h2>

        </div>

        <div class="stats-card">

            <span class="stats-title">
                Total Spending
            </span>

            <h2>
                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
            </h2>

        </div>

    </div>

    <!-- TABLE -->
    <div class="customer-card">

        <div class="card-header">

            <h2>
                Customer List
            </h2>

        </div>

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>
                            Customer
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Join Date
                        </th>

                        <th>
                            Orders
                        </th>

                        <th>
                            Spending
                        </th>

                        <th>
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($customers as $customer)

                        <tr>

                            <td>

                                <div class="customer-info">

                                    <img
                                        src="{{ $customer->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($customer->name) }}"
                                        class="customer-avatar">

                                    <div>

                                        <div class="customer-name">

                                            {{ $customer->name }}

                                        </div>

                                    </div>

                                </div>

                            </td>

                            <td>

                                {{ $customer->email }}

                            </td>

                            <td>

                                {{ $customer->created_at->format('d M Y') }}

                            </td>

                            <td>

                                {{ $customer->total_orders }}

                            </td>

                            <td>

                                Rp {{ number_format($customer->total_spending, 0, ',', '.') }}

                            </td>

                            <td>

                                <span class="status-badge active">

                                    {{ strtoupper($customer->status) }}

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6">

                                No customer data

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection