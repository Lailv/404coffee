<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Kitchen Display
    </title>

    <!-- FONT -->
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

<div class="kitchen-container">

    <!-- HEADER -->
    <div class="kitchen-header">

        <h1>

            <i class="fa-solid fa-utensils"></i>

            Kitchen Display

        </h1>

        <span id="kitchen-clock"></span>

    </div>

    <!-- ORDERS -->
    <div class="orders-grid">

        @forelse($orders as $order)

            <div class="order-card">

                <!-- TOP -->
                <div class="order-top">

                    <div>

                        <h2>

                            {{ $order->order_number }}

                        </h2>

                        <p>

                            {{ $order->customer_name }}

                        </p>

                        <p class="order-time">

                            🕐 {{ $order->created_at->diffForHumans() }}

                        </p>

                    </div>

                    <div class="order-status">

                        PENDING

                    </div>

                </div>

                <!-- ITEMS -->
                <div class="order-items">

                    @foreach($order->items as $item)

                        <div class="kitchen-item">

                            <div>

                                <strong>

                                    {{ $item->product->name }}

                                </strong>

                                <p>

                                    Qty: {{ $item->qty }}

                                </p>

                                @if($item->note)

                                    <div class="kitchen-note">

                                        {{ $item->note }}

                                    </div>

                                @endif

                            </div>

                        </div>

                    @endforeach

                </div>

                <!-- DONE BUTTON -->
                <form action="{{ route('kitchen.done', $order->id) }}"
                      method="POST">

                    @csrf

                    <button class="done-btn">

                        <i class="fa-solid fa-check"></i>

                        DONE

                    </button>

                </form>

            </div>

        @empty

            <div class="empty-order">

                Tidak ada order pending ☕

            </div>

        @endforelse

    </div>

</div>

<!-- AUDIO -->
<audio
    id="notifSound"
    src="{{ asset('sounds/ding.mp3') }}">
</audio>

<!-- JS -->
<script src="{{ asset('js/kitchen/kitchen.js') }}"></script>

</body>
</html>