<!-- QRIS MODAL -->
<div id="qrisModal"
     class="qris-overlay">

    <div class="qris-card">

        <!-- HEADER -->
        <div class="qris-header">

            <div>

                <h2>
                    QRIS Payment
                </h2>

                <p>
                    Scan the QR code to complete the payment
                </p>

            </div>

            <button
                onclick="closeQrisModal()"
                class="qris-close-btn">

                <i class="fa-solid fa-xmark"></i>

            </button>

        </div>

        <!-- BODY -->
        <div class="qris-body">

            <div class="qris-image-wrapper">

                <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=404Coffee"
                     alt="QRIS"
                     class="qris-image">

            </div>

            <div class="qris-info">

                <div class="qris-badge">

                    <i class="fa-solid fa-shield"></i>

                    Secure Payment

                </div>

                <p class="scan-text">

                    Open your mobile banking or e-wallet app and scan the QR code above.

                </p>

            </div>

        </div>

        <!-- FOOTER -->
        <div class="qris-footer">

            <button
                onclick="closeQrisModal()"
                class="qris-btn secondary">

                Close

            </button>

            <button
                class="qris-btn primary">

                Payment Completed

            </button>

        </div>

    </div>

</div>