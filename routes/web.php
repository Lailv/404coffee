<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\POS\KitchenController;
use App\Http\Controllers\Midtrans\CallbackController;

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return redirect('/login');

});

/*
|--------------------------------------------------------------------------
| MIDTRANS CALLBACK
|--------------------------------------------------------------------------
| Satu-satunya webhook global untuk semua notifikasi Midtrans,
| baik dari order Customer maupun order POS.
| URL INI yang didaftarkan di Dashboard Midtrans ->
| Settings -> Configuration -> Payment Notification URL
*/

Route::post(

    '/midtrans/callback',

    [CallbackController::class, 'handle']

)->name('midtrans.callback');

/*
|--------------------------------------------------------------------------
| LOAD MODULE ROUTES
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

require __DIR__.'/admin.php';

require __DIR__.'/pos.php';

require __DIR__.'/customer.php';

/*
|--------------------------------------------------------------------------
| KITCHEN
|--------------------------------------------------------------------------
*/

Route::get(

    '/kitchen',

    [KitchenController::class, 'index']

)->name('kitchen');

Route::post(

    '/kitchen/{id}/done',

    [KitchenController::class, 'done']

)->name('kitchen.done');