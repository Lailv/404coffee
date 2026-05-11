<!-- PAYMENT SECTION -->
<div class="payment-section">

    <form
        id="checkoutForm"

        action="{{ route('checkout') }}"

        method="POST">

        @csrf

        <!-- CUSTOMER NAME -->
        <div class="customer-form">

            <label>

                Nama Customer

            </label>

            <input
                type="text"

                name="customer_name"

                class="customer-input"

                placeholder="Input nama customer..."

                required>

        </div>

        <!-- PAYMENT METHOD -->
        <div class="payment-method">

            <label>

                Payment Method

            </label>

            <select
                name="payment_method"

                required>

                <option value="cash">

                    Cash

                </option>

                <option value="qris">

                    QRIS

                </option>

                <option value="debit">

                    Debit

                </option>

            </select>

        </div>

        <!-- TOTAL -->
        <div class="payment-total">

            <span>
                Total
            </span>

            <strong>

                Rp{{ number_format($total) }}

            </strong>

        </div>

        <!-- CHECKOUT BUTTON -->
        <button
            type="submit"

            class="checkout-btn">

            <i class="fa-solid fa-credit-card"></i>

            Checkout

        </button>

    </form>

    <!-- QRIS BUTTON -->
    <button
        onclick="openQrisModal()"

        class="qris-btn">

        <i class="fa-solid fa-qrcode"></i>

        Show QRIS

    </button>

</div>