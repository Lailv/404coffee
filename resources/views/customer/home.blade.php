@extends('customer.layouts.app')

@section('title', '404.Coffee — Home')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/customer/dashboard.css') }}">
@endpush

@section('content')

<div class="dashboard">

    {{-- ===================== HERO ===================== --}}
    <section class="hero">

        <div class="hero-inner">

            {{-- LEFT --}}
            <div class="hero-left">

                <span class="hero-eyebrow">
                    <span class="eyebrow-dot"></span>
                    Premium Coffee · Modern Space
                </span>

                <h1 class="hero-title">
                    Coffee <em>Beyond</em><br>Ordinary
                </h1>

                <p class="hero-desc">
                    Experience handcrafted coffee, premium foods,
                    and a modern atmosphere designed for your comfort.
                </p>

                <div class="hero-actions">
                    <a href="{{ route('customer.menu') }}" class="btn btn-sage">
                        <i class="fa-solid fa-mug-hot"></i>
                        Explore Menu
                    </a>
                    <a href="{{ route('customer.cart') }}" class="btn btn-outline">
                        <i class="fa-solid fa-bag-shopping"></i>
                        My Cart
                    </a>
                </div>

                {{-- STATS --}}
                <div class="hero-stats">
                    <div class="stat">
                        <span class="stat-value">50+</span>
                        <span class="stat-label">Premium Menu</span>
                    </div>
                    <div class="stat-sep"></div>
                    <div class="stat">
                        <span class="stat-value">4.9<i class="fa-solid fa-star stat-star"></i></span>
                        <span class="stat-label">Customer Rating</span>
                    </div>
                    <div class="stat-sep"></div>
                    <div class="stat">
                        <span class="stat-value">24/7</span>
                        <span class="stat-label">Fast Ordering</span>
                    </div>
                </div>

            </div>

            {{-- RIGHT --}}
            <div class="hero-right">

                {{-- DECORATIVE RING --}}
                <div class="hero-ring ring-outer"></div>
                <div class="hero-ring ring-inner"></div>

                {{-- COFFEE IMAGE --}}
                <div class="hero-img-wrap">
                    <div class="hero-img-glow"></div>
                    <img src="{{ asset('images/coffee.png') }}" alt="Coffee" class="hero-img">
                </div>

                {{-- FLOATING CARDS --}}
                <div class="float-card float-top">
                    <div class="float-icon float-icon--rose">
                        <i class="fa-solid fa-fire"></i>
                    </div>
                    <div class="float-text">
                        <strong>Best Seller</strong>
                        <span>Most ordered today</span>
                    </div>
                </div>

                <div class="float-card float-bottom">
                    <div class="float-icon float-icon--sage">
                        <i class="fa-solid fa-leaf"></i>
                    </div>
                    <div class="float-text">
                        <strong>Premium Beans</strong>
                        <span>High quality taste</span>
                    </div>
                </div>

            </div>

        </div>

        {{-- SCROLL HINT --}}
        <div class="hero-scroll">
            <span>Scroll to explore</span>
            <div class="scroll-line"></div>
        </div>

    </section>

    {{-- ===================== FEATURES ===================== --}}
    <section class="features">

        <div class="features-inner">

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fa-solid fa-mug-hot"></i>
                </div>
                <div class="feature-body">
                    <h3>Premium Coffee</h3>
                    <p>Freshly brewed with carefully selected single-origin beans.</p>
                </div>
                <div class="feature-arrow">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fa-solid fa-burger"></i>
                </div>
                <div class="feature-body">
                    <h3>Fresh Food</h3>
                    <p>Delicious meals prepared fresh daily from our kitchen.</p>
                </div>
                <div class="feature-arrow">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <div class="feature-body">
                    <h3>Fast Service</h3>
                    <p>Seamless and modern ordering system at your fingertips.</p>
                </div>
                <div class="feature-arrow">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>

        </div>

    </section>

</div>

@endsection
