<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Inventory;
use App\Models\Recipe;

class RecipeController extends Controller
{
    // =========================
    // RECIPES PAGE
    // =========================
    public function recipes()
    {
        // LOGIN CHECK
        if (!auth()->check()) {

            return redirect('/login');
        }

        // ADMIN ONLY
        if (auth()->user()->role !== 'admin') {

            abort(403);
        }

        // PRODUCT YANG BELUM PUNYA RECIPE
        $usedProducts = Recipe::pluck(
            'product_id'
        );

        $products = Product::whereNotIn(
            'id',
            $usedProducts
        )->get();

        // INVENTORIES
        $inventories = Inventory::all();

        // GROUPED RECIPES
        $recipeGroups = Recipe::with(
                'product'
            )
            ->select('product_id')
            ->groupBy('product_id')
            ->get();

        return view(
            'admin.recipes',
            compact(
                'products',
                'inventories',
                'recipeGroups'
            )
        );
    }

    // =========================
    // STORE RECIPE
    // =========================
    public function storeRecipe(
        Request $request
    ) {

        // VALIDASI
        $request->validate([

            'product_id' =>
                'required',

            'inventory_id' =>
                'required|array',

            'quantity' =>
                'required|array'
        ]);

        // CEK DUPLICATE
        $alreadyExists = Recipe::where(
            'product_id',
            $request->product_id
        )->exists();

        if ($alreadyExists) {

            return redirect()->back()
                ->with(
                    'error',
                    'Recipe menu sudah ada'
                );
        }

        // LOOP INGREDIENT
        foreach (
            $request->inventory_id
            as $index => $inventoryId
        ) {

            Recipe::create([

                'product_id' =>
                    $request->product_id,

                'inventory_id' =>
                    $inventoryId,

                'quantity' =>
                    $request->quantity[$index]
            ]);
        }

        return redirect()->back()
            ->with(
                'success',
                'Recipe berhasil dibuat'
            );
    }

    // =========================
// DELETE RECIPE
// =========================
public function deleteRecipe(
    $productId
) {

    Recipe::where(
        'product_id',
        $productId
    )->delete();

    return redirect()->back()
        ->with(
            'success',
            'Recipe berhasil dihapus'
        );
}

}