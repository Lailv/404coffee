<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\FinanceTransaction;
use App\Models\Inventory;
use App\Models\Restock;
use App\Models\Supplier;

class RestockController
extends Controller
{
    // =========================
    // RESTOCK PAGE
    // =========================
    public function index()
    {
        $restocks = Restock::with([

                'inventory',
                'supplier'

            ])

            ->latest()

            ->get();


        $inventories = Inventory::all();

        $suppliers = Supplier::all();


        return view(

            'admin.restock',

            compact(

                'restocks',
                'inventories',
                'suppliers'

            )
        );
    }


    // =========================
    // STORE RESTOCK
    // =========================
    public function store(
        Request $request
    )
    {
        $request->validate([

            'inventory_id' => 'required',

            'supplier_id' => 'required',

            'qty' => 'required|numeric',

            'price' => 'required|numeric',

        ]);


        // =========================
        // TOTAL
        // =========================
        $total =

            $request->qty

            *

            $request->price;


        // =========================
        // SAVE RESTOCK
        // =========================
        $restock = Restock::create([

            'inventory_id' =>

                $request->inventory_id,

            'supplier_id' =>

                $request->supplier_id,

            'qty' =>

                $request->qty,

            'price' =>

                $request->price,

            'total' =>

                $total,

        ]);


        // =========================
        // UPDATE INVENTORY
        // =========================
        $inventory = Inventory::find(

            $request->inventory_id

        );

        if($inventory){

            $inventory->stock +=

                $request->qty;

            $inventory->save();
        }


        // =========================
        // GET SUPPLIER
        // =========================
        $supplier = Supplier::find(

            $request->supplier_id

        );


        // =========================
        // SAVE FINANCE EXPENSE
        // =========================
        FinanceTransaction::create([

            'type' => 'expense',

            'category' => 'Restock',

            'amount' => $total,

            'note' =>

                'Restock '

                .

                $inventory->name

                .

                ' dari '

                .

                $supplier->name,

        ]);


        return redirect()

            ->route('admin.restock')

            ->with(

                'success',

                'Restock berhasil ditambahkan'

            );
    }
}