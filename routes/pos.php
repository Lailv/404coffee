<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\POS\POSController;
use App\Http\Controllers\POS\CartController;
use App\Http\Controllers\POS\CheckoutController;


// ======================================================
// POS MODULE
// ======================================================

// POS PAGE
Route::get(
    '/pos',
    [POSController::class, 'index']
)->name('pos');


// =========================
// CART
// =========================

// ADD TO CART
Route::post(
    '/cart/add',
    [CartController::class, 'addToCart']
)->name('cart.add');


// INCREASE QTY
Route::post(
    '/cart/increase',
    [CartController::class, 'increaseQty']
)->name('cart.increase');


// DECREASE QTY
Route::post(
    '/cart/decrease',
    [CartController::class, 'decreaseQty']
)->name('cart.decrease');


// =========================
// CHECKOUT
// =========================

// PROCESS CHECKOUT
Route::post(
    '/checkout',
    [CheckoutController::class, 'checkout']
)->name('checkout');


// RECEIPT
Route::get(
    '/receipt/{id}',
    [CheckoutController::class, 'receipt']
)->name('receipt');