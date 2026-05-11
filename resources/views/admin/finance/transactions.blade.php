<div class="transaction-card">

    <div class="transaction-header">

        <h2>
            Finance Transactions
        </h2>

    </div>

    <div class="transaction-table">

        <table>

            <thead>

                <tr>

                    <th>Date</th>

                    <th>Type</th>

                    <th>Category</th>

                    <th>Amount</th>

                    <th>Note</th>

                </tr>

            </thead>

            <tbody>

                @forelse($transactions as $transaction)

                    <tr>

                        <td>

                            {{ $transaction->created_at->format('d M Y') }}

                        </td>

                        <td>

                            {{ strtoupper($transaction->type) }}

                        </td>

                        <td>

                            {{ $transaction->category }}

                        </td>

                        <td>

                            Rp {{ number_format($transaction->amount, 0, ',', '.') }}

                        </td>

                        <td>

                            {{ $transaction->note }}

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5">

                            No finance transactions

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>