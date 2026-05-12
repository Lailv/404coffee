@extends('admin.layouts.app')

@section('title', 'Restock')

@section('content')

<link rel="stylesheet"
      href="{{ asset('css/admin/restock.css') }}">

<div class="restock-page">

    <!-- =========================
         HEADER
    ========================= -->
    <div class="restock-header">

        <div>

            <h1>
                Restock Management
            </h1>

            <p>
                Monitor stock purchases, suppliers, and inventory flow
            </p>

        </div>

        <div class="header-actions">

            <button
                class="add-btn"
                id="openRestockModal">

                + Add Restock

            </button>

            <button
                class="supplier-btn"
                id="openSupplierModal">

                + Add Supplier

            </button>

        </div>

    </div>


    <!-- =========================
         SUCCESS MESSAGE
    ========================= -->
    @if(session('success'))

        <div class="success-message">

            {{ session('success') }}

        </div>

    @endif


    <!-- =========================
         STATS
    ========================= -->
    <div class="restock-stats">

        <div class="stats-card">

            <span>
                Total Restock
            </span>

            <h2>

                {{ $restocks->count() }}

            </h2>

        </div>


        <div class="stats-card">

            <span>
                Total Expense
            </span>

            <h2>

                Rp {{ number_format($restocks->sum('total'),0,',','.') }}

            </h2>

        </div>


        <div class="stats-card">

            <span>
                Total Supplier
            </span>

            <h2>

                {{ $suppliers->count() }}

            </h2>

        </div>


        <div class="stats-card">

            <span>
                Latest Restock
            </span>

            <h2>

                @if($restocks->count())

                    {{ $restocks->first()->created_at->format('d M') }}

                @else

                    -

                @endif

            </h2>

        </div>

    </div>


    <!-- =========================
         SUPPLIER LIST
    ========================= -->
    <div class="restock-card">

        <div class="card-header">

            <h2>
                Supplier List
            </h2>

        </div>


        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>Name</th>

                        <th>Phone</th>

                        <th>Address</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($suppliers as $supplier)

                        <tr>

                            <td>

                                {{ $supplier->name }}

                            </td>

                            <td>

                                {{ $supplier->phone }}

                            </td>

                            <td>

                                {{ $supplier->address }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="3"
                                class="empty-data">

                                No supplier data

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    <!-- =========================
         RESTOCK HISTORY
    ========================= -->
    <div class="restock-card">

        <div class="card-header">

            <h2>
                Restock History
            </h2>

        </div>


        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>Date</th>

                        <th>Ingredient</th>

                        <th>Supplier</th>

                        <th>Qty</th>

                        <th>Price</th>

                        <th>Total</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($restocks as $restock)

                        <tr>

                            <td>

                                {{ $restock->created_at->format('d M Y') }}

                            </td>


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

                                Rp {{ number_format($restock->price,0,',','.') }}

                            </td>


                            <td class="total-price">

                                Rp {{ number_format($restock->total,0,',','.') }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="empty-data">

                                No restock history available

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


<!-- =========================
     ADD RESTOCK MODAL
========================= -->
<div class="modal-overlay"
     id="restockModal">

    <div class="modal-box">

        <div class="modal-header">

            <h2>
                Add Restock
            </h2>

            <button class="close-modal"
                    id="closeRestockModal">

                ×

            </button>

        </div>


        <form method="POST"
              action="{{ route('admin.restock.store') }}">

            @csrf

            <div class="form-group">

                <label>
                    Ingredient
                </label>

                <select name="inventory_id"
                        required>

                    <option value="">
                        Select Ingredient
                    </option>

                    @foreach($inventories as $inventory)

                        <option value="{{ $inventory->id }}">

                            {{ $inventory->name }}

                        </option>

                    @endforeach

                </select>

            </div>


            <div class="form-group">

                <label>
                    Supplier
                </label>

                <select name="supplier_id"
                        required>

                    <option value="">
                        Select Supplier
                    </option>

                    @foreach($suppliers as $supplier)

                        <option value="{{ $supplier->id }}">

                            {{ $supplier->name }}

                        </option>

                    @endforeach

                </select>

            </div>


            <div class="form-group">

                <label>
                    Quantity
                </label>

                <input
                    type="number"
                    name="qty"
                    id="qty"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Price
                </label>

                <input
                    type="number"
                    name="price"
                    id="price"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Total
                </label>

                <input
                    type="text"
                    id="total"
                    readonly
                >

            </div>


            <button type="submit"
                    class="submit-btn">

                Save Restock

            </button>

        </form>

    </div>

</div>


<!-- =========================
     ADD SUPPLIER MODAL
========================= -->
<div class="modal-overlay"
     id="supplierModal">

    <div class="modal-box">

        <div class="modal-header">

            <h2>
                Add Supplier
            </h2>

            <button class="close-modal"
                    id="closeSupplierModal">

                ×

            </button>

        </div>


        <form method="POST"
              action="{{ route('admin.supplier.store') }}">

            @csrf

            <div class="form-group">

                <label>
                    Supplier Name
                </label>

                <input
                    type="text"
                    name="name"
                    required
                >

            </div>


            <div class="form-group">

                <label>
                    Phone
                </label>

                <input
                    type="text"
                    name="phone"
                >

            </div>


            <div class="form-group">

                <label>
                    Address
                </label>

                <textarea
                    name="address"
                    rows="4"
                ></textarea>

            </div>


            <button type="submit"
                    class="submit-btn">

                Save Supplier

            </button>

        </form>

    </div>

</div>


<script src="{{ asset('js/admin/restock.js') }}"></script>

@endsection