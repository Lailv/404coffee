<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Inventory;

class InventoryController extends Controller
{
    // =========================
    // INVENTORY PAGE
    // =========================
    public function inventory()
    {
        // LOGIN CHECK
        if (!auth()->check()) {

            return redirect('/login');
        }

        // ADMIN ONLY
        if (auth()->user()->role !== 'admin') {

            abort(403);
        }

        // GET INVENTORY
        $inventories = Inventory::all();

        return view(

            'admin.inventory',

            compact('inventories')
        );
    }

    // =========================
    // STORE INVENTORY
    // =========================
    public function storeInventory(
        Request $request
    ) {

        Inventory::create([

            'ingredient_code' =>
                $request->ingredient_code,

            'name' =>
                $request->name,

            'category' =>
                $request->category,

            'stock' =>
                $request->stock,

            'unit' =>
                $request->unit,

            'min_stock' =>
                $request->min_stock
        ]);

        return redirect()->back()

            ->with(

                'success',

                'Ingredient berhasil ditambah'
            );
    }

    // =========================
    // UPDATE INVENTORY
    // =========================
    public function updateInventory(
        Request $request,
        $id
    ) {

        $inventory = Inventory::findOrFail($id);

        $inventory->update([

            'ingredient_code' =>
                $request->ingredient_code,

            'name' =>
                $request->name,

            'category' =>
                $request->category,

            'stock' =>
                $request->stock,

            'unit' =>
                $request->unit,

            'min_stock' =>
                $request->min_stock
        ]);

        return redirect()->back()

            ->with(

                'success',

                'Ingredient berhasil diupdate'
            );
    }
}