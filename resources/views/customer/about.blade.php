@extends('customer.layouts.app')

@section('title', 'About | 404.Coffee')

@push('styles')

<link rel="stylesheet"
      href="{{ asset('css/customer/about.css') }}">

@endpush

@section('content')

<div class="customer-about">

    {{-- ===================================================== --}}
    {{-- HERO --}}
    {{-- ===================================================== --}}
    <section class="about-hero">

        <div class="about-hero-inner">

            <span class="about-eyebrow">

                <span class="eyebrow-dot"></span>

                Crafted Beyond Ordinary

            </span>

            <h1 class="about-title">

                More Than Just
                <em>Coffee</em>

            </h1>

            <p class="about-desc">

                404.Coffee combines premium handcrafted drinks,
                modern cafe atmosphere, and technology-driven
                experiences designed for creators, workers,
                students, and coffee lovers.

            </p>

        </div>

    </section>

    {{-- ===================================================== --}}
    {{-- STORY --}}
    {{-- ===================================================== --}}
    <section class="story-section">

        <div class="story-layout">

            {{-- LEFT --}}
            <div class="story-content">

                <span class="section-badge">

                    Our Philosophy

                </span>

                <h2>

                    Built With Passion,
                    Technology & Comfort

                </h2>

                <p>

                    404.Coffee was created to become more than
                    a regular coffee shop. We wanted to build
                    a place where people can work comfortably,
                    create ideas, relax, and enjoy premium
                    handcrafted coffee in one modern space.

                </p>

                <p>

                    Every detail is designed carefully —
                    from the atmosphere, menu selection,
                    digital systems, and customer experience.

                </p>

            </div>

            {{-- RIGHT --}}
            <div class="story-orb-wrap">

                <div class="story-ring ring-1"></div>
                <div class="story-ring ring-2"></div>

                <div class="story-orb">

                    <span>
                        EST 2026
                    </span>

                    <h3>
                        404.Coffee
                    </h3>

                    <p>
                        Brewed Beyond Ordinary
                    </p>

                </div>

            </div>

        </div>

    </section>

    {{-- ===================================================== --}}
    {{-- FEATURES --}}
    {{-- ===================================================== --}}
    <section class="about-section">

        <div class="section-heading">

            <span class="section-eyebrow">
                Why Choose Us
            </span>

            <h2 class="section-title">

                Designed For Modern
                <em>Coffee Lovers</em>

            </h2>

        </div>

        <div class="about-grid">

            {{-- CARD --}}
            <div class="about-card">

                <div class="about-icon">

                    <i class="fa-solid fa-mug-hot"></i>

                </div>

                <h3>
                    Premium Coffee
                </h3>

                <p>
                    Carefully selected beans and handcrafted
                    brewing methods create rich and memorable
                    flavors in every cup.
                </p>

            </div>

            {{-- CARD --}}
            <div class="about-card">

                <div class="about-icon">

                    <i class="fa-solid fa-laptop-code"></i>

                </div>

                <h3>
                    Modern Experience
                </h3>

                <p>
                    Built with digital ordering systems,
                    modern workflows, and smooth customer
                    experiences powered by technology.
                </p>

            </div>

            {{-- CARD --}}
            <div class="about-card">

                <div class="about-icon">

                    <i class="fa-solid fa-users"></i>

                </div>

                <h3>
                    Community Space
                </h3>

                <p>
                    A place where people gather, work,
                    create ideas, and enjoy meaningful
                    conversations together.
                </p>

            </div>

        </div>

    </section>

    {{-- ===================================================== --}}
    {{-- TEAM --}}
    {{-- ===================================================== --}}
    <section class="team-section">

        <div class="section-heading">

            <span class="section-eyebrow">
                Our Team
            </span>

            <h2 class="section-title">

                Meet The People Behind
                <em>404.Coffee</em>

            </h2>

        </div>

        <div class="team-grid">

            {{-- TEAM --}}
            <div class="team-card">

                <div class="team-orb"></div>

                <div class="team-avatar">

                    <i class="fa-solid fa-code"></i>

                </div>

                <div class="team-content">

                    <h3>
                        Lail Alvi
                    </h3>

                    <span>
                        Founder & Developer
                    </span>

                </div>

            </div>

            {{-- TEAM --}}
            <div class="team-card">

                <div class="team-orb"></div>

                <div class="team-avatar">

                    <i class="fa-solid fa-cash-register"></i>

                </div>

                <div class="team-content">

                    <h3>
                        Nazala & Ridha
                    </h3>

                    <span>
                        Cashier & Customer Service
                    </span>

                </div>

            </div>

            {{-- TEAM --}}
            <div class="team-card">

                <div class="team-orb"></div>

                <div class="team-avatar">

                    <i class="fa-solid fa-utensils"></i>

                </div>

                <div class="team-content">

                    <h3>
                        Wahyu
                    </h3>

                    <span>
                        Kitchen Specialist
                    </span>

                </div>

            </div>

        </div>

    </section>

    {{-- ===================================================== --}}
    {{-- STATS --}}
    {{-- ===================================================== --}}
    <section class="stats-section">

        <div class="stats-grid">

            <div class="stats-card">

                <h2>
                    50+
                </h2>

                <p>
                    Menu Variants
                </p>

            </div>

            <div class="stats-card">

                <h2>
                    1000+
                </h2>

                <p>
                    Happy Customers
                </p>

            </div>

            <div class="stats-card">

                <h2>
                    24/7
                </h2>

                <p>
                    System Monitoring
                </p>

            </div>

            <div class="stats-card">

                <h2>
                    404
                </h2>

                <p>
                    Coffee Vibes
                </p>

            </div>

        </div>

    </section>

    {{-- ===================================================== --}}
    {{-- CTA --}}
    {{-- ===================================================== --}}
    <section class="cta-section">

        <div class="cta-orb"></div>

        <h2>

            Ready To Experience
            404.Coffee?

        </h2>

        <p>

            Explore our handcrafted menu and
            enjoy a premium modern coffee experience.

        </p>

        <a href="{{ route('customer.menu') }}"
           class="cta-btn">

            Explore Menu

            <i class="fa-solid fa-arrow-right"></i>

        </a>

    </section>

</div>

@endsection