document.addEventListener('DOMContentLoaded', () => {

    /* ======================================================
       ELEMENTS
    ====================================================== */

    const qrisModal = document.getElementById('qrisModal');

    const paymentMethod = document.querySelector('[name="payment_method"]');

    const noteInputs = document.querySelectorAll('.note-input');

    /* ======================================================
       QRIS MODAL
    ====================================================== */

    const openQrisModal = () => {

        if (!qrisModal) return;

        qrisModal.classList.add('active');

        document.body.style.overflow = 'hidden';

    };

    const closeQrisModal = () => {

        if (!qrisModal) return;

        qrisModal.classList.remove('active');

        document.body.style.overflow = 'auto';

    };

    /* GLOBAL ACCESS */

    window.openQrisModal = openQrisModal;

    window.closeQrisModal = closeQrisModal;

    /* ======================================================
       CLOSE OUTSIDE
    ====================================================== */

    if (qrisModal) {

        qrisModal.addEventListener('click', (e) => {

            if (e.target.classList.contains('qris-overlay')) {

                closeQrisModal();

            }

        });

    }

    /* ======================================================
       AUTO OPEN QRIS
    ====================================================== */

    if (paymentMethod) {

        paymentMethod.addEventListener('change', function () {

            if (this.value === 'qris') {

                openQrisModal();

            }

        });

    }

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
       PRINT RECEIPT
    ====================================================== */

    window.printReceipt = () => {

        window.print();

    };

});