@extends('admin.layouts.app')

@section('title', 'Inventory')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/inventory.css') }}">
@endpush

@section('content')

<div class="inventory-wrapper">

    <!-- TOP ACTION -->
    <div class="top-action">

        <h1>Inventory</h1>

        <button
            onclick="openAddModal()"
            class="add-btn">
            + Add Ingredient
        </button>

    </div>

    <!-- ADD MODAL -->
    <div class="modal" id="addModal">

        <div class="modal-content">

            <h2>Add Ingredient</h2>

            <form
                action="{{ route('admin.inventory.store') }}"
                method="POST">

                @csrf

                <div>
                    <label>Code</label>
                    <input
                        type="text"
                        name="ingredient_code"
                        placeholder="e.g. ING-001"
                        required>
                </div>

                <div>
                    <label>Ingredient Name</label>
                    <input
                        type="text"
                        name="name"
                        placeholder="e.g. Susu Full Cream"
                        required>
                </div>

                <div>
                    <label>Category</label>
                    <input
                        type="text"
                        name="category"
                        placeholder="e.g. Dairy"
                        required>
                </div>

                <div>
                    <label>Stock</label>
                    <input
                        type="number"
                        name="stock"
                        placeholder="0"
                        required>
                </div>

                <div>
                    <label>Unit</label>
                    <input
                        type="text"
                        name="unit"
                        placeholder="e.g. liter, kg, pcs"
                        required>
                </div>

                <div>
                    <label>Minimum Stock</label>
                    <input
                        type="number"
                        name="min_stock"
                        placeholder="0"
                        required>
                </div>

                <div class="modal-action">

                    <button
                        type="button"
                        onclick="closeAddModal()"
                        class="close-btn">
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="save-btn">
                        Save
                    </button>

                </div>

            </form>

        </div>

    </div>

    <!-- EDIT MODAL -->
    <div class="modal" id="editModal">

        <div class="modal-content">

            <h2>Edit Ingredient</h2>

            <form id="editForm" method="POST">

                @csrf
                @method('PUT')

                <div>
                    <label>Code</label>
                    <input
                        type="text"
                        name="ingredient_code"
                        id="edit_code"
                        required>
                </div>

                <div>
                    <label>Ingredient Name</label>
                    <input
                        type="text"
                        name="name"
                        id="edit_name"
                        required>
                </div>

                <div>
                    <label>Category</label>
                    <input
                        type="text"
                        name="category"
                        id="edit_category"
                        required>
                </div>

                <div>
                    <label>Stock</label>
                    <input
                        type="number"
                        name="stock"
                        id="edit_stock"
                        required>
                </div>

                <div>
                    <label>Unit</label>
                    <input
                        type="text"
                        name="unit"
                        id="edit_unit"
                        required>
                </div>

                <div>
                    <label>Minimum Stock</label>
                    <input
                        type="number"
                        name="min_stock"
                        id="edit_min_stock"
                        required>
                </div>

                <div class="modal-action">

                    <button
                        type="button"
                        onclick="closeEditModal()"
                        class="close-btn">
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="save-btn">
                        Update
                    </button>

                </div>

            </form>

        </div>

    </div>

    <!-- TABLE -->
    <div class="table-wrapper">

        <table>

            <thead>
                <tr>
                    <th>Code</th>
                    <th>Ingredient</th>
                    <th>Category</th>
                    <th>Stock</th>
                    <th>Min Stock</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach($inventories as $item)

                    @php
                        if ($item->stock <= $item->min_stock) {
                            $status = 'critical';
                        } elseif ($item->stock <= ($item->min_stock * 1.5)) {
                            $status = 'low';
                        } else {
                            $status = 'normal';
                        }
                    @endphp

                    <tr>

                        <td style="font-family: monospace; font-size: 12px; color: #64748b;">
                            {{ $item->ingredient_code }}
                        </td>

                        <td style="font-weight: 500;">
                            {{ $item->name }}
                        </td>

                        <td style="color: #64748b;">
                            {{ $item->category }}
                        </td>

                        <td>
                            {{ $item->stock }}
                            <span style="color:#94a3b8; font-size:12px;">{{ $item->unit }}</span>
                        </td>

                        <td>
                            {{ $item->min_stock }}
                            <span style="color:#94a3b8; font-size:12px;">{{ $item->unit }}</span>
                        </td>

                        <td>
                            <span class="badge {{ $status }}">
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

@endsection

@push('scripts')
<script src="{{ asset('js/admin/inventory.js') }}"></script>
@endpush
