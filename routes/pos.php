<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\POS\POSController;
use App\Http\Controllers\POS\CartController;
use App\Http\Controllers\POS\CheckoutController;
use App\Http\Controllers\POS\MidtransController;

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

// UPDATE QTY (MANUAL INPUT / +/-)
Route::post(
    '/cart/update',
    [CartController::class, 'updateQty']
)->name('cart.update');

// REMOVE ITEM
Route::post(
    '/cart/remove',
    [CartController::class, 'removeItem']
)->name('cart.remove');

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

// =========================
// MIDTRANS
// =========================

// HALAMAN PAYMENT
Route::get(
    '/payment/{order}',
    [MidtransController::class, 'payment']
)->name('pos.payment');

// GENERATE SNAP TOKEN
Route::post(
    '/payment/{order}',
    [MidtransController::class, 'pay']
)->name('pos.payment.pay');

// PAYMENT SUCCESS (UNTUK DEMO)
Route::post(
    '/payment/success/{order}',
    [MidtransController::class, 'success']
)->name('pos.payment.success');