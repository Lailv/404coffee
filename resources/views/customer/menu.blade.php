@extends('customer.layouts.app')

@section('title', 'Menu | 404.Coffee')

@push('styles')

<link rel="stylesheet"
      href="{{ asset('css/customer/menu.css') }}">

@endpush

@section('content')

<div class="customer-menu">

    {{-- ===================================================== --}}
    {{-- HERO --}}
    {{-- ===================================================== --}}
    <section class="menu-hero">

        <div class="menu-hero-inner">

            <span class="menu-eyebrow">

                <span class="eyebrow-dot"></span>

                Crafted Daily • Premium Selection

            </span>

            <h1 class="menu-title">

                Discover Our
                <em>Signature Menu</em>

            </h1>

            <p class="menu-desc">

                Carefully crafted coffee, refreshing drinks,
                and delicious foods designed to elevate
                your coffee experience.

            </p>

        </div>

    </section>

    {{-- ===================================================== --}}
    {{-- COFFEE --}}
    {{-- ===================================================== --}}
    <section class="menu-section">

        <div class="section-heading">

            <span class="section-badge">
                Fresh Brewed
            </span>

            <h2 class="section-title">
                Coffee Selection
            </h2>

        </div>

        <div class="menu-grid">

            @forelse($coffeeProducts as $product)

                <div class="menu-card">

                    <div class="menu-card-glow"></div>

                    {{-- IMAGE --}}
                    <div class="menu-image">

                        @if($product->image)

                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}">

                        @else

                            <img
                                src="https://via.placeholder.com/400x300"
                                alt="{{ $product->name }}">

                        @endif

                    </div>

                    <div class="menu-top">

                        <span class="menu-category">

                            {{ $product->category->name }}

                        </span>

                        <span class="menu-badge">

                            Popular

                        </span>

                    </div>

                    <div class="menu-content">

                        <h3>

                            {{ $product->name }}

                        </h3>

                        <p class="menu-description">

                            Premium handcrafted drink made
                            with selected ingredients.

                        </p>

                        <div class="menu-footer">

                            <div class="menu-price">

                                Rp {{ number_format($product->price, 0, ',', '.') }}

                            </div>

                            <form action="{{ route('customer.cart.add', $product->id) }}"
                                  method="POST">

                                @csrf

                                <button type="submit"
                                        class="menu-btn">

                                    <i class="fa-solid fa-plus"></i>

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @empty

                <div class="empty-menu">

                    <h3>
                        No Coffee Available
                    </h3>

                </div>

            @endforelse

        </div>

    </section>

    {{-- ===================================================== --}}
    {{-- NON COFFEE --}}
    {{-- ===================================================== --}}
    <section class="menu-section">

        <div class="section-heading">

            <span class="section-badge">
                Refreshing Taste
            </span>

            <h2 class="section-title">
                Non Coffee
            </h2>

        </div>

        <div class="menu-grid">

            @forelse($nonCoffeeProducts as $product)

                <div class="menu-card">

                    <div class="menu-card-glow"></div>

                    {{-- IMAGE --}}
                    <div class="menu-image">

                        @if($product->image)

                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}">

                        @else

                            <img
                                src="https://via.placeholder.com/400x300"
                                alt="{{ $product->name }}">

                        @endif

                    </div>

                    <div class="menu-top">

                        <span class="menu-category">

                            {{ $product->category->name }}

                        </span>

                        <span class="menu-badge menu-badge--soft">

                            Fresh

                        </span>

                    </div>

                    <div class="menu-content">

                        <h3>

                            {{ $product->name }}

                        </h3>

                        <p class="menu-description">

                            Smooth and refreshing drinks
                            perfect for every moment.

                        </p>

                        <div class="menu-footer">

                            <div class="menu-price">

                                Rp {{ number_format($product->price, 0, ',', '.') }}

                            </div>

                            <form action="{{ route('customer.cart.add', $product->id) }}"
                                  method="POST">

                                @csrf

                                <button type="submit"
                                        class="menu-btn">

                                    <i class="fa-solid fa-plus"></i>

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @empty

                <div class="empty-menu">

                    <h3>
                        No Non Coffee Available
                    </h3>

                </div>

            @endforelse

        </div>

    </section>

    {{-- ===================================================== --}}
    {{-- FOOD --}}
    {{-- ===================================================== --}}
    <section class="menu-section">

        <div class="section-heading">

            <span class="section-badge">
                Kitchen Special
            </span>

            <h2 class="section-title">
                Fresh Food
            </h2>

        </div>

        <div class="menu-grid">

            @forelse($foodProducts as $product)

                <div class="menu-card">

                    <div class="menu-card-glow"></div>

                    {{-- IMAGE --}}
                    <div class="menu-image">

                        @if($product->image)

                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}">

                        @else

                            <img
                                src="https://via.placeholder.com/400x300"
                                alt="{{ $product->name }}">

                        @endif

                    </div>

                    <div class="menu-top">

                        <span class="menu-category">

                            {{ $product->category->name }}

                        </span>

                        <span class="menu-badge menu-badge--food">

                            Chef Choice

                        </span>

                    </div>

                    <div class="menu-content">

                        <h3>

                            {{ $product->name }}

                        </h3>

                        <p class="menu-description">

                            Delicious dishes prepared fresh
                            directly from our kitchen.

                        </p>

                        <div class="menu-footer">

                            <div class="menu-price">

                                Rp {{ number_format($product->price, 0, ',', '.') }}

                            </div>

                            <form action="{{ route('customer.cart.add', $product->id) }}"
                                  method="POST">

                                @csrf

                                <button type="submit"
                                        class="menu-btn">

                                    <i class="fa-solid fa-plus"></i>

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @empty

                <div class="empty-menu">

                    <h3>
                        No Food Available
                    </h3>

                </div>

            @endforelse

        </div>

    </section>

</div>

@endsection