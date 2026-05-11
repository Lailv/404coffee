<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Restock;
use App\Models\Supplier;
use Illuminate\Http\Request;

class RestockController extends Controller
{
    public function index()
    {
        $restocks = Restock::with(['inventory', 'supplier'])
            ->latest()
            ->get();

        return view('admin.restock.index', compact('restocks'));
    }

    public function create()
    {
        $inventories = Inventory::all();
        $suppliers = Supplier::all();

        return view('admin.restock.create', compact('inventories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'inventory_id' => 'required',
            'supplier_id' => 'required',
            'quantity' => 'required|numeric',
            'purchase_price' => 'required|numeric',
        ]);

        $inventory = Inventory::findOrFail($request->inventory_id);

        $totalPrice = $request->quantity * $request->purchase_price;

        Restock::create([
            'inventory_id' => $request->inventory_id,
            'supplier_id' => $request->supplier_id,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'purchase_price' => $request->purchase_price,
            'total_price' => $totalPrice,
            'notes' => $request->notes,
        ]);

        // update stock inventory
        $inventory->stock += $request->quantity;
        $inventory->save();

        return redirect()->route('restock.index')
            ->with('success', 'Restock berhasil ditambahkan');
    }
}