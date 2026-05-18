@extends('customer.layouts.app')

@section('title', '404.Coffee')

@push('styles')

<link rel="stylesheet"
      href="{{ asset('css/customer/dashboard.css') }}">

@endpush

@section('content')

<div class="customer-dashboard">

    <!-- HERO -->
    <section class="hero-section">

        <div class="hero-content">

            <span class="hero-badge">

                Welcome to

            </span>

            <h1>

                404.Coffee

            </h1>

            <p>

                Explore premium coffee, foods, and drinks from 404.Coffee.

            </p>

            <div class="hero-actions">

                <a href="#"
                   class="hero-btn primary">

                    Explore Menu

                </a>

                <a href="#"
                   class="hero-btn secondary">

                    My Orders

                </a>

            </div>

        </div>

    </section>

    <!-- FEATURES -->
    <section class="feature-grid">

        <!-- CARD -->
        <div class="feature-card">

            <div class="feature-icon">

                <i class="fa-solid fa-mug-hot"></i>

            </div>

            <h3>
                Premium Coffee
            </h3>

            <p>
                Fresh coffee crafted with high quality beans.
            </p>

        </div>

        <!-- CARD -->
        <div class="feature-card">

            <div class="feature-icon">

                <i class="fa-solid fa-burger"></i>

            </div>

            <h3>
                Fresh Food
            </h3>

            <p>
                Delicious foods prepared directly from the kitchen.
            </p>

        </div>

        <!-- CARD -->
        <div class="feature-card">

            <div class="feature-icon">

                <i class="fa-solid fa-clock"></i>

            </div>

            <h3>
                Fast Ordering
            </h3>

            <p>
                Seamless ordering integrated with POS and kitchen system.
            </p>

        </div>

    </section>

</div>

@endsection