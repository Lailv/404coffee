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

                        <!-- REMOVE -->
                        <form action="{{ route('cart.remove') }}"
                              method="POST"
                              class="remove-item-form">

                            @csrf

                            <input type="hidden"
                                   name="product_id"
                                   value="{{ $id }}">

                            <button type="submit"
                                    class="remove-btn"
                                    title="Hapus item">

                                <i class="fa-solid fa-trash"></i>

                            </button>

                        </form>

                        <!-- QTY -->
                        <div class="qty-control">

                            <!-- DECREASE -->
                            <form action="{{ route('cart.update') }}"
                                  method="POST">

                                @csrf

                                <input type="hidden"
                                       name="product_id"
                                       value="{{ $id }}">

                                <input type="hidden"
                                       name="action"
                                       value="decrease">

                                <button type="submit"
                                        class="qty-btn">

                                    <i class="fa-solid fa-minus"></i>

                                </button>

                            </form>

                            <!-- QTY (MANUAL INPUT) -->
                            <form action="{{ route('cart.update') }}"
                                  method="POST"
                                  class="qty-input-form">

                                @csrf

                                <input type="hidden"
                                       name="product_id"
                                       value="{{ $id }}">

                                <input type="number"
                                       name="qty"
                                       value="{{ $item['qty'] }}"
                                       min="1"
                                       max="99"
                                       class="qty-input"
                                       onchange="this.form.submit()">

                            </form>

                            <!-- INCREASE -->
                            <form action="{{ route('cart.update') }}"
                                  method="POST">

                                @csrf

                                <input type="hidden"
                                       name="product_id"
                                       value="{{ $id }}">

                                <input type="hidden"
                                       name="action"
                                       value="increase">

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

<style>
    /* QTY MANUAL INPUT & REMOVE BUTTON (POS) - scoped styles since pos.css was not provided */
    .cart-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .qty-input-form {
        display: inline-flex;
    }

    .qty-input {
        width: 44px;
        text-align: center;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        padding: 4px 2px;
        font-size: 13px;
        font-family: inherit;
        -moz-appearance: textfield;
    }

    .remove-item-form {
        display: inline-flex;
    }

    .remove-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        border: none;
        border-radius: 6px;
        background: #fee2e2;
        color: #b91c1c;
        cursor: pointer;
        transition: background .15s;
    }

    .remove-btn:hover {
        background: #fecaca;
    }
</style>
