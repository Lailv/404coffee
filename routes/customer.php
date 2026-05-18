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

    /*
    |--------------------------------------------------------------------------
    | GOOGLE LOGIN
    |--------------------------------------------------------------------------
    */

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

        Route::post(

            '/logout',

            [CustomerAuthController::class, 'logout']

        )->name('customer.logout');

    });

});