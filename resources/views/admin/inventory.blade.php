@extends('admin.layouts.app')

@section('title', 'Inventory')

@section('content')

<link rel="stylesheet"
      href="{{ asset('css/admin/inventory.css') }}">

<div class="inventory-page">

    <!-- HEADER -->
    <div class="inventory-header">

        <div>

            <h1>
                Inventory Management
            </h1>

            <p>
                Monitor ingredients, stock levels, and inventory status
            </p>

        </div>

        <button
            onclick="openAddModal()"
            class="add-btn">

            + Add Ingredient

        </button>

    </div>

    <!-- INVENTORY TABLE -->
    <div class="inventory-card">

        <div class="card-header">

            <h2>
                Ingredient Inventory
            </h2>

        </div>

        <div class="table-wrapper">

            <table>

                <thead>

                    <tr>

                        <th>
                            Code
                        </th>

                        <th>
                            Ingredient
                        </th>

                        <th>
                            Category
                        </th>

                        <th>
                            Stock
                        </th>

                        <th>
                            Minimum
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($inventories as $item)

                        @php

                            if ($item->stock <= $item->min_stock) {

                                $status = 'critical';

                            } elseif (
                                $item->stock <= ($item->min_stock * 1.5)
                            ) {

                                $status = 'low';

                            } else {

                                $status = 'normal';

                            }

                        @endphp

                        <tr>

                            <td class="inventory-code">

                                {{ $item->ingredient_code }}

                            </td>

                            <td class="inventory-name">

                                {{ $item->name }}

                            </td>

                            <td>

                                {{ $item->category }}

                            </td>

                            <td>

                                {{ $item->stock }}

                                <span class="inventory-unit">

                                    {{ $item->unit }}

                                </span>

                            </td>

                            <td>

                                {{ $item->min_stock }}

                                <span class="inventory-unit">

                                    {{ $item->unit }}

                                </span>

                            </td>

                            <td>

                                <span class="status-badge {{ $status }}">

                                    {{ strtoupper($status) }}

                                </span>

                            </td>

                            <td>

                                <button
                                    onclick='editIngredient(
                                        {{ $item->id }},
                                        "{{ addslashes($item->ingredient_code) }}",
                                        "{{ addslashes($item->name) }}",
                                        "{{ addslashes($item->category) }}",
                                        "{{ $item->stock }}",
                                        "{{ addslashes($item->unit) }}",
                                        "{{ $item->min_stock }}"
                                    )'

                                    class="edit-btn">

                                    ✏ Edit

                                </button>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- =========================
     ADD INGREDIENT MODAL
========================= -->
<div class="modal-overlay"
     id="addModal">

    <div class="modal-box">

        <div class="modal-header">

            <h2>
                Add Ingredient
            </h2>

            <button
                class="close-modal"
                onclick="closeAddModal()">

                ✕

            </button>

        </div>

        <form
            action="{{ route('admin.inventory.store') }}"
            method="POST">

            @csrf

            <div class="form-group">

                <label>
                    Code
                </label>

                <input
                    type="text"
                    name="ingredient_code"
                    placeholder="e.g. ING-001"
                    required>

            </div>

            <div class="form-group">

                <label>
                    Ingredient Name
                </label>

                <input
                    type="text"
                    name="name"
                    placeholder="e.g. Full Cream Milk"
                    required>

            </div>

            <div class="form-group">

                <label>
                    Category
                </label>

                <input
                    type="text"
                    name="category"
                    placeholder="e.g. Dairy"
                    required>

            </div>

            <div class="form-group">

                <label>
                    Stock
                </label>

                <input
                    type="number"
                    name="stock"
                    placeholder="0"
                    required>

            </div>

            <div class="form-group">

                <label>
                    Unit
                </label>

                <input
                    type="text"
                    name="unit"
                    placeholder="e.g. liter, kg, pcs"
                    required>

            </div>

            <div class="form-group">

                <label>
                    Minimum Stock
                </label>

                <input
                    type="number"
                    name="min_stock"
                    placeholder="0"
                    required>

            </div>

            <div class="button-group">

                <button
                    type="button"
                    onclick="closeAddModal()"
                    class="cancel-btn">

                    Cancel

                </button>

                <button
                    type="submit"
                    class="save-btn">

                    Save Ingredient

                </button>

            </div>

        </form>

    </div>

</div>

<!-- =========================
     EDIT INGREDIENT MODAL
========================= -->
<div class="modal-overlay"
     id="editModal">

    <div class="modal-box">

        <div class="modal-header">

            <h2>
                Edit Ingredient
            </h2>

            <button
                class="close-modal"
                onclick="closeEditModal()">

                ✕

            </button>

        </div>

        <form
            id="editForm"
            method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">

                <label>
                    Code
                </label>

                <input
                    type="text"
                    id="edit_code"
                    name="ingredient_code"
                    required>

            </div>

            <div class="form-group">

                <label>
                    Ingredient Name
                </label>

                <input
                    type="text"
                    id="edit_name"
                    name="name"
                    required>

            </div>

            <div class="form-group">

                <label>
                    Category
                </label>

                <input
                    type="text"
                    id="edit_category"
                    name="category"
                    required>

            </div>

            <div class="form-group">

                <label>
                    Stock
                </label>

                <input
                    type="number"
                    id="edit_stock"
                    name="stock"
                    required>

            </div>

            <div class="form-group">

                <label>
                    Unit
                </label>

                <input
                    type="text"
                    id="edit_unit"
                    name="unit"
                    required>

            </div>

            <div class="form-group">

                <label>
                    Minimum Stock
                </label>

                <input
                    type="number"
                    id="edit_min_stock"
                    name="min_stock"
                    required>

            </div>

            <div class="button-group">

                <button
                    type="button"
                    onclick="closeEditModal()"
                    class="cancel-btn">

                    Cancel

                </button>

                <button
                    type="submit"
                    class="save-btn">

                    Update Ingredient

                </button>

            </div>

        </form>

    </div>

</div>

<script src="{{ asset('js/admin/inventory.js') }}"></script>

@endsection