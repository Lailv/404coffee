@extends('customer.layouts.app')

@section('title', 'Order Detail | 404.Coffee')

@push('styles')

<link rel="stylesheet"
      href="{{ asset('css/customer/order-detail.css') }}">

@endpush

@section('content')

<section class="order-detail-page">

    <div class="order-detail-container">

        <!-- =========================
             HEADER
        ========================== -->

        <div class="order-detail-header">

            <div>

                <h2>

                    Order Detail

                </h2>

                <p>

                    View complete information about your order.

                </p>

            </div>

            <a href="{{ route('customer.profile') }}"
               class="back-btn">

                <i class="fas fa-arrow-left"></i>

                Back

            </a>

        </div>

        <!-- =========================
             ORDER INFO
        ========================== -->

        <div class="detail-card">

            <div class="detail-row">

                <span>Order Number</span>

                <strong>

                    {{ $order->order_number }}

                </strong>

            </div>

            <div class="detail-row">

                <span>Date</span>

                <strong>

                    {{ $order->created_at->format('d M Y H:i') }}

                </strong>

            </div>

            <div class="detail-row">

                <span>Status</span>

                <strong class="status">

                    {{ strtoupper($order->status) }}

                </strong>

            </div>

            <div class="detail-row">

                <span>Payment</span>

                <strong>

                    {{ strtoupper($order->payment_method) }}

                </strong>

            </div>

            <div class="detail-row">

                <span>Order Type</span>

                <strong>

                    {{ ucfirst($order->order_type) }}

                </strong>

            </div>

        </div>

        <!-- =========================
             ORDER ITEMS
        ========================== -->

        <div class="items-card">

            <h3>

                Order Items

            </h3>

            @foreach($order->items as $item)

                <div class="item-row">

                    <div>

                        <h4>

                            {{ $item->product->name }}

                        </h4>

                        <small>

                            Qty : {{ $item->qty }}

                        </small>

                    </div>

                    <strong>

                        Rp {{ number_format($item->price,0,',','.') }}

                    </strong>

                </div>

            @endforeach

        </div>

        <!-- =========================
             TOTAL
        ========================== -->

        <div class="total-card">

            <span>

                Total Payment

            </span>

            <strong>

                Rp {{ number_format($order->total_amount,0,',','.') }}

            </strong>

        </div>

        <!-- =========================
             RATING
        ========================== -->

        <div class="rating-card">

            <h3>

                Rate Your Order

            </h3>

            <p>

                Your feedback helps us improve our coffee and service.

            </p>

            <form action="{{ route('customer.order.review', $order) }}"
                  method="POST">

                @csrf

                <div class="rating-select">

                    <select name="rating"
                            required>

                        <option value="">Select Rating</option>

                        <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                        <option value="4">⭐⭐⭐⭐ (4)</option>
                        <option value="3">⭐⭐⭐ (3)</option>
                        <option value="2">⭐⭐ (2)</option>
                        <option value="1">⭐ (1)</option>

                    </select>

                </div>

                <button type="submit"
                        class="rating-btn">

                    <i class="fas fa-star"></i>

                    Submit Rating

                </button>

            </form>

        </div>

    </div>

</section>

@endsection
