@extends('admin.layouts.app')

@section('title', 'Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    {{-- Chart.js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js" defer></script>
@endpush

@section('content')

<div class="dashboard-wrapper">

    {{-- ── TOP BAR ── --}}
    <div class="topbar">
        <h1>Dashboard</h1>
        <span class="topbar-date">
            {{ now()->translatedFormat('l, d F Y') }}
        </span>
    </div>

    {{-- ── METRIC CARDS ── --}}
    <div class="dashboard-grid">

        {{-- Revenue --}}
        <div class="card">
            <div class="card-label">
                <i class="ti ti-coin"></i> Revenue hari ini
            </div>
            <div class="card-value">
                Rp{{ number_format($todayRevenue) }}
            </div>
            <div class="card-sub">
                @if($revenueGrowth >= 0)
                    <span class="badge badge-up">↑ {{ abs($revenueGrowth) }}%</span>
                @else
                    <span class="badge badge-down">↓ {{ abs($revenueGrowth) }}%</span>
                @endif
                vs kemarin
            </div>
        </div>

        {{-- Orders --}}
        <div class="card">
            <div class="card-label">
                <i class="ti ti-shopping-cart"></i> Pesanan hari ini
            </div>
            <div class="card-value">{{ $todayOrders }}</div>
            <div class="card-sub">
                @if($orderGrowth >= 0)
                    <span class="badge badge-up">↑ {{ abs($orderGrowth) }}</span>
                @else
                    <span class="badge badge-down">↓ {{ abs($orderGrowth) }}</span>
                @endif
                vs kemarin
            </div>
        </div>

        {{-- Critical Stock --}}
        <div class="card card-critical">
            <div class="card-label">
                <i class="ti ti-alert-triangle"></i> Stok kritis
            </div>
            <div class="card-value">{{ $criticalStocks }}</div>
            <div class="card-sub">
                <span class="badge badge-warn">⚠ Perlu restock</span>
            </div>
        </div>

    </div>

    {{-- ── CHART + TOP PRODUCTS ── --}}
    <div class="row-two">

        {{-- Monthly Revenue Chart --}}
        <div class="panel">
            <div class="panel-header">
                <span class="panel-title">Revenue bulanan</span>
                <div class="tab-group">
                    <a href="#" class="active" data-type="bar">Bar</a>
                    <a href="#" data-type="line">Line</a>
                </div>
            </div>
            <div class="chart-wrap">
                <canvas id="revenueChart"
                        role="img"
                        aria-label="Grafik revenue bulanan">
                </canvas>
            </div>
        </div>

        {{-- Top Products --}}
        <div class="panel">
            <div class="panel-header">
                <span class="panel-title">Produk terlaris</span>
            </div>
            <div class="top-items">
                @foreach($topProducts as $product)
                    <div class="top-item">
                        <span class="top-item-name" title="{{ $product->name }}">
                            {{ $product->name }}
                        </span>
                        <div class="top-item-bar-bg">
                            <div class="top-item-bar"
                                 style="width: {{ $product->percentage }}%">
                            </div>
                        </div>
                        <span class="top-item-pct">{{ $product->percentage }}%</span>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    {{-- ── RECENT TRANSACTIONS ── --}}
    <div class="panel">
        <div class="panel-header">
            <span class="panel-title">Transaksi terbaru</span>
            <span style="font-size:12px; color:#6b7280;">
                Hari ini &middot; {{ $todayOrders }} transaksi
            </span>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                    <tr>
                        <td class="td-invoice">
                            {{ $order->order_number }}
                        </td>
                        <td>
                            <div class="customer-cell">
                                <div class="avatar">
                                    {{-- Inisial 2 huruf dari nama pelanggan --}}
                                    {{ strtoupper(substr($order->customer_name ?? 'U', 0, 1)) }}{{ strtoupper(substr(strstr($order->customer_name ?? ' U', ' '), 1, 1)) }}
                                </div>
                                {{ $order->customer_name ?? '-' }}
                            </div>
                        </td>
                        <td style="font-weight:600;">
                            Rp{{ number_format($order->total_amount) }}
                        </td>
                        <td>
                            @php
                                $statusClass = match($order->status) {
                                    'paid'    => 's-paid',
                                    'pending' => 's-pending',
                                    'cancel','cancelled' => 's-cancel',
                                    default   => 's-pending',
                                };
                                $statusLabel = match($order->status) {
                                    'paid'    => 'Lunas',
                                    'pending' => 'Pending',
                                    'cancel','cancelled' => 'Dibatalkan',
                                    default   => ucfirst($order->status),
                                };
                            @endphp
                            <span class="status-pill {{ $statusClass }}">
                                {{ $statusLabel }}
                            </span>
                        </td>
                        <td style="color:#6b7280;">
                            {{ $order->created_at->format('H:i') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Data dari controller (JSON) ──
    const chartLabels = @json($monthlyLabels);   // ['Jan','Feb',...]
    const chartData   = @json($monthlyRevenue);  // [2100000, 3400000, ...]

    let activeChart;

    function buildChart(type) {
        if (activeChart) activeChart.destroy();

        activeChart = new Chart(document.getElementById('revenueChart'), {
            type: type,
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Revenue',
                    data: chartData,
                    backgroundColor: type === 'bar'
                        ? 'rgba(37,99,235,0.85)'
                        : 'rgba(37,99,235,0.12)',
                    borderColor: '#2563eb',
                    borderWidth: type === 'line' ? 2 : 0,
                    borderRadius: type === 'bar' ? 6 : 0,
                    fill: type === 'line',
                    tension: 0.4,
                    pointBackgroundColor: '#2563eb',
                    pointRadius: type === 'line' ? 4 : 0,
                    pointHoverRadius: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => 'Rp' + ctx.raw.toLocaleString('id-ID')
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { color: 'rgba(0,0,0,0.05)' },
                        ticks: { font: { size: 11 }, color: '#9ca3af' }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.05)' },
                        ticks: {
                            font: { size: 11 },
                            color: '#9ca3af',
                            callback: v => 'Rp' + (v / 1_000_000).toFixed(1) + 'M'
                        }
                    }
                }
            }
        });
    }

    // Render default
    buildChart('bar');

    // Tab toggle
    document.querySelectorAll('.tab-group a').forEach(tab => {
        tab.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelectorAll('.tab-group a').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            buildChart(this.dataset.type);
        });
    });

});
</script>
@endpush
