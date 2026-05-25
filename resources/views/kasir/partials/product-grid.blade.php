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
                                class="btn-add">

                            <i class="fa-solid fa-plus"></i>

                            Tambah

                        </button>

                    </form>

                </div>

            </div>

        @endforeach

    </div>

</main>