<!-- MAIN PRODUCT AREA -->
<main class="product-wrapper">

    <!-- HEADER -->
    <header class="product-header">

        <div>

            <h1 class="product-title">
                Menu
            </h1>

            <p class="product-subtitle">
                {{ now()->translatedFormat('l, d F Y') }}
            </p>

        </div>

        <!-- SEARCH -->
        <form action="{{ route('pos') }}"
              method="GET"
              class="search-form">

            @if(request('category'))

                <input type="hidden"
                       name="category"
                       value="{{ request('category') }}">

            @endif

            <div class="search-box">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input type="text"
                       name="search"
                       placeholder="Cari menu..."
                       value="{{ request('search') }}"
                       autocomplete="off">

                <button type="submit"
                        class="btn-search">

                    Cari

                </button>

            </div>

        </form>

    </header>

    <!-- PRODUCT GRID -->
    <div class="product-grid">

        @foreach($products as $product)

            <div class="product-card">

                <!-- IMAGE -->
                <div class="card-image">

                    @if($product->image)

                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}">

                    @else

                        <img
                            src="https://via.placeholder.com/300x200"
                            alt="{{ $product->name }}">

                    @endif

                </div>

                <!-- CONTENT -->
                <div class="card-content">

                    <div class="card-info">

                        <h3 class="card-name">

                            {{ $product->name }}

                        </h3>

                        <p class="card-price">

                            Rp{{ number_format($product->price) }}

                        </p>

                        <!-- STOCK INFO -->
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

                    </div>

                    <!-- BUTTON -->
                    <form action="{{ route('cart.add') }}"
                          method="POST"
                          class="add-to-cart-form">

                        @csrf

                        <input type="hidden"
                               name="product_id"
                               value="{{ $product->id }}">

                        <button type="submit"
                                class="btn-add"
                                {{ $product->stock_status == 'out' ? 'disabled' : '' }}>

                            <i class="fa-solid fa-plus"></i>

                            Tambah

                        </button>

                    </form>

                </div>

            </div>

        @endforeach

    </div>

</main>

<style>
    /* STOCK INFO (POS) - scoped styles since pos.css was not provided */
    .stock-info {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        margin-top: 4px;
    }

    .stock-info .stock-qty {
        font-size: 12px;
        color: #6b7280;
    }

    .stock-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 2px 8px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 600;
    }

    .stock-badge--ready {
        background: #dcfce7;
        color: #15803d;
    }

    .stock-badge--low {
        background: #fef3c7;
        color: #b45309;
    }

    .stock-badge--out {
        background: #fee2e2;
        color: #b91c1c;
    }

    .btn-add[disabled] {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>