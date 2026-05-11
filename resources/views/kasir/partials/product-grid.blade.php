<!-- MAIN PRODUCT AREA -->
<main class="main-content">

    <header class="main-header">

        <h1 class="title">
            Menu
        </h1>

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
                       placeholder="Search"
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

                <div class="card-image">

                    <img src="https://via.placeholder.com/150"
                         alt="{{ $product->name }}">

                </div>

                <div class="card-details">

                    <h3 class="card-name">
                        {{ $product->name }}
                    </h3>

                    <p class="price">
                        Rp{{ number_format($product->price) }}
                    </p>

                </div>

                <!-- ADD TO CART -->
                <form action="{{ route('cart.add') }}"
                      method="POST"
                      class="add-to-cart-form">

                    @csrf

                    <input type="hidden"
                           name="product_id"
                           value="{{ $product->id }}">

                    <button type="submit"
                            class="btn btn-add">

                        <i class="fa-solid fa-plus"></i>

                        Tambah

                    </button>

                </form>

            </div>

        @endforeach

    </div>

</main>