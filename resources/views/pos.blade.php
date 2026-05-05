<!DOCTYPE html>
<html>
<head>
    <title>404 Coffee POS</title>
    <link rel="stylesheet" href="{{ asset('css/pos.css') }}">
</head>
<body>

<div class="layout">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="user">👤 Lail</div>

        <div class="menu-item active">All Menu</div>
        <div class="menu-item">Coffee</div>
        <div class="menu-item">Drink</div>
        <div class="menu-item">Food</div>
    </div>

    <!-- MAIN -->
    <div class="main">
        <div class="title">Menu</div>

        <div class="grid">
            @foreach($products as $product)
                <div class="card">
                    <img src="https://via.placeholder.com/150">

                    <div class="card-name">{{ $product->name }}</div>
                    <div class="price">Rp{{ $product->price }}</div>

                    <button class="btn">+ Tambah</button>
                </div>
            @endforeach
        </div>
    </div>

    <!-- CART -->
    <div class="cart">
        <div class="cart-title">Order</div>

        <div class="cart-item">

            <div class="cart-left">
                <img src="https://via.placeholder.com/60">

                <div>
                    <strong>Latte</strong>

                    <div class="qty-control">
                        <button>-</button>
                        <span>2</span>
                        <button>+</button>
                    </div>

                    <div class="note">
                        <input type="text" placeholder="Tambahkan catatan...">
                    </div>
                </div>
            </div>

            <div>Rp40.000</div>

        </div>

        <div class="total">Total: Rp40.000</div>

        <button class="checkout">Bayar</button>
    </div>

</div>

</body>
</html>