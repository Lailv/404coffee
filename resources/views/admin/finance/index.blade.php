@extends('admin.layouts.app')

@section('title', 'Finance')

@section('content')

@include('admin.finance.add-expense')

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

    @include('admin.finance.stats')

    @include('admin.finance.best-seller')

    @include('admin.finance.transactions')

    @include('admin.finance.recent-orders')

</div>

@endsection