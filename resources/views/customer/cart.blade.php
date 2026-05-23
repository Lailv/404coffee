@extends('customer.layouts.app')

@section('title', 'Cart | 404.Coffee')

@push('styles')

<link rel="stylesheet"
      href="{{ asset('css/customer/cart.css') }}">

@endpush

@section('content')

@php

    $cart = session('cart', []);

    $total = 0;

@endphp

<div class="customer-cart">

    <div class="cart-header">

        <h1>
            Your Cart
        </h1>

        <p>
            Review your selected items before checkout.
        </p>

    </div>

    @if(count($cart) > 0)

        <div class="cart-container">

            <!-- CART ITEMS -->
            <div class="cart-items">

                @foreach($cart as $item)

                    @php
                        $subtotal = $item['price'] * $item['qty'];
                        $total += $subtotal;
                    @endphp

                    <div class="cart-card">

                        <div class="cart-info">

                            <h3>

                                {{ $item['name'] }}

                            </h3>

                            <p>

                                Rp {{ number_format($item['price'], 0, ',', '.') }}

                            </p>

                        </div>

                        <!-- QTY CONTROL -->
                        <div class="cart-qty">

                            <!-- DECREASE -->
                            <form action="{{ route('customer.cart.update', $item['id']) }}"
                                  method="POST">

                                @csrf

                                <input type="hidden"
                                       name="action"
                                       value="decrease">

                                <button type="submit"
                                        class="qty-btn">

                                    -

                                </button>

                            </form>

                            <span class="qty-number">

                                {{ $item['qty'] }}

                            </span>

                            <!-- INCREASE -->
                            <form action="{{ route('customer.cart.update', $item['id']) }}"
                                  method="POST">

                                @csrf

                                <input type="hidden"
                                       name="action"
                                       value="increase">

                                <button type="submit"
                                        class="qty-btn">

                                    +

                                </button>

                            </form>

                        </div>

                        <div class="cart-subtotal">

                            Rp {{ number_format($subtotal, 0, ',', '.') }}

                        </div>

                        <!-- REMOVE -->
                        <form action="{{ route('customer.cart.remove', $item['id']) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="remove-btn">

                                Remove

                            </button>

                        </form>

                    </div>

                @endforeach

            </div>

            <!-- SUMMARY -->
            <div class="cart-summary">

                <h2>
                    Order Summary
                </h2>

                <div class="summary-row">

                    <span>
                        Total
                    </span>

                    <strong>

                        Rp {{ number_format($total, 0, ',', '.') }}

                    </strong>

                </div>

                <a href="{{ route('customer.checkout') }}"
                   class="checkout-btn">

                    Proceed to Checkout

                </a>

            </div>

        </div>

    @else

        <div class="cart-empty">

            <i class="fa-solid fa-cart-shopping"></i>

            <h2>
                Your cart is empty
            </h2>

            <p>
                Add some delicious menu items first.
            </p>

            <a href="{{ route('customer.menu') }}"
               class="cart-btn">

                Explore Menu

            </a>

        </div>

    @endif

</div>

@endsection