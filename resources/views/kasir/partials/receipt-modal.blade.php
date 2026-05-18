<div class="receipt-overlay">

    <div class="receipt-wrapper">

        <div class="receipt-card">

            <!-- HEADER -->
            <div class="receipt-header">

                <div class="receipt-brand">

                    <div class="receipt-logo">

                        <i class="fa-solid fa-mug-hot"></i>

                    </div>

                    <div>

                        <h1>
                            404.Coffee
                        </h1>

                        <p>
                            ERP POS Receipt
                        </p>

                    </div>

                </div>

                <div class="receipt-date">

                    {{ $order->created_at->format('d M Y • H:i') }}

                </div>

            </div>

            <!-- STORE -->
            <div class="receipt-store">

                <p>
                    Bekasi, Indonesia
                </p>

                <span>
                    support@404coffee.com
                </span>

            </div>

            <!-- INFO -->
            <div class="receipt-info-grid">

                <div class="receipt-info-card">

                    <label>
                        Invoice
                    </label>

                    <strong>
                        {{ $order->order_number }}
                    </strong>

                </div>

                <div class="receipt-info-card">

                    <label>
                        Customer
                    </label>

                    <strong>
                        {{ $order->customer_name ?? 'Guest' }}
                    </strong>

                </div>

                <div class="receipt-info-card">

                    <label>
                        Payment
                    </label>

                    <strong>
                        {{ strtoupper($order->payment_method) }}
                    </strong>

                </div>

                <div class="receipt-info-card">

                    <label>
                        Total
                    </label>

                    <strong class="total-highlight">
                        Rp{{ number_format($order->total_amount) }}
                    </strong>

                </div>

            </div>

            <!-- TABLE -->
            <div class="receipt-table-wrapper">

                <table class="receipt-table">

                    <thead>

                    <tr>

                        <th>
                            Item
                        </th>

                        <th>
                            Qty
                        </th>

                        <th>
                            Total
                        </th>

                    </tr>

                    </thead>

                    <tbody>

                    @foreach($items as $item)

                        <tr>

                            <td>

                                <div class="receipt-item-name">

                                    {{ $item->product->name ?? '' }}

                                </div>

                                @if($item->note)

                                    <div class="receipt-note">

                                        {{ $item->note }}

                                    </div>

                                @endif

                            </td>

                            <td>
                                {{ $item->qty }}
                            </td>

                            <td>

                                Rp{{ number_format($item->price * $item->qty) }}

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

            <!-- FOOTER -->
            <div class="receipt-footer">

                <p>
                    Thank you for visiting 404.Coffee
                </p>

                <span>
                    ERP Management System
                </span>

            </div>

            <!-- ACTIONS -->
            <div class="receipt-actions">

                <!-- PRINT -->
                <button
                    onclick="window.print()"
                    class="receipt-btn primary">

                    <i class="fa-solid fa-print"></i>

                    Print

                </button>

                <!-- SAVE -->
                <button
                    onclick="window.print()"
                    class="receipt-btn secondary">

                    <i class="fa-solid fa-download"></i>

                    Save PDF

                </button>

                <!-- CLOSE -->
                <a href="{{ route('pos') }}"
                   class="receipt-btn danger">

                    <i class="fa-solid fa-xmark"></i>

                    Close

                </a>

            </div>

        </div>

    </div>

</div>