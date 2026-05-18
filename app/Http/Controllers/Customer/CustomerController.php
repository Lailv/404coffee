<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;

class CustomerController extends Controller
{
    public function home()
    {
        return view('customer.home');
    }

    public function menu()
    {
        $coffeeProducts = Product::whereHas(

            'category',

            function ($query) {

                $query->where('name', 'Coffee');

            }

        )->latest()->get();

        $nonCoffeeProducts = Product::whereHas(

            'category',

            function ($query) {

                $query->where('name', 'Non Coffee');

            }

        )->latest()->get();

        $foodProducts = Product::whereHas(

            'category',

            function ($query) {

                $query->where('name', 'Food');

            }

        )->latest()->get();

        return view(

            'customer.menu',

            compact(

                'coffeeProducts',
                'nonCoffeeProducts',
                'foodProducts'

            )

        );
    }
}