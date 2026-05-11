<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        404 Coffee POS
    </title>

    <!-- POS CSS -->
    <link rel="stylesheet"
          href="/css/kasir/pos.css?v=1">

    <!-- RECEIPT CSS -->
    <link rel="stylesheet"
          href="{{ asset('css/kasir/receipt.css') }}">

    <!-- FONT AWESOME -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
          rel="stylesheet">

</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->
    @include('kasir.partials.sidebar')

    <!-- PRODUCT GRID -->
    @include('kasir.partials.product-grid')

    <!-- CART -->
    @include('kasir.partials.cart')

</div>

<!-- QRIS MODAL -->
@include('kasir.partials.qris-modal')

<!-- RECEIPT MODAL -->
@if(session('show_receipt') && $order)

    @include('kasir.partials.receipt-modal')

@endif

<!-- JS -->
<script src="{{ asset('js/kasir/cart.js') }}"></script>

<script src="{{ asset('js/kasir/payment.js') }}"></script>

<script src="{{ asset('js/kasir/qris-modal.js') }}"></script>

</body>
</html>