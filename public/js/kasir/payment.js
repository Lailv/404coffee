document.addEventListener(

    'DOMContentLoaded',

    function () {

        const checkoutForm =
            document.getElementById(
                'checkoutForm'
            );

        const qrisModal =
            document.getElementById(
                'qrisModal'
            );

        if (checkoutForm) {

            checkoutForm.addEventListener(

                'submit',

                function (e) {

                    const paymentMethod =

                        document.querySelector(
                            'input[name="payment_method"]:checked'
                        ).value;

                    if (
                        paymentMethod
                        ===
                        'qris'
                    ) {

                        e.preventDefault();

                        qrisModal.style.display =
                            'flex';
                    }
                }
            );
        }
    }
);

// SUBMIT CHECKOUT
function submitCheckout() {

    const checkoutForm =
        document.getElementById(
            'checkoutForm'
        );

    if (checkoutForm) {

        checkoutForm.submit();
    }
}