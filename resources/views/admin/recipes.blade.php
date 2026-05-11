@extends('admin.layouts.app')

@section('title', 'Recipes')

@section('content')

<link rel="stylesheet"
      href="{{ asset('css/admin/recipes.css') }}">

<div class="recipe-page">

    <!-- HEADER -->
    <div class="page-header">

        <div>

            <h1>
                Recipe Builder
            </h1>

            <p>
                Create menu recipes and ingredients
            </p>

        </div>

        <div class="header-badge">

            ERP Recipe System

        </div>

    </div>

    <!-- FORM CARD -->
    <div class="recipe-card">

        @if(session('success'))

            <div class="success-alert">

                {{ session('success') }}

            </div>

        @endif

        @if(session('error'))

            <div class="error-alert">

                {{ session('error') }}

            </div>

        @endif

        @if($products->count() == 0)

            <div class="empty-recipe">

                Semua menu sudah punya recipe ☕

            </div>

        @else

        <form
            action="{{ route('admin.recipes.store') }}"
            method="POST">

            @csrf

            <!-- PRODUCT -->
            <div class="form-section">

                <label>
                    Select Menu
                </label>

                <select
                    name="product_id"
                    required>

                    @foreach($products as $product)

                        <option
                            value="{{ $product->id }}">

                            {{ $product->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <!-- INGREDIENT WRAPPER -->
            <div id="ingredient-wrapper">

                <div class="ingredient-box">

                    <div class="ingredient-title">

                        Ingredient #1

                    </div>

                    <div class="ingredient-grid">

                        <!-- INGREDIENT -->
                        <div>

                            <label>
                                Ingredient
                            </label>

                            <select
                                name="inventory_id[]"
                                required>

                                @foreach($inventories as $inventory)

                                    <option
                                        value="{{ $inventory->id }}">

                                        {{ $inventory->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <!-- QUANTITY -->
                        <div>

                            <label>
                                Quantity
                            </label>

                            <input
                                type="number"
                                name="quantity[]"
                                placeholder="Example: 18"
                                required>

                        </div>

                    </div>

                </div>

            </div>

            <!-- BUTTON -->
            <div class="button-group">

                <button
                    type="button"
                    onclick="addIngredient()"
                    class="add-btn">

                    <i class="fa-solid fa-plus"></i>

                    Add Ingredient

                </button>

                <button
                    type="submit"
                    class="save-btn">

                    <i class="fa-solid fa-floppy-disk"></i>

                    Save Recipe

                </button>

            </div>

        </form>

        @endif

    </div>

    <!-- RECIPE LIST -->
    <div class="recipe-list-card">

        <div class="recipe-list-header">

            <div>

                <h2>
                    Recipe List
                </h2>

                <p>
                    Existing menu recipes
                </p>

            </div>

        </div>

        <div class="recipe-groups">

            @forelse($recipeGroups as $group)

                <div class="recipe-group">

                    <!-- HEADER -->
                    <div class="recipe-group-header">

                        <div class="recipe-group-title">

                            <i class="fa-solid fa-utensils"></i>

                            {{ $group->product->name }}

                        </div>

                        <!-- DELETE -->
                        <form
                            action="{{ route(
                                'admin.recipes.delete',
                                $group->product_id
                            ) }}"
                            method="POST"

                            onsubmit="return confirm(
                                'Hapus recipe ini?'
                            )">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="delete-recipe-btn">
    <i class="fa-solid fa-trash"></i>
    Delete
</button>

                        </form>

                    </div>

                    <!-- INGREDIENTS -->
                    <div class="recipe-items">

                        @foreach(

                            \App\Models\Recipe::where(
                                'product_id',
                                $group->product_id
                            )->with('inventory')->get()

                            as $recipe

                        )

                            <div class="recipe-item">

                                <span>

                                    {{ $recipe->inventory->name }}

                                </span>

                                <strong>

                                    {{ $recipe->quantity }}

                                </strong>

                            </div>

                        @endforeach

                    </div>

                </div>

            @empty

                <div class="empty-recipe">

                    Recipe belum ada ☕

                </div>

            @endforelse

        </div>

    </div>

</div>

<!-- INVENTORY OPTIONS -->
<script>

window.inventoryOptions = `

    @foreach($inventories as $inventory)

        <option value="{{ $inventory->id }}">

            {{ $inventory->name }}

        </option>

    @endforeach

`;

</script>

<!-- JS -->
<script src="{{ asset('js/admin/recipes.js') }}">
</script>

@endsection