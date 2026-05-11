<!-- CART SECTION -->
<aside class="cart-section">

    <!-- HEADER -->
    <div class="cart-header">

        <div class="cart-title">

            <div class="cart-title-left">

                <i class="fa-solid fa-cart-shopping"></i>

                <h2>
                    Shopping Cart
                </h2>

            </div>

            <span class="cart-count">

                {{ count(session('cart', [])) }}

            </span>

        </div>

    </div>

    <!-- CART ITEMS -->
    <div class="cart-items">

        @forelse(session('cart', []) as $id => $item)

            <div class="cart-item">

                <!-- PRODUCT IMAGE -->
                <div class="cart-image">

                    <img src="https://via.placeholder.com/80"
                         alt="{{ $item['name'] }}">

                </div>

                <!-- PRODUCT INFO -->
                <div class="cart-info">

                    <!-- PRODUCT NAME -->
                    <h4 class="cart-product-name">

                        {{ $item['name'] }}

                    </h4>

                    <!-- PRODUCT PRICE -->
                    <p class="cart-price">

                        Rp{{ number_format($item['price']) }}

                    </p>

                    <!-- CUSTOMER NOTE -->
                    <div class="item-note">

                        <textarea
                            class="note-input"

                            name="notes[{{ $item['id'] }}]"

                            form="checkoutForm"

                            placeholder="Catatan pelanggan..."></textarea>

                    </div>

                    <!-- QTY CONTROL -->
                    <div class="qty-control">

                        <!-- DECREASE -->
                        <form action="{{ route('cart.decrease') }}"
                              method="POST">

                            @csrf

                            <input type="hidden"
                                   name="product_id"
                                   value="{{ $id }}">

                            <button type="submit"
                                    class="qty-btn">

                                <i class="fa-solid fa-minus"></i>

                            </button>

                        </form>

                        <!-- QTY -->
                        <span class="qty-number">

                            {{ $item['qty'] }}

                        </span>

                        <!-- INCREASE -->
                        <form action="{{ route('cart.increase') }}"
                              method="POST">

                            @csrf

                            <input type="hidden"
                                   name="product_id"
                                   value="{{ $id }}">

                            <button type="submit"
                                    class="qty-btn">

                                <i class="fa-solid fa-plus"></i>

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <!-- EMPTY CART -->
            <div class="empty-cart">

                <i class="fa-solid fa-cart-shopping"></i>

                <p>
                    Cart masih kosong
                </p>

            </div>

        @endforelse

    </div>

    <!-- FOOTER -->
    <div class="cart-footer">

        <!-- PAYMENT -->
        @include('kasir.partials.payment-box')

    </div>

</aside>