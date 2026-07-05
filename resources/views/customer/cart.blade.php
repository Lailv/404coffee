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

    {{-- ===================================================== --}}
    {{-- HERO --}}
    {{-- ===================================================== --}}
    <section class="cart-hero">

        <div class="cart-hero-inner">

            <span class="cart-eyebrow">

                <span class="eyebrow-dot"></span>

                Your Selected Experience

            </span>

            <h1 class="cart-title">

                Your
                <em>Coffee Cart</em>

            </h1>

            <p class="cart-desc">

                Review your selected items before
                continuing to checkout and enjoy
                the perfect coffee experience.

            </p>

        </div>

    </section>

    {{-- ===================================================== --}}
    {{-- CART --}}
    {{-- ===================================================== --}}
    @if(count($cart) > 0)

        <div class="cart-layout">

            {{-- ITEMS --}}
            <div class="cart-items">

                @foreach($cart as $item)

                    @php
                        $subtotal = $item['price'] * $item['qty'];
                        $total += $subtotal;
                    @endphp

                    <div class="cart-card">

                        {{-- GLOW --}}
                        <div class="cart-card-glow"></div>

                        {{-- INFO --}}
                        <div class="cart-info">

                            <span class="cart-category">
                                Premium Menu
                            </span>

                            <h3>

                                {{ $item['name'] }}

                            </h3>

                            <p class="cart-price">

                                Rp {{ number_format($item['price'], 0, ',', '.') }}

                            </p>

                        </div>

                        {{-- QTY --}}
                        <div class="cart-qty">

                            {{-- DECREASE --}}
                            <form action="{{ route('customer.cart.update', $item['id']) }}"
                                  method="POST">

                                @csrf

                                <input type="hidden"
                                       name="action"
                                       value="decrease">

                                <button type="submit"
                                        class="qty-btn">

                                    <i class="fa-solid fa-minus"></i>

                                </button>

                            </form>

                            {{-- INPUT MANUAL --}}
                            <form action="{{ route('customer.cart.update', $item['id']) }}"
                                  method="POST"
                                  class="qty-input-form">

                                @csrf

                                <input type="number"
                                       name="qty"
                                       value="{{ $item['qty'] }}"
                                       min="1"
                                       class="qty-input"
                                       onchange="this.form.submit()">

                            </form>

                            {{-- INCREASE --}}
                            <form action="{{ route('customer.cart.update', $item['id']) }}"
                                  method="POST">

                                @csrf

                                <input type="hidden"
                                       name="action"
                                       value="increase">

                                <button type="submit"
                                        class="qty-btn">

                                    <i class="fa-solid fa-plus"></i>

                                </button>

                            </form>

                        </div>

                        {{-- SUBTOTAL --}}
                        <div class="cart-subtotal">

                            Rp {{ number_format($subtotal, 0, ',', '.') }}

                        </div>

                        {{-- REMOVE --}}
                        <form action="{{ route('customer.cart.remove', $item['id']) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="remove-btn">

                                <i class="fa-solid fa-trash"></i>

                            </button>

                        </form>

                    </div>

                @endforeach

            </div>

            {{-- SUMMARY --}}
            <div class="cart-summary">

                <div class="summary-glow"></div>

                <span class="summary-label">

                    Order Summary

                </span>

                <h2>

                    Ready To Checkout

                </h2>

                <p>

                    Your selected items are ready
                    to be processed.

                </p>

                <div class="summary-total">

                    <span>
                        Total Payment
                    </span>

                    <strong>

                        Rp {{ number_format($total, 0, ',', '.') }}

                    </strong>

                </div>

                <a href="{{ route('customer.checkout') }}"
                   class="checkout-btn">

                    Proceed to Checkout

                    <i class="fa-solid fa-arrow-right"></i>

                </a>

            </div>

        </div>

    @else

        {{-- EMPTY --}}
        <div class="cart-empty">

            <div class="empty-orb"></div>

            <div class="empty-icon">

                <i class="fa-solid fa-bag-shopping"></i>

            </div>

            <h2>

                Your cart is empty

            </h2>

            <p>

                Discover handcrafted coffee and
                delicious foods from our menu.

            </p>

            <a href="{{ route('customer.menu') }}"
               class="cart-btn">

                Explore Menu

                <i class="fa-solid fa-arrow-right"></i>

            </a>

        </div>

    @endif

</div>

@endsection