<?php

namespace App\Services;

use App\Models\FinanceTransaction;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\Recipe;
use Illuminate\Support\Facades\DB;

class PosPaymentService
{
    /**
     * Finalisasi pembayaran order POS via Midtrans.
     *
     * Dipanggil dari 2 tempat:
     * 1. Frontend (Snap onSuccess) -> MidtransController@success
     * 2. Webhook server-to-server -> CallbackController@handle
     *
     * Idempotent: kalau order sudah 'paid', tidak akan potong stok/catat
     * finance lagi. Pakai lockForUpdate supaya aman kalau kedua trigger
     * di atas jalan hampir bersamaan (race condition).
     */
    public function finalizePayment(Order $order): Order
    {
        return DB::transaction(function () use ($order) {

            /** @var Order $locked */
            $locked = Order::where('id', $order->id)->lockForUpdate()->first();

            // GUARD: sudah difinalisasi sebelumnya, jangan diulang
            if ($locked->status === 'paid') {
                return $locked;
            }

            foreach ($locked->items as $item) {
                $recipes = Recipe::where('product_id', $item->product_id)->get();

                foreach ($recipes as $recipe) {
                    $inventory = Inventory::find($recipe->inventory_id);

                    if ($inventory) {
                        $usedStock = $recipe->quantity * $item->qty;
                        $inventory->stock -= $usedStock;
                        $inventory->save();
                    }
                }
            }

            FinanceTransaction::create([
                'type'     => 'income',
                'category' => 'Sales',
                'amount'   => $locked->total_amount,
                'note'     => 'Income dari penjualan POS (Midtrans) - ' . $locked->order_number,
            ]);

            $locked->update(['status' => 'paid']);

            return $locked->fresh();
        });
    }
}
