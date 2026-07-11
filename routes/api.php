<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuController;

Route::get('/test', function () {
    return response()->json([
        'status' => true,
        'message' => 'API 404.Coffee Berhasil'
    ]);
});

Route::get('/menus', [MenuController::class, 'index']);