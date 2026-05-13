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
                Monitor revenue, expenses, transactions, and business performance
            </p>

        </div>

        <div class="finance-badge">

            ERP Finance System

        </div>

    </div>

    <!-- ADD EXPENSE -->
    @include('admin.finance.add-expense')

    <!-- STATS -->
    @include('admin.finance.stats')

    <!-- BEST SELLER -->
    @include('admin.finance.best-seller')

    <!-- TRANSACTIONS -->
    @include('admin.finance.transactions')

    <!-- RECENT ORDERS -->
    @include('admin.finance.recent-orders')

</div>

@endsection