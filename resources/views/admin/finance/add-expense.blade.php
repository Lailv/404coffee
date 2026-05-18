<div class="transaction-card">

    <div class="transaction-header">

        <h2>
            Add Expense
        </h2>

    </div>

    <form method="POST"
          action="{{ route('admin.finance.expense') }}">

        @csrf

        <div class="expense-form">

            <select name="category" required>

                <option value="">
                    Select Category
                </option>

                <option value="Salary">
                    Salary
                </option>

                <option value="Electricity">
                    Electricity
                </option>

                <option value="Internet">
                    Internet
                </option>

                <option value="Maintenance">
                    Maintenance
                </option>

                <option value="Operational">
                    Operational
                </option>

            </select>


            <input
                type="number"
                name="amount"
                placeholder="Amount"
                required
            >


            <input
                type="text"
                name="note"
                placeholder="Note"
            >


            <button type="submit">

                +Add Expense

            </button>

        </div>

    </form>

</div>