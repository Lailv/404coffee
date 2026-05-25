<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FinanceController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\RecipeController;
use App\Http\Controllers\Admin\RestockController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\CustomerController;


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


// STORE PRODUCT
Route::post(

    '/admin/products/store',

    [RecipeController::class, 'storeProduct']

)->name('admin.products.store');


// UPDATE PRODUCT
Route::match(

    ['post', 'put'],

    '/admin/products/update/{id}',

    [RecipeController::class, 'updateProduct']

)->name('admin.products.update');


// DELETE RECIPE
Route::delete(

    '/admin/recipes/delete/{productId}',

    [RecipeController::class, 'deleteRecipe']

)->name('admin.recipes.delete');


// =========================
// FINANCE
// =========================

// FINANCE PAGE
Route::get(

    '/admin/finance',

    [FinanceController::class, 'index']

)->name('admin.finance');


// STORE MANUAL EXPENSE
Route::post(

    '/finance/expense',

    [FinanceController::class, 'storeExpense']

)->name('admin.finance.expense');


// =========================
// RESTOCK
// =========================

// RESTOCK PAGE
Route::get(

    '/admin/restock',

    [RestockController::class, 'index']

)->name('admin.restock');


// STORE RESTOCK
Route::post(

    '/admin/restock/store',

    [RestockController::class, 'store']

)->name('admin.restock.store');


// =========================
// SUPPLIER
// =========================

// STORE SUPPLIER
Route::post(

    '/admin/supplier/store',

    [SupplierController::class, 'store']

)->name('admin.supplier.store');


// =========================
// EMPLOYEES
// =========================
Route::prefix('admin')
    ->middleware(['auth'])
    ->group(function () {

        Route::get(

            '/employees',

            [EmployeeController::class, 'index']

        )->name('admin.employees');

        Route::post(

            '/employees/store',

            [EmployeeController::class, 'store']

        )->name('admin.employees.store');

        Route::put(

            '/employees/{employee}',

            [EmployeeController::class, 'update']

        )->name('admin.employees.update');

    });


// =========================
// ATTENDANCE
// =========================
Route::prefix('admin')
    ->middleware(['auth'])
    ->group(function () {

        Route::get(

            '/attendance',

            [AttendanceController::class, 'index']

        )->name('admin.attendance');

        Route::post(

            '/attendance/check-in',

            [AttendanceController::class, 'checkIn']

        )->name('admin.attendance.checkin');

    });


// =========================
// CUSTOMERS
// =========================
Route::middleware(['auth'])->group(function () {

    Route::get(

        '/admin/customers',

        [CustomerController::class, 'index']

    )->name('admin.customers');

});