@extends('admin.layouts.app')

<link rel="stylesheet"
      href="{{ asset('css/admin/restock/restock.css') }}">

@section('content')

<div class="restock-container">

    <div class="restock-header">

        <h1>Restock History</h1>

        <div class="restock-actions">

            <a href="{{ route('admin.restock.create') }}"
               class="add-btn">

                Add Restock

            </a>

            <a href="{{ route('admin.supplier') }}"
               class="supplier-btn">

                Suppliers

            </a>

        </div>

    </div>

    <table>

        <thead>

            <tr>

                <th>Inventory</th>

                <th>Supplier</th>

                <th>Qty</th>

                <th>Total</th>

                <th>Date</th>

            </tr>

        </thead>

        <tbody>

            @forelse($restocks as $restock)

                <tr>

                    <td>

                        {{ $restock->inventory->name }}

                    </td>

                    <td>

                        {{ $restock->supplier->name }}

                    </td>

                    <td>

                        {{ $restock->qty }}

                    </td>

                    <td>

                        Rp {{ number_format($restock->total) }}

                    </td>

                    <td>

                        {{ $restock->created_at->format('d M Y') }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5">

                        No restock data

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection