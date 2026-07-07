document.addEventListener('DOMContentLoaded', () => {

    /* ======================================================
       ELEMENTS
    ====================================================== */

    const checkoutForm = document.getElementById('checkoutForm');

    const paymentMethod = document.querySelector('[name="payment_method"]');

    const noteInputs = document.querySelectorAll('.note-input');

    /* ======================================================
       AUTO RESIZE NOTE
    ====================================================== */

    const autoResizeTextarea = (textarea) => {

        textarea.style.height = 'auto';

        textarea.style.height = textarea.scrollHeight + 'px';

    };

    noteInputs.forEach(input => {

        autoResizeTextarea(input);

        input.addEventListener('input', () => {

            autoResizeTextarea(input);

        });

    });

    /* ======================================================
       STUB: modal QRIS statis lama sudah diganti Snap.js asli.
       Fungsi ini dipertahankan sebagai no-op supaya tidak error
       kalau masih ada onclick="openQrisModal()" tersisa di blade lama.
       Setelah kamu pastikan tidak ada lagi pemanggilnya, boleh dihapus.
    ====================================================== */

    window.openQrisModal = () => {
        console.warn('openQrisModal() sudah tidak dipakai — sekarang pakai Snap.js.');
    };

    window.closeQrisModal = () => {};

    /* ======================================================
       CHECKOUT SUBMIT HANDLER
       - Cash  -> submit form biasa (redirect ke /pos, TIDAK berubah)
       - Midtrans -> AJAX, buka Snap popup
    ====================================================== */

    if (checkoutForm) {

        checkoutForm.addEventListener('submit', function (e) {

            const method = paymentMethod ? paymentMethod.value : 'cash';

            if (method === 'midtrans') {

                e.preventDefault();

                handleMidtransCheckout(checkoutForm);

            }

            // method === 'cash' -> biarkan form submit normal

        });

    }

    /* ======================================================
       LOADING STATE TOMBOL
    ====================================================== */

    const setCheckoutLoading = (isLoading) => {

        const btn = checkoutForm
            ? checkoutForm.querySelector('button[type="submit"]')
            : null;

        if (!btn) return;

        if (isLoading) {

            btn.dataset.originalText = btn.innerHTML;

            btn.disabled = true;

            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';

        } else {

            btn.disabled = false;

            if (btn.dataset.originalText) {

                btn.innerHTML = btn.dataset.originalText;

            }

        }

    };

    /* ======================================================
       AJAX CHECKOUT -> MIDTRANS
    ====================================================== */

    const handleMidtransCheckout = async (form) => {

        setCheckoutLoading(true);

        try {

            const formData = new FormData(form);

            const response = await fetch(form.action, {

                method: 'POST',

                headers: {
                    'Accept': 'application/json',
                },

                body: formData,

            });

            const data = await response.json();

            if (!data.success) {

                alert(data.message || 'Gagal membuat order');

                setCheckoutLoading(false);

                return;

            }

            openSnapPopup(data);

        } catch (err) {

            console.error(err);

            alert('Terjadi kesalahan saat memproses pembayaran');

            setCheckoutLoading(false);

        }

    };

    /* ======================================================
       BUKA SNAP POPUP
    ====================================================== */

    const openSnapPopup = (data) => {

        if (typeof snap === 'undefined') {

            alert('Snap.js belum termuat. Cek koneksi internet / client key Midtrans.');

            setCheckoutLoading(false);

            return;

        }

        snap.pay(data.snap_token, {

            onSuccess: function () {

                finalizePayment(data.order_id);

            },

            onPending: function () {

                setCheckoutLoading(false);

                alert(
                    'Menunggu pembayaran. Order tersimpan sebagai pending (' +
                    data.order_number +
                    '). Cek kembali status setelah pembayaran selesai.'
                );

                window.location.reload();

            },

            onError: function () {

                setCheckoutLoading(false);

                alert('Pembayaran gagal. Silakan coba lagi.');

            },

            onClose: function () {

                setCheckoutLoading(false);

                alert(
                    'Popup ditutup sebelum selesai. Order (' +
                    data.order_number +
                    ') masih tersimpan sebagai pending, silakan coba bayar lagi dari halaman receipt.'
                );

                window.location.reload();

            },

        });

    };

    /* ======================================================
       FINALIZE PAYMENT (setelah Snap onSuccess)
    ====================================================== */

    const finalizePayment = async (orderId) => {

        try {

            const csrfInput = document.querySelector('input[name="_token"]');

            const response = await fetch(`/payment/success/${orderId}`, {

                method: 'POST',

                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfInput ? csrfInput.value : '',
                },

            });

            const data = await response.json();

            if (data.success) {

                // Redirect ke /pos (bukan /receipt/{id}) supaya session
                // flash show_receipt & last_order_id kebaca oleh
                // POSController@index dan modal receipt muncul otomatis,
                // sama persis seperti alur cash.
                window.location.href = '/pos';

            } else {

                alert('Pembayaran sukses tapi gagal finalisasi. Hubungi admin.');

                setCheckoutLoading(false);

            }

        } catch (err) {

            console.error(err);

            alert('Pembayaran sukses tapi terjadi error saat finalisasi. Hubungi admin.');

            setCheckoutLoading(false);

        }

    };

    /* ======================================================
       PRINT RECEIPT
    ====================================================== */

    window.printReceipt = () => {

        window.print();

    };

});
