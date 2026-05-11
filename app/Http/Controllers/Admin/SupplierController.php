<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // =========================
    // SUPPLIER PAGE
    // =========================
    public function index()
    {
        $suppliers = Supplier::latest()->get();

        return view(

            'admin.supplier.index',

            compact('suppliers')

        );
    }


    // =========================
    // CREATE SUPPLIER PAGE
    // =========================
    public function create()
    {
        return view(

            'admin.supplier.create'

        );
    }


    // =========================
    // STORE SUPPLIER
    // =========================
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',

        ]);

        Supplier::create([

            'name' => $request->name,

            'phone' => $request->phone,

            'address' => $request->address,

        ]);

        return redirect()

            ->route('admin.supplier')

            ->with(

                'success',

                'Supplier berhasil ditambahkan'

            );
    }
}