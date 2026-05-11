<div class="transaction-card">

    <div class="transaction-header">

        <h2>
            Recent Orders
        </h2>

    </div>

    <div class="transaction-table">

        <table>

            <thead>

                <tr>

                    <th>Order</th>

                    <th>Customer</th>

                    <th>Payment</th>

                    <th>Total</th>

                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

                @forelse($recentOrders as $order)

                    <tr>

                        <td>

                            {{ $order->order_number }}

                        </td>

                        <td>

                            {{ $order->customer_name }}

                        </td>

                        <td>

                            {{ strtoupper($order->payment_method) }}

                        </td>

                        <td>

                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}

                        </td>

                        <td>

                            <span class="status-badge">

                                {{ strtoupper($order->status) }}

                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5">

                            No order data

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>