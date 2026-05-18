<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        404 Coffee Kitchen
    </title>

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
          rel="stylesheet">

    <!-- FONT AWESOME -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet"
          href="{{ asset('css/kitchen/kitchen.css') }}">

</head>

<body>

<div class="kitchen-layout">

    <!-- HEADER -->
    <header class="kitchen-header">

        <div class="kitchen-header-left">

            <div class="kitchen-icon">

                <i class="fa-solid fa-utensils"></i>

            </div>

            <div>

                <h1>
                    Kitchen Display
                </h1>

                <p>
                    Monitor and process customer orders
                </p>

            </div>

        </div>

        <!-- CLOCK -->
        <div class="kitchen-clock-wrapper">

            <span id="kitchen-clock"></span>

        </div>

    </header>

    <!-- ORDERS -->
    <div class="orders-grid">

        @forelse($orders as $order)

            <div class="order-card">

                <!-- TOP -->
                <div class="order-top">

                    <div>

                        <div class="invoice-badge">

                            {{ $order->order_number }}

                        </div>

                        <h2>

                            {{ $order->customer_name ?? 'Guest' }}

                        </h2>

                        <p class="order-time">

                            {{ $order->created_at->diffForHumans() }}

                        </p>

                    </div>

                    <!-- STATUS -->
                    <div class="order-status">

                        Pending

                    </div>

                </div>

                <!-- ITEMS -->
                <div class="order-items">

                    @foreach($order->items as $item)

                        <div class="kitchen-item">

                            <div class="item-info">

                                <strong>

                                    {{ $item->product->name }}

                                </strong>

                                <span>

                                    Qty {{ $item->qty }}

                                </span>

                                @if($item->note)

                                    <div class="kitchen-note">

                                        {{ $item->note }}

                                    </div>

                                @endif

                            </div>

                        </div>

                    @endforeach

                </div>

                <!-- FOOTER -->
                <div class="order-footer">

                    <form action="{{ route('kitchen.done', $order->id) }}"
                          method="POST">

                        @csrf

                        <button class="done-btn">

                            <i class="fa-solid fa-check"></i>

                            Mark as Done

                        </button>

                    </form>

                </div>

            </div>

        @empty

            <!-- EMPTY -->
            <div class="empty-order">

                <div class="empty-icon">

                    <i class="fa-solid fa-mug-hot"></i>

                </div>

                <h3>
                    No pending orders
                </h3>

                <p>
                    All orders have been completed
                </p>

            </div>

        @endforelse

    </div>

</div>

<!-- AUDIO -->
<audio id="notifSound"
       src="{{ asset('sounds/ding.mp3') }}">
</audio>

<!-- JS -->
<script src="{{ asset('js/kitchen/kitchen.js') }}"></script>

</body>
</html>