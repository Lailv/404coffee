@extends('customer.layouts.app')

@section('title', 'Menu | 404.Coffee')

@push('styles')

<link rel="stylesheet"
      href="{{ asset('css/customer/menu.css') }}">

@endpush

@section('content')

<div class="customer-menu">

    <div class="menu-header">

        <h1>
            Our Menu
        </h1>

        <p>
            Explore premium coffee and foods from 404.Coffee.
        </p>

    </div>

    <!-- =========================================
         COFFEE
    ========================================== -->

    <div class="menu-section">

        <h2 class="section-title">
            Coffee
        </h2>

        <div class="menu-grid">

            @forelse($coffeeProducts as $product)

                <div class="menu-card">

                    <div class="menu-content">

                        <span class="menu-category">

                            {{ $product->category->name }}

                        </span>

                        <h3>

                            {{ $product->name }}

                        </h3>

                        <p class="menu-price">

                            Rp {{ number_format($product->price, 0, ',', '.') }}

                        </p>

                        <form action="{{ route('customer.cart.add', $product->id) }}"
                              method="POST">

                            @csrf

                            <button type="submit"
                                    class="menu-btn">

                                Add to Cart

                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="empty-menu">

                    <h3>
                        No Coffee Available
                    </h3>

                </div>

            @endforelse

        </div>

    </div>

    <!-- =========================================
         NON COFFEE
    ========================================== -->

    <div class="menu-section">

        <h2 class="section-title">
            Non Coffee
        </h2>

        <div class="menu-grid">

            @forelse($nonCoffeeProducts as $product)

                <div class="menu-card">

                    <div class="menu-content">

                        <span class="menu-category">

                            {{ $product->category->name }}

                        </span>

                        <h3>

                            {{ $product->name }}

                        </h3>

                        <p class="menu-price">

                            Rp {{ number_format($product->price, 0, ',', '.') }}

                        </p>

                        <form action="{{ route('customer.cart.add', $product->id) }}"
                              method="POST">

                            @csrf

                            <button type="submit"
                                    class="menu-btn">

                                Add to Cart

                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="empty-menu">

                    <h3>
                        No Non Coffee Available
                    </h3>

                </div>

            @endforelse

        </div>

    </div>

    <!-- =========================================
         FOOD
    ========================================== -->

    <div class="menu-section">

        <h2 class="section-title">
            Food
        </h2>

        <div class="menu-grid">

            @forelse($foodProducts as $product)

                <div class="menu-card">

                    <div class="menu-content">

                        <span class="menu-category">

                            {{ $product->category->name }}

                        </span>

                        <h3>

                            {{ $product->name }}

                        </h3>

                        <p class="menu-price">

                            Rp {{ number_format($product->price, 0, ',', '.') }}

                        </p>

                        <form action="{{ route('customer.cart.add', $product->id) }}"
                              method="POST">

                            @csrf

                            <button type="submit"
                                    class="menu-btn">

                                Add to Cart

                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="empty-menu">

                    <h3>
                        No Food Available
                    </h3>

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection