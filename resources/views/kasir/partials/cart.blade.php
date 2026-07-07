<!-- CART SECTION -->
<aside class="cart-wrapper">

    <!-- HEADER -->
    <div class="cart-header">

        <div class="cart-header-left">

            <div class="cart-icon">

                <i class="fa-solid fa-cart-shopping"></i>

            </div>

            <div>

                <h2>
                    Shopping Cart
                </h2>

                <p>
                    {{ count(session('cart', [])) }} item
                </p>

            </div>

        </div>

        <div class="cart-badge">

            {{ count(session('cart', [])) }}

        </div>

    </div>

    <!-- ITEMS -->
    <div class="cart-items">

        @forelse(session('cart', []) as $id => $item)

            <div class="cart-item-card">

                <!-- IMAGE -->
                <div class="cart-image">

                    @if(!empty($item['image']))

                        <img src="{{ asset('storage/' . $item['image']) }}"
                             alt="{{ $item['name'] }}">

                    @else

                        <img src="https://via.placeholder.com/100"
                             alt="{{ $item['name'] }}">

                    @endif

                </div>

                <!-- CONTENT -->
                <div class="cart-content">

                    <!-- INFO -->
                    <div class="cart-info">

                        <h4 class="cart-product-name">

                            {{ $item['name'] }}

                        </h4>

                        <p class="cart-price">

                            Rp{{ number_format($item['price']) }}

                        </p>

                    </div>

                    <!-- NOTE -->
                    <div class="cart-note">

                        <textarea
                            class="note-input"
                            name="notes[{{ $item['id'] }}]"
                            form="checkoutForm"
                            placeholder="Customer note..."></textarea>

                    </div>

                    <!-- BOTTOM -->
                    <div class="cart-bottom">

                        <!-- QTY -->
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

                        <!-- SUBTOTAL -->
                        <div class="cart-subtotal">

                            Rp{{ number_format($item['price'] * $item['qty']) }}

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <!-- EMPTY -->
            <div class="empty-cart">

                <div class="empty-cart-icon">

                    <i class="fa-solid fa-cart-shopping"></i>

                </div>

                <h3>
                    Cart is empty
                </h3>

                <p>
                    Add menu items to start a new transaction
                </p>

            </div>

        @endforelse

    </div>

    <!-- FOOTER -->
    <div class="cart-footer">

        @include('kasir.partials.payment-box')

    </div>

</aside>
