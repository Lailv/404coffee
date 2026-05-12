<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Supplier;

class SupplierController
extends Controller
{
    // =========================
    // STORE SUPPLIER
    // =========================
    public function store(
        Request $request
    )
    {
        $request->validate([

            'name' => 'required',

        ]);


        // =========================
        // SAVE SUPPLIER
        // =========================
        Supplier::create([

            'name' =>

                $request->name,

            'phone' =>

                $request->phone,

            'address' =>

                $request->address,

        ]);


        // =========================
        // REDIRECT BACK
        // =========================
        return redirect()

            ->route('admin.restock')

            ->with(

                'success',

                'Supplier berhasil ditambahkan'

            );
    }
}