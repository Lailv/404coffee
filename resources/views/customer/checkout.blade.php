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

    <div class="checkout-header">

        <h1>
            Checkout
        </h1>

        <p>
            Complete your order information.
        </p>

    </div>

    <form action="{{ route('customer.checkout.store') }}"
          method="POST"
          class="checkout-container">

        @csrf

        <!-- LEFT -->
        <div class="checkout-form">

            <!-- ORDER TYPE -->
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

            <!-- CUSTOMER NAME -->
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

            <!-- PHONE -->
            <div class="checkout-group">

                <label>
                    Phone Number
                </label>

                <input type="text"
                       name="customer_phone"
                       class="checkout-input"
                       required>

            </div>

            <!-- ADDRESS -->
            <div class="checkout-group"
                 id="address-field">

                <label>
                    Delivery Address
                </label>

                <textarea name="customer_address"
                          class="checkout-input"
                          rows="4"></textarea>

            </div>

            <!-- PAYMENT -->
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

                    <option value="qris">
                        QRIS
                    </option>

                </select>

            </div>

            <!-- QRIS -->
            <div id="qris-section"
                 style="display: none;">

                <div class="qris-box">

                    <h3>
                        Scan QRIS
                    </h3>

                    <img src="{{ asset('images/qris.png') }}"
                         alt="QRIS"
                         class="qris-image">

                    <p>
                        Complete payment using QRIS before order processing.
                    </p>

                </div>

            </div>

            <!-- NOTES -->
            <div class="checkout-group">

                <label>
                    Notes
                </label>

                <textarea name="notes"
                          class="checkout-input"
                          rows="4"></textarea>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="checkout-summary">

            <h2>
                Order Summary
            </h2>

            @foreach($cart as $item)

                @php
                    $subtotal = $item['price'] * $item['qty'];
                    $total += $subtotal;
                @endphp

                <div class="summary-item">

                    <div>

                        <strong>

                            {{ $item['name'] }}

                        </strong>

                        <p>

                            x{{ $item['qty'] }}

                        </p>

                    </div>

                    <span>

                        Rp {{ number_format($subtotal, 0, ',', '.') }}

                    </span>

                </div>

            @endforeach

            <div class="summary-total">

                <span>
                    Total
                </span>

                <strong>

                    Rp {{ number_format($total, 0, ',', '.') }}

                </strong>

            </div>

            <button type="submit"
                    class="checkout-btn">

                Place Order

            </button>

        </div>

    </form>

</div>

@endsection

@push('scripts')

<script src="{{ asset('js/customer/checkout.js') }}"></script>

@endpush