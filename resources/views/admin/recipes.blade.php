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
                Menu Management
            </h1>

            <p>
                Manage menu, recipes, and ingredients
            </p>

        </div>

        <button
            class="save-btn"
            onclick="openAddMenuModal()">

            <i class="fa-solid fa-plus"></i>

            + Add Menu

        </button>

    </div>

    <!-- =========================
         SEARCH & FILTER TOOLBAR
    ========================= -->
    <div class="recipe-toolbar">

        <div class="recipe-search">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                id="recipeSearchInput"
                placeholder="Search menu name...">

            <button
                type="button"
                id="recipeSearchClear"
                class="recipe-search-clear"
                aria-label="Clear search">

                <i class="fa-solid fa-xmark"></i>

            </button>

        </div>

        <div class="recipe-filters" id="recipeFilters">

            <button type="button" class="filter-chip active" data-filter="all">
                All Menu
            </button>

            <button type="button" class="filter-chip" data-filter="1">
                Coffee
            </button>

            <button type="button" class="filter-chip" data-filter="2">
                Non Coffee
            </button>

            <button type="button" class="filter-chip" data-filter="3">
                Food
            </button>

        </div>

    </div>

    <div class="recipe-no-result" id="recipeNoResult">

        <i class="fa-solid fa-mug-hot"></i>

        <h3>No Menu Found</h3>

        <p>Coba ganti kata kunci atau kategori filter.</p>

    </div>

    <!-- MENU GRID -->
    <div class="recipe-groups" id="recipeGroups">

        @forelse($recipeGroups as $group)

            @php

                $recipes =
                    \App\Models\Recipe::where(
                        'product_id',
                        $group->id
                    )
                    ->with('inventory')
                    ->get();

            @endphp

            <div class="recipe-group"
                 data-name="{{ strtolower($group->name) }}"
                 data-category="{{ $group->category_id }}">

                @if($group->image)

                    <img
                        src="{{ asset('storage/' . $group->image) }}"
                        class="recipe-image">

                @endif

                <!-- CARD HEADER -->
                <div class="recipe-group-header">

                    <div>

                        <div class="recipe-group-title">

                            <i class="fa-solid fa-utensils"></i>

                            {{ $group->name }}

                        </div>

                        <div class="recipe-meta">

                            <span class="recipe-price">

                                Rp {{ number_format(
                                    $group->price,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </span>

                            <span class="recipe-category">

                                @if($group->category_id == 1)

                                    Coffee

                                @elseif($group->category_id == 2)

                                    Non Coffee

                                @else

                                    Food

                                @endif

                            </span>

                        </div>

                    </div>

                    <!-- ACTIONS -->
                    <div class="recipe-actions">

                        <!-- EDIT -->
                        <button
                            type="button"
                            class="edit-recipe-btn"
                            onclick="openEditModal(
                                {{ $group->id }},
                                '{{ $group->name }}',
                                '{{ $group->price }}',
                                '{{ $group->category_id }}'
                            )">

                            <i class="fa-solid fa-pen"></i>

                            Edit

                        </button>

                        <!-- DELETE -->
                        <form
                            action="{{ route(
                                'admin.recipes.delete',
                                $group->id
                            ) }}"
                            method="POST"

                            onsubmit="return confirm(
                                'Delete this menu?'
                            )">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="delete-recipe-btn">

                                <i class="fa-solid fa-trash"></i>

                                Delete

                            </button>

                        </form>

                    </div>

                </div>

                <!-- INGREDIENTS -->
                <div class="recipe-items">

                    @forelse($recipes as $recipe)

                        <div class="recipe-item">

                            <span>

                                {{ $recipe->inventory->name }}

                            </span>

                            <strong>

                                {{ $recipe->quantity }}

                            </strong>

                        </div>

                    @empty

                        <div class="empty-recipe">

                            No recipe ingredients

                        </div>

                    @endforelse

                </div>

            </div>

        @empty

            <div class="empty-recipe">

                No menu available ☕

            </div>

        @endforelse

    </div>

</div>

<!-- =========================
     ADD MENU MODAL
========================= -->
<div class="modal-overlay"
     id="addMenuModal">

    <div class="modal-box">

        <!-- HEADER -->
        <div class="modal-header">

            <h2>
                Add New Menu
            </h2>

            <button
                class="close-modal"
                onclick="closeAddMenuModal()">

                ✕

            </button>

        </div>

        <!-- FORM -->
        <form
            action="{{ route('admin.products.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            <!-- MENU -->
            <div class="form-group">

                <label>
                    Menu Name
                </label>

                <input
                    type="text"
                    name="name"
                    required>

            </div>

            <!-- PRICE -->
            <div class="form-group">

                <label>
                    Price
                </label>

                <input
                    type="number"
                    name="price"
                    required>

            </div>

            <!-- IMAGE -->
            <div class="form-group">

                <label>
                    Menu Image
                </label>

                <input
                    type="file"
                    name="image"
                    accept="image/*">

            </div>

            <!-- CATEGORY -->
            <div class="form-group">

                <label>
                    Category
                </label>

                <select
                    name="category_id"
                    required>

                    <option value="">
                        Select Category
                    </option>

                    <option value="1">
                        Coffee
                    </option>

                    <option value="2">
                        Non Coffee
                    </option>

                    <option value="3">
                        Food
                    </option>

                </select>

            </div>

            <!-- INGREDIENTS -->
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
                                name="inventory_id[]">

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
                                step="0.01"
                                name="quantity[]">

                        </div>

                    </div>

                </div>

            </div>

            <!-- BUTTONS -->
            <div class="button-group">

                <button
                    type="button"
                    onclick="addIngredient()"
                    class="add-btn">

                    Add Ingredient

                </button>

                <button
                    type="submit"
                    class="save-btn">

                    Save Menu

                </button>

            </div>

        </form>

    </div>

</div>

<!-- =========================
     EDIT MENU MODAL
========================= -->
<div class="modal-overlay"
     id="editMenuModal">

    <div class="modal-box">

        <!-- HEADER -->
        <div class="modal-header">

            <h2>
                Edit Menu
            </h2>

            <button
                class="close-modal"
                onclick="closeEditMenuModal()">

                ✕

            </button>

        </div>

   <form
    id="editMenuForm"
    action=""
    method="POST"
    enctype="multipart/form-data">

    @csrf
            

            <!-- MENU -->
            <div class="form-group">

                <label>
                    Menu Name
                </label>

                <input
                    type="text"
                    name="name"
                    id="edit_name"
                    required>

            </div>

            <!-- PRICE -->
            <div class="form-group">

                <label>
                    Price
                </label>

                <input
                    type="number"
                    name="price"
                    id="edit_price"
                    required>

            </div>

            <!-- IMAGE -->
            <div class="form-group">

                <label>
                    Change Image
                </label>

                <input
                    type="file"
                    name="image"
                    accept="image/*">

            </div>

            <!-- CATEGORY -->
            <div class="form-group">

                <label>
                    Category
                </label>

                <select
                    name="category_id"
                    id="edit_category"
                    required>

                    <option value="1">
                        Coffee
                    </option>

                    <option value="2">
                        Non Coffee
                    </option>

                    <option value="3">
                        Food
                    </option>

                </select>

            </div>

            <div class="button-group">

                <button
                    type="button"
                    class="add-btn"
                    onclick="closeEditMenuModal()">

                    Cancel

                </button>

                <button
                    type="submit"
                    class="save-btn">

                    Update Menu

                </button>

            </div>

        </form>

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

<!-- SEARCH & FILTER JS -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('recipeSearchInput');
    const clearBtn     = document.getElementById('recipeSearchClear');
    const filterChips  = document.querySelectorAll('#recipeFilters .filter-chip');
    const cards        = document.querySelectorAll('#recipeGroups .recipe-group');
    const noResultBox  = document.getElementById('recipeNoResult');

    let activeFilter = 'all';

    function applyFilter() {

        const keyword = searchInput.value.trim().toLowerCase();

        clearBtn.classList.toggle('is-visible', keyword.length > 0);

        let visibleCount = 0;

        cards.forEach(function (card) {

            const name     = card.dataset.name || '';
            const category = card.dataset.category || '';

            const matchName     = name.includes(keyword);
            const matchCategory = activeFilter === 'all' || activeFilter === category;

            const isMatch = matchName && matchCategory;

            card.style.display = isMatch ? '' : 'none';

            if (isMatch) visibleCount++;

        });

        noResultBox.classList.toggle('is-visible', visibleCount === 0);

    }

    searchInput.addEventListener('input', applyFilter);

    clearBtn.addEventListener('click', function () {
        searchInput.value = '';
        applyFilter();
        searchInput.focus();
    });

    filterChips.forEach(function (chip) {

        chip.addEventListener('click', function () {

            filterChips.forEach(function (c) {
                c.classList.remove('active');
            });

            chip.classList.add('active');
            activeFilter = chip.dataset.filter;

            applyFilter();

        });

    });

});
</script>

@endsection
