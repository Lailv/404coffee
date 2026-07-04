@extends('customer.layouts.app')

@section('title', 'Checkout | 404.Coffee')

@push('styles')

<link rel="stylesheet"
      href="{{ asset('css/customer/checkout.css') }}">

@endpush

@section('content')

@php

    $cart = session('cart', []);

    $total = 0;

@endphp

<div class="customer-checkout">

    {{-- ===================================================== --}}
    {{-- HERO --}}
    {{-- ===================================================== --}}
    <section class="checkout-hero">

        <div class="checkout-hero-inner">

            <span class="checkout-eyebrow">

                <span class="eyebrow-dot"></span>

                Secure Checkout • Smooth Experience

            </span>

            <h1 class="checkout-title">

                Complete Your
                <em>Order</em>

            </h1>

            <p class="checkout-desc">

                Fill in your order information and
                finalize your premium coffee experience.

            </p>

        </div>

    </section>

    {{-- ===================================================== --}}
    {{-- CONTENT --}}
    {{-- ===================================================== --}}
    <form action="{{ route('customer.checkout.store') }}"
          method="POST"
          class="checkout-layout">

        @csrf

        {{-- LEFT --}}
        <div class="checkout-form">

            {{-- ORDER TYPE --}}
            <div class="checkout-card">

                <div class="checkout-card-glow"></div>

                <div class="checkout-group">

                    <label>
                        Order Type
                    </label>

                    <select name="order_type"
                            id="order_type"
                            class="checkout-input">

                        <option value="pickup">
                            Pickup
                        </option>

                        <option value="delivery">
                            Delivery
                        </option>

                    </select>

                </div>

            </div>

            {{-- CUSTOMER --}}
            <div class="checkout-card">

                <div class="checkout-card-glow"></div>

                <div class="checkout-group">

                    <label>
                        Customer Name
                    </label>

                    <input type="text"
                           name="customer_name"
                           class="checkout-input"
                           value="{{ auth()->user()->name ?? '' }}"
                           required>

                </div>

                <div class="checkout-group">

                    <label>
                        Phone Number
                    </label>

                    <input type="text"
                           name="customer_phone"
                           class="checkout-input"
                           required>

                </div>

                <div class="checkout-group"
                     id="address-field">

                    <label>
                        Delivery Address
                    </label>

                    <textarea name="customer_address"
                              rows="4"
                              class="checkout-input"></textarea>

                </div>

            </div>

            {{-- PAYMENT --}}
            <div class="checkout-card">

                <div class="checkout-card-glow"></div>

                <div class="checkout-group">

                    <label>
                        Payment Method
                    </label>

                    <select name="payment_method"
                            id="payment_method"
                            class="checkout-input">

                        <option value="cash">
                            Cash
                        </option>

                        <option value="midtrans">
                            Midtrans
                        </option>

                    </select>

                </div>

            </div>

            {{-- NOTES --}}
            <div class="checkout-card">

                <div class="checkout-card-glow"></div>

                <div class="checkout-group">

                    <label>
                        Notes
                    </label>

                    <textarea name="notes"
                              rows="4"
                              class="checkout-input"></textarea>

                </div>

            </div>

        </div>

        {{-- RIGHT --}}
        <div class="checkout-summary">

            <div class="summary-glow"></div>

            <span class="summary-label">

                Order Summary

            </span>

            <h2>

                Ready To Brew

            </h2>

            <p>

                Review your selected items before
                placing the order.

            </p>

            {{-- ITEMS --}}
            <div class="summary-items">

                @foreach($cart as $item)

                    @php
                        $subtotal = $item['price'] * $item['qty'];
                        $total += $subtotal;
                    @endphp

                    <div class="summary-item">

                        <div class="summary-info">

                            <strong>

                                {{ $item['name'] }}

                            </strong>

                            <span>

                                Qty {{ $item['qty'] }}

                            </span>

                        </div>

                        <div class="summary-price">

                            Rp {{ number_format($subtotal, 0, ',', '.') }}

                        </div>

                    </div>

                @endforeach

            </div>

            {{-- TOTAL --}}
            <div class="summary-total">

                <span>
                    Total Payment
                </span>

                <strong>

                    Rp {{ number_format($total, 0, ',', '.') }}

                </strong>

            </div>

            {{-- BUTTON --}}
            <button type="submit"
                    class="checkout-btn">

                Place Order

                <i class="fa-solid fa-arrow-right"></i>

            </button>

        </div>

    </form>

</div>

@endsection

@push('scripts')

<script src="{{ asset('js/customer/checkout.js') }}"></script>

@endpush