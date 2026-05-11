<div class="receipt-overlay">

    <div class="receipt-container">

        <div class="receipt">

            <!-- HEADER -->
            <div class="receipt-header">

                <div class="receipt-logo">

                    <i class="fa-solid fa-mug-hot"></i>

                </div>

                <h1>
                    404.Coffee
                </h1>

                <p>
                    ERP POS Receipt
                </p>

            </div>

            <!-- STORE INFO -->
            <div class="store-info">

                Bekasi, Indonesia
                <br>

                support@404coffee.com

            </div>

            <div class="receipt-line"></div>

            <!-- ORDER INFO -->
            <div class="receipt-info">

                <div class="info-row">

                    <span>
                        Invoice
                    </span>

                    <strong>

                        {{ $order->order_number }}

                    </strong>

                </div>

                <div class="info-row">

                    <span>
                        Customer
                    </span>

                    <strong>

                        {{ $order->customer_name ?? 'Guest' }}

                    </strong>

                </div>

                <div class="info-row">

                    <span>
                        Payment
                    </span>

                    <strong>

                        {{ strtoupper($order->payment_method) }}

                    </strong>

                </div>

                <div class="info-row">

                    <span>
                        Date
                    </span>

                    <strong>

                        {{ $order->created_at->format('d M Y H:i') }}

                    </strong>

                </div>

            </div>

            <div class="receipt-line"></div>

            <!-- ITEMS -->
            <div class="receipt-items">

                @foreach($items as $item)

                    <div class="receipt-item">

                        <div class="item-left">

                            <div class="item-name">

                                {{ $item->product->name ?? '' }}

                            </div>

                            <div class="item-qty">

                                Qty :
                                {{ $item->qty }}

                            </div>

                            <!-- NOTE -->
                            @if($item->note)

                                <div class="item-note-text">

                                    Note:
                                    {{ $item->note }}

                                </div>

                            @endif

                        </div>

                        <div class="item-right">

                            Rp{{ number_format($item->price * $item->qty) }}

                        </div>

                    </div>

                @endforeach

            </div>

            <div class="receipt-line"></div>

            <!-- TOTAL -->
            <div class="receipt-total">

                <span>
                    TOTAL
                </span>

                <strong>

                    Rp{{ number_format($order->total_amount) }}

                </strong>

            </div>

            <!-- FOOTER -->
            <div class="receipt-footer">

                <p>
                    Thank you for visiting ☕
                </p>

                <span>
                    404.Coffee ERP System
                </span>

            </div>

            <!-- ACTION -->
            <div class="receipt-actions">

                <!-- PRINT -->
                <button
                    onclick="window.print()"
                    class="print-btn">

                    <i class="fa-solid fa-print"></i>

                    Print Receipt

                </button>

                <!-- SAVE PDF -->
                <button
                    onclick="window.print()"
                    class="save-btn">

                    <i class="fa-solid fa-download"></i>

                    Save PDF

                </button>

                <!-- CLOSE -->
                <a href="{{ route('pos') }}"
                   class="back-btn">

                    <i class="fa-solid fa-xmark"></i>

                    Close

                </a>

            </div>

        </div>

    </div>

</div>