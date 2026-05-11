<div class="best-seller-card">

    <div class="best-header">

        <h2>
            Best Seller Menu
        </h2>

    </div>

    @if($bestSeller)

        <div class="best-item">

            <div>

                <h3>

                    {{ $bestSeller->product->name }}

                </h3>

                <p>

                    Total Sold:
                    {{ $bestSeller->total_qty }}

                </p>

            </div>

            <div class="best-badge">

                BEST SELLER

            </div>

        </div>

    @else

        <div class="empty-finance">

            No sales data available

        </div>

    @endif

</div>