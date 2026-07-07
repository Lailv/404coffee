<!-- PAYMENT SECTION -->
<div class="payment-wrapper">

    <div class="payment-card">

        <!-- HEADER -->
        <div class="payment-header">

            <div>

                <h2>
                    Payment
                </h2>

                <p>
                    Complete customer payment information
                </p>

            </div>

        </div>

        <!-- FORM -->
        <form id="checkoutForm"
              action="{{ route('checkout') }}"
              method="POST"
              class="payment-form">

            @csrf

            <!-- CUSTOMER -->
            <div class="form-group">

                <label>
                    Customer Name
                </label>

                <input type="text"
                       name="customer_name"
                       class="form-input"
                       placeholder="Enter customer name..."
                       required>

            </div>

            <!-- PAYMENT METHOD -->
            <div class="form-group">

                <label>
                    Payment Method
                </label>

                <select name="payment_method"
                        class="form-select"
                        required>

                    <option value="cash">
                        Cash
                    </option>

                    <option value="midtrans">
                        Midtrans (QRIS / VA / Kartu)
                    </option>

                </select>

            </div>

            <!-- TOTAL -->
            <div class="payment-total">

                <span>
                    Total Payment
                </span>

                <strong>

                    Rp{{ number_format($total) }}

                </strong>

            </div>

            <!-- ACTION -->
            <div class="payment-actions">

                <!-- CHECKOUT -->
                <button type="submit"
                        class="payment-btn primary">

                    <i class="fa-solid fa-credit-card"></i>

                    Checkout

                </button>

            </div>

        </form>

    </div>

</div>

{{-- Snap.js sudah di-load secara global di kasir/pos.blade.php,
     jadi TIDAK perlu load ulang di sini. --}}
