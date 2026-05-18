<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\POS\KitchenController;

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