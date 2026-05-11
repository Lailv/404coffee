<!-- QRIS MODAL -->
<div id="qrisModal"
     class="modal">

    <div class="modal-content">

        <div class="modal-header">

            <h2>
                QRIS Payment
            </h2>

            <button
                onclick="closeQrisModal()"
                class="close-modal">

                &times;

            </button>

        </div>

        <div class="modal-body">

            <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=404Coffee"
                 alt="QRIS"
                 class="qris-image">

            <p class="scan-text">

                Scan QR untuk pembayaran

            </p>

        </div>

        <div class="modal-footer">

            <button
                onclick="closeQrisModal()"
                class="btn-close">

                Tutup

            </button>

        </div>

    </div>

</div>