<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Product::with('category')->get();

        return response()->json($menus);
    }
}