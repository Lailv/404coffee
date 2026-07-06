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
    {{-- SEARCH & FILTER TOOLBAR --}}
    {{-- ===================================================== --}}
    <div class="menu-toolbar">

        <div class="menu-search">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input type="text"
                   id="menuSearchInput"
                   placeholder="Cari menu favoritmu...">

            <button type="button"
                    id="menuSearchClear"
                    class="menu-search-clear"
                    aria-label="Clear search">

                <i class="fa-solid fa-xmark"></i>

            </button>

        </div>

        <div class="menu-filters" id="menuFilters">

            <button type="button" class="filter-chip active" data-filter="all">
                All Menu
            </button>

            <button type="button" class="filter-chip" data-filter="coffee">
                Coffee
            </button>

            <button type="button" class="filter-chip" data-filter="non-coffee">
                Non Coffee
            </button>

            <button type="button" class="filter-chip" data-filter="food">
                Food
            </button>

        </div>

    </div>

    <div class="menu-no-result" id="menuNoResult">

        <i class="fa-solid fa-mug-hot"></i>

        <h3>No Menu Found</h3>

        <p>Coba kata kunci lain atau ganti kategori filter.</p>

    </div>

    {{-- ===================================================== --}}
    {{-- COFFEE --}}
    {{-- ===================================================== --}}
    <section class="menu-section" data-category="coffee">

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

                <div class="menu-card" data-name="{{ strtolower($product->name) }}">

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

                        {{-- RATING --}}
                        <div class="menu-rating">

                            @for($i = 1; $i <= 5; $i++)

                                @if($i <= round($product->rating ?? 0))

                                    <i class="fa-solid fa-star"></i>

                                @else

                                    <i class="fa-regular fa-star"></i>

                                @endif

                            @endfor

                            <span class="rating-value">

                                {{ number_format($product->rating ?? 0, 1) }}

                            </span>

                            <span class="rating-count">

                                ({{ $product->rating_count ?? 0 }})

                            </span>

                        </div>

                        {{-- STOCK INFO --}}
                        <div class="stock-info stock-info--{{ $product->stock_status }}">

                            <span class="stock-qty">

                                Stok: {{ $product->stock }}

                            </span>

                            @if($product->stock_status == 'out')

                                <span class="stock-badge stock-badge--out">

                                    <i class="fa-solid fa-circle-xmark"></i>
                                    Habis

                                </span>

                            @elseif($product->stock_status == 'low')

                                <span class="stock-badge stock-badge--low">

                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                    Low Stock

                                </span>

                            @else

                                <span class="stock-badge stock-badge--ready">

                                    <i class="fa-solid fa-circle-check"></i>
                                    Ready

                                </span>

                            @endif

                        </div>

                        <div class="menu-footer">

                            <div class="menu-price">

                                Rp {{ number_format($product->price, 0, ',', '.') }}

                            </div>

                            <form action="{{ route('customer.cart.add', $product->id) }}"
                                  method="POST">

                                @csrf

                                <button type="submit"
                                        class="menu-btn"
                                        {{ $product->stock_status == 'out' ? 'disabled' : '' }}>

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
    <section class="menu-section" data-category="non-coffee">

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

                <div class="menu-card" data-name="{{ strtolower($product->name) }}">

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

                        {{-- RATING --}}
                        <div class="menu-rating">

                            @for($i = 1; $i <= 5; $i++)

                                @if($i <= round($product->rating ?? 0))

                                    <i class="fa-solid fa-star"></i>

                                @else

                                    <i class="fa-regular fa-star"></i>

                                @endif

                            @endfor

                            <span class="rating-value">

                                {{ number_format($product->rating ?? 0, 1) }}

                            </span>

                            <span class="rating-count">

                                ({{ $product->rating_count ?? 0 }})

                            </span>

                        </div>

                        {{-- STOCK INFO --}}
                        <div class="stock-info stock-info--{{ $product->stock_status }}">

                            <span class="stock-qty">

                                Stok: {{ $product->stock }}

                            </span>

                            @if($product->stock_status == 'out')

                                <span class="stock-badge stock-badge--out">

                                    <i class="fa-solid fa-circle-xmark"></i>
                                    Habis

                                </span>

                            @elseif($product->stock_status == 'low')

                                <span class="stock-badge stock-badge--low">

                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                    Low Stock

                                </span>

                            @else

                                <span class="stock-badge stock-badge--ready">

                                    <i class="fa-solid fa-circle-check"></i>
                                    Ready

                                </span>

                            @endif

                        </div>

                        <div class="menu-footer">

                            <div class="menu-price">

                                Rp {{ number_format($product->price, 0, ',', '.') }}

                            </div>

                            <form action="{{ route('customer.cart.add', $product->id) }}"
                                  method="POST">

                                @csrf

                                <button type="submit"
                                        class="menu-btn"
                                        {{ $product->stock_status == 'out' ? 'disabled' : '' }}>

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
    <section class="menu-section" data-category="food">

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

                <div class="menu-card" data-name="{{ strtolower($product->name) }}">

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

                        {{-- RATING --}}
                        <div class="menu-rating">

                            @for($i = 1; $i <= 5; $i++)

                                @if($i <= round($product->rating ?? 0))

                                    <i class="fa-solid fa-star"></i>

                                @else

                                    <i class="fa-regular fa-star"></i>

                                @endif

                            @endfor

                            <span class="rating-value">

                                {{ number_format($product->rating ?? 0, 1) }}

                            </span>

                            <span class="rating-count">

                                ({{ $product->rating_count ?? 0 }})

                            </span>

                        </div>

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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput  = document.getElementById('menuSearchInput');
    const clearBtn      = document.getElementById('menuSearchClear');
    const filterChips    = document.querySelectorAll('.filter-chip');
    const sections     = document.querySelectorAll('.menu-section[data-category]');
    const noResultBox   = document.getElementById('menuNoResult');

    let activeFilter = 'all';

    function applyFilter() {

        const keyword = searchInput.value.trim().toLowerCase();

        clearBtn.classList.toggle('is-visible', keyword.length > 0);

        let totalVisible = 0;

        sections.forEach(function (section) {

            const category      = section.dataset.category;
            const matchCategory = activeFilter === 'all' || activeFilter === category;

            if (!matchCategory) {
                section.style.display = 'none';
                return;
            }

            section.style.display = '';

            const cards = section.querySelectorAll('.menu-card');
            let visibleInSection = 0;

            cards.forEach(function (card) {

                const name  = card.dataset.name || '';
                const match = name.includes(keyword);

                card.style.display = match ? '' : 'none';

                if (match) {
                    visibleInSection++;
                    totalVisible++;
                }

            });

            section.style.display = (visibleInSection === 0 && cards.length > 0)
                ? 'none'
                : '';

        });

        noResultBox.classList.toggle('is-visible', totalVisible === 0);

    }

    searchInput.addEventListener('input', applyFilter);

    clearBtn.addEventListener('click', function () {
        searchInput.value = '';
        applyFilter();
        searchInput.focus();
    });

    filterChips.forEach(function (chip) {

        chip.addEventListener('click', function () {

            filterChips.forEach(function (c) {
                c.classList.remove('active');
            });

            chip.classList.add('active');
            activeFilter = chip.dataset.filter;

            applyFilter();

        });

    });

});
</script>
@endpush
