<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\FinanceController;

use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Admin\InventoryController;

use App\Http\Controllers\Admin\RecipeController;

// ======================================================
// ADMIN MODULE
// ======================================================


// =========================
// DASHBOARD
// =========================
Route::get(

    '/admin',

    [DashboardController::class, 'dashboard']

)->name('admin.dashboard');


// =========================
// INVENTORY
// =========================

// INVENTORY PAGE
Route::get(

    '/admin/inventory',

    [InventoryController::class, 'inventory']

)->name('admin.inventory');


// STORE INVENTORY
Route::post(

    '/admin/inventory/store',

    [InventoryController::class, 'storeInventory']

)->name('admin.inventory.store');


// UPDATE INVENTORY
Route::put(

    '/admin/inventory/update/{id}',

    [InventoryController::class, 'updateInventory']

)->name('admin.inventory.update');


// =========================
// RECIPES
// =========================

// RECIPES PAGE
Route::get(

    '/admin/recipes',

    [RecipeController::class, 'recipes']

)->name('admin.recipes');


// STORE RECIPE
Route::post(

    '/admin/recipes/store',

    [RecipeController::class, 'storeRecipe']

)->name('admin.recipes.store');


// DELETE RECIPE
Route::delete(

    '/admin/recipes/delete/{productId}',

    [RecipeController::class, 'deleteRecipe']

)->name('admin.recipes.delete');

// =========================
// FINANCE
// =========================

Route::get(

    '/admin/finance',

    [FinanceController::class, 'index']

)->name('admin.finance');