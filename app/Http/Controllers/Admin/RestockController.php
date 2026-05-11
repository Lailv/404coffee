<?php

namespace App\Http\Controllers\Admin;

use App\Models\FinanceTransaction;
use App\Models\Inventory;
use App\Http\Controllers\Controller;
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
        'qty' => 'required|numeric',
        'price' => 'required|numeric',

    ]);


    // TOTAL
    $total = $request->qty * $request->price;


    // SAVE RESTOCK
    $restock = Restock::create([

        'inventory_id' => $request->inventory_id,

        'supplier_id' => $request->supplier_id,

        'qty' => $request->qty,

        'price' => $request->price,

        'total' => $total,

    ]);


    // UPDATE INVENTORY STOCK
    $inventory = Inventory::find($request->inventory_id);

    $inventory->stock += $request->qty;

    $inventory->save();


    // SAVE FINANCE EXPENSE
    FinanceTransaction::create([

        'type' => 'expense',

        'category' => 'Restock',

        'amount' => $total,

        'note' => 'Restock bahan dari supplier',

    ]);


    return redirect()

        ->route('admin.restock')

        ->with(

            'success',

            'Restock berhasil ditambahkan'

        );
}
}