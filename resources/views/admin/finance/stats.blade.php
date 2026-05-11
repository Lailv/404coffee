<div class="finance-stats">

    <div class="finance-card">

        <span>Today's Revenue</span>

        <h2>
            Rp {{ number_format($todayRevenue, 0, ',', '.') }}
        </h2>

    </div>

    <div class="finance-card">

        <span>Monthly Revenue</span>

        <h2>
            Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}
        </h2>

    </div>

    <div class="finance-card">

        <span>Orders Today</span>

        <h2>
            {{ $todayOrders }}
        </h2>

    </div>

    <div class="finance-card">

        <span>Orders This Month</span>

        <h2>
            {{ $monthlyOrders }}
        </h2>

    </div>

    <div class="finance-card">

        <span>Total Income</span>

        <h2>
            Rp {{ number_format($totalIncome, 0, ',', '.') }}
        </h2>

    </div>

    <div class="finance-card">

        <span>Total Expense</span>

        <h2>
            Rp {{ number_format($totalExpense, 0, ',', '.') }}
        </h2>

    </div>

    <div class="finance-card">

        <span>Net Profit</span>

        <h2>
            Rp {{ number_format($netProfit, 0, ',', '.') }}
        </h2>

    </div>

</div>