<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Customer\CustomerAuthController;
use App\Http\Controllers\Customer\CustomerController;

/*
|--------------------------------------------------------------------------
| CUSTOMER
|--------------------------------------------------------------------------
*/

Route::prefix('customer')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | HOME
    |--------------------------------------------------------------------------
    */

    Route::get(

        '/',

        [CustomerController::class, 'home']

    )->name('customer.home');

    /*
    |--------------------------------------------------------------------------
    | MENU
    |--------------------------------------------------------------------------
    */

    Route::get(

        '/menu',

        [CustomerController::class, 'menu']

    )->name('customer.menu');

    /*
    |--------------------------------------------------------------------------
    | ABOUT
    |--------------------------------------------------------------------------
    */

    Route::get(

        '/about',

        function () {

            return view('customer.about');

        }

    )->name('customer.about');

    /*
    |--------------------------------------------------------------------------
    | CART
    |--------------------------------------------------------------------------
    */

    Route::get(

        '/cart',

        [CustomerController::class, 'cart']

    )->name('customer.cart');

    Route::post(

        '/cart/add/{product}',

        [CustomerController::class, 'addToCart']

    )->name('customer.cart.add');

    Route::post(

        '/cart/update/{id}',

        [CustomerController::class, 'updateCart']

    )->name('customer.cart.update');

    Route::delete(

        '/cart/remove/{id}',

        [CustomerController::class, 'removeCart']

    )->name('customer.cart.remove');

    /*
    |--------------------------------------------------------------------------
    | AUTH
    |--------------------------------------------------------------------------
    */

    Route::get(

        '/login',

        [CustomerAuthController::class, 'showLogin']

    )->name('customer.login');

    Route::post(

        '/login',

        [CustomerAuthController::class, 'login']

    )->name('customer.login.submit');

    Route::get(

        '/google/redirect',

        [CustomerAuthController::class, 'googleRedirect']

    )->name('customer.google');

    Route::get(

        '/google/callback',

        [CustomerAuthController::class, 'googleCallback']

    )->name('customer.google.callback');

    /*
    |--------------------------------------------------------------------------
    | CUSTOMER AUTH
    |--------------------------------------------------------------------------
    */

    Route::middleware('customer')->group(function () {

        Route::get(

            '/checkout',

            [CustomerController::class, 'checkout']

        )->name('customer.checkout');

        Route::post(

            '/checkout',

            [CustomerController::class, 'storeOrder']

        )->name('customer.checkout.store');

        Route::post(

            '/logout',

            [CustomerAuthController::class, 'logout']

        )->name('customer.logout');

    });

});