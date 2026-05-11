@extends('admin.layouts.app')

@section('content')

<div class="create-restock-container">

    <h1>Add Restock</h1>

    <form action="{{ route('admin.restock.store') }}"
          method="POST">

        @csrf

        <div class="form-group">

            <label>Inventory</label>

            <select name="inventory_id">

                @foreach($inventories as $inventory)

                    <option value="{{ $inventory->id }}">

                        {{ $inventory->name }}

                    </option>

                @endforeach

            </select>

        </div>


        <div class="form-group">

            <label>Supplier</label>

            <select name="supplier_id">

                @foreach($suppliers as $supplier)

                    <option value="{{ $supplier->id }}">

                        {{ $supplier->name }}

                    </option>

                @endforeach

            </select>

        </div>


        <div class="form-group">

            <label>Qty</label>

            <input type="number"
                   name="qty">

        </div>


        <div class="form-group">

            <label>Price</label>

            <input type="number"
                   name="price">

        </div>


        <button type="submit">

            Save Restock

        </button>

    </form>

</div>

@endsection