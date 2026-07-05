@extends('customer.layouts.app')

@section('title', 'My Profile | 404.Coffee')

@push('styles')

<link rel="stylesheet" href="{{ asset('css/customer/profile.css') }}">

@endpush

@section('content')

<section class="profile-page">

    <div class="profile-container">

        <!-- =========================
             PROFILE HEADER
        ========================== -->

        <div class="profile-header">

            <div class="profile-avatar">

                <i class="fas fa-user"></i>

            </div>

            <div class="profile-info">

                <h2>My Profile</h2>

                <p>
                    Manage your personal information and view your order history.
                </p>

            </div>

        </div>

        <!-- =========================
             PROFILE FORM
        ========================== -->

        <div class="profile-card">

            @if(session('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

            @endif

            <form
                action="{{ route('customer.profile.update') }}"
                method="POST">

                @csrf

                <div class="form-group">

                    <label>Full Name</label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        placeholder="Enter your full name">

                </div>

                <div class="form-group">

                    <label>Email Address</label>

                    <input
                        type="email"
                        value="{{ $user->email }}"
                        readonly>

                </div>

                <div class="form-group">

                    <label>Phone Number</label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone', $user->phone) }}"
                        placeholder="08xxxxxxxxxx">

                </div>

                <div class="form-group">

                    <label>Address</label>

                    <textarea
                        name="address"
                        rows="4"
                        placeholder="Enter your address">{{ old('address', $user->address) }}</textarea>

                </div>

                <button
                    type="submit"
                    class="save-btn">

                    <i class="fas fa-save"></i>

                    Save Changes

                </button>

            </form>

        </div>

        <!-- =========================
             ORDER HISTORY
        ========================== -->

        <div class="order-history">

            <div class="section-title">

                <h3>Order History</h3>

                <p>

                    View all your previous orders.

                </p>

            </div>

            @if($orders->count())

                @foreach($orders as $order)

                    <div class="order-card">

                        <div class="order-header">

                            <div>

                                <h4>

                                    {{ $order->order_number }}

                                </h4>

                                <small>

                                    {{ $order->created_at->format('d M Y • H:i') }}

                                </small>

                            </div>

                            <span class="order-status">

                                {{ strtoupper($order->status) }}

                            </span>

                        </div>

                        <div class="order-body">

                            <div class="order-item">

                                <span>Order Type</span>

                                <strong>

                                    {{ ucfirst($order->order_type) }}

                                </strong>

                            </div>

                            <div class="order-item">

                                <span>Total Payment</span>

                                <strong>

                                    Rp {{ number_format($order->total_amount,0,',','.') }}

                                </strong>

                            </div>

                        </div>

                       <div class="order-footer">

    <a
        href="{{ route('customer.order.show', $order) }}"
        class="detail-btn">

        <i class="fas fa-receipt"></i>

        View Detail

    </a>

</div>

                @endforeach

            @else

                <div class="empty-order">

                    <i class="fas fa-box-open"></i>

                    <h4>

                        No Orders Yet

                    </h4>

                    <p>

                        You haven't placed any orders yet.

                    </p>

                </div>

            @endif

        </div>

    </div>

</section>

@endsection