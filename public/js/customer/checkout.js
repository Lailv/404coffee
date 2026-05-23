document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | PAYMENT METHOD
    |--------------------------------------------------------------------------
    */

    const paymentMethod = document.getElementById('payment_method');

    const qrisSection = document.getElementById('qris-section');

    function toggleQris() {

        if (paymentMethod.value === 'qris') {

            qrisSection.style.display = 'block';

        } else {

            qrisSection.style.display = 'none';

        }
    }

    toggleQris();

    paymentMethod.addEventListener('change', toggleQris);

    /*
    |--------------------------------------------------------------------------
    | ORDER TYPE
    |--------------------------------------------------------------------------
    */

    const orderType = document.getElementById('order_type');

    const addressField = document.getElementById('address-field');

    function toggleAddress() {

        if (orderType.value === 'delivery') {

            addressField.style.display = 'block';

        } else {

            addressField.style.display = 'none';

        }
    }

    toggleAddress();

    orderType.addEventListener('change', toggleAddress);

});