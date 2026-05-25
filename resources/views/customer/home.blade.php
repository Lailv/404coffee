@extends('customer.layouts.app')

@section('title', '404.Coffee — Home')

@push('styles')
<link rel="stylesheet"
      href="{{ asset('css/customer/dashboard.css') }}">
@endpush

@section('content')

<div class="dashboard">

    {{-- ===================================================== --}}
    {{-- HERO SECTION --}}
    {{-- ===================================================== --}}
    <section class="hero">

        <div class="hero-inner">

            {{-- LEFT --}}
            <div class="hero-left">

                {{-- EYEBROW --}}
                <span class="hero-eyebrow">

                    <span class="eyebrow-dot"></span>

                    Premium Coffee • Modern Atmosphere

                </span>

                {{-- TITLE --}}
                <h1 class="hero-title">

                    Crafted For<br>

                    <em>Comfort</em> & Focus

                </h1>

                {{-- DESCRIPTION --}}
                <p class="hero-desc">

                    Experience handcrafted coffee, premium foods,
                    and a calm modern atmosphere designed
                    for working, relaxing, and connecting.

                </p>

                {{-- BUTTON --}}
                <div class="hero-actions">

                    <a href="{{ route('customer.menu') }}"
                       class="btn btn-sage">

                        Discover Our Menu

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>

                {{-- STATS --}}
                <div class="hero-stats">

                    <div class="stat">

                        <span class="stat-value">
                            25+
                        </span>

                        <span class="stat-label">
                            Premium Menu
                        </span>

                    </div>

                    <div class="stat-sep"></div>

                    <div class="stat">

                        <span class="stat-value">

                            4.9

                            <i class="fa-solid fa-star stat-star"></i>

                        </span>

                        <span class="stat-label">
                            Customer Rating
                        </span>

                    </div>

                    <div class="stat-sep"></div>

                    <div class="stat">

                        <span class="stat-value">
                            Daily
                        </span>

                        <span class="stat-label">
                            Fresh Brewed
                        </span>

                    </div>

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="hero-right">

                {{-- RINGS --}}
                <div class="hero-ring ring-outer"></div>
                <div class="hero-ring ring-middle"></div>
                <div class="hero-ring ring-inner"></div>

                {{-- CENTER ORB --}}
                <div class="hero-orb-wrap">

                    <div class="hero-orb hero-orb-1"></div>
                    <div class="hero-orb hero-orb-2"></div>

                    <div class="hero-center-content">

                        <span class="center-label">
                            EST 2026
                        </span>

                        <h2>
                            404.Coffee
                        </h2>

                        <p>
                            Crafted With Passion
                        </p>

                    </div>

                </div>

                {{-- FLOAT CARD --}}
                <div class="float-card float-top">

                    <div class="float-icon float-icon--rose">

                        <i class="fa-solid fa-fire"></i>

                    </div>

                    <div class="float-text">

                        <strong>
                            Best Seller
                        </strong>

                        <span>
                            Most ordered today
                        </span>

                    </div>

                </div>

                {{-- FLOAT CARD --}}
                <div class="float-card float-bottom">

                    <div class="float-icon float-icon--sage">

                        <i class="fa-solid fa-leaf"></i>

                    </div>

                    <div class="float-text">

                        <strong>
                            Premium Beans
                        </strong>

                        <span>
                            Carefully selected taste
                        </span>

                    </div>

                </div>

            </div>

        </div>

        {{-- SCROLL --}}
        <div class="hero-scroll">

            <span>
                Scroll to explore
            </span>

            <div class="scroll-line"></div>

        </div>

    </section>

    {{-- ===================================================== --}}
    {{-- FEATURES --}}
    {{-- ===================================================== --}}
    <section class="features">

        {{-- HEADING --}}
        <div class="section-heading">

            <span class="section-eyebrow">
                Why Choose Us
            </span>

            <h2 class="section-title">

                Designed For Modern
                <em>Coffee Lovers</em>

            </h2>

        </div>

        {{-- GRID --}}
        <div class="features-inner">

            {{-- ITEM --}}
            <div class="feature-card">

                <div class="feature-icon">

                    <i class="fa-solid fa-mug-hot"></i>

                </div>

                <div class="feature-body">

                    <h3>
                        Premium Coffee
                    </h3>

                    <p>
                        Freshly brewed using carefully selected
                        high quality coffee beans every day.
                    </p>

                </div>

                <div class="feature-arrow">

                    <i class="fa-solid fa-arrow-right"></i>

                </div>

            </div>

            {{-- ITEM --}}
            <div class="feature-card">

                <div class="feature-icon">

                    <i class="fa-solid fa-burger"></i>

                </div>

                <div class="feature-body">

                    <h3>
                        Fresh Food
                    </h3>

                    <p>
                        Delicious meals and snacks prepared
                        fresh directly from our kitchen.
                    </p>

                </div>

                <div class="feature-arrow">

                    <i class="fa-solid fa-arrow-right"></i>

                </div>

            </div>

            {{-- ITEM --}}
            <div class="feature-card">

                <div class="feature-icon">

                    <i class="fa-solid fa-wifi"></i>

                </div>

                <div class="feature-body">

                    <h3>
                        Cozy Workspace
                    </h3>

                    <p>
                        Comfortable atmosphere designed
                        for working, studying, and relaxing.
                    </p>

                </div>

                <div class="feature-arrow">

                    <i class="fa-solid fa-arrow-right"></i>

                </div>

            </div>

        </div>

    </section>

</div>

@endsection