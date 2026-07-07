<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FinanceTransaction;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Recipe;
use App\Models\Inventory;

class CheckoutController extends Controller
{
    // =========================
    // CHECKOUT
    // =========================
    public function checkout(Request $request)
    {
        // CART
        $cart = session()->get('cart', []);

        // CEK CART
        if (empty($cart)) {
            return redirect()
                ->back()
                ->with('error', 'Cart kosong');
        }

        // TOTAL
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        // PAYMENT
        $payment = $request->payment_method;

        // =========================
        // CREATE ORDER
        // =========================
        $order = Order::create([
            'order_number'   => 'ORD-' . time(),
            'customer_name'  => $request->customer_name,
            'total_amount'   => $total,
            'payment_method' => $payment,

            // POS langsung dianggap sudah dibayar
            'status'         => 'paid',
        ]);

        // =========================
        // SAVE FINANCE INCOME
        // =========================
        FinanceTransaction::create([
            'type'     => 'income',
            'category' => 'Sales',
            'amount'   => $total,
            'note'     => 'Income dari penjualan POS',
        ]);

        // =========================
        // SAVE ORDER ITEMS
        // =========================
        foreach ($cart as $item) {

            // CUSTOMER NOTE
            $note = $request->notes[$item['id']] ?? null;

            // SAVE ITEM
            OrderItem::create([
                'order_id'  => $order->id,
                'product_id'=> $item['id'],
                'qty'       => $item['qty'],
                'price'     => $item['price'],
                'note'      => $note,
            ]);

            // =========================
            // GET RECIPE
            // =========================
            $recipes = Recipe::where('product_id', $item['id'])->get();

            // =========================
            // REDUCE STOCK
            // =========================
            foreach ($recipes as $recipe) {

                $inventory = Inventory::find($recipe->inventory_id);

                if ($inventory) {

                    $usedStock = $recipe->quantity * $item['qty'];

                    $inventory->stock -= $usedStock;
                    $inventory->save();
                }
            }
        }

        // CLEAR CART
        session()->forget('cart');

        // REDIRECT BACK TO POS
        return redirect('/pos')
            ->with('show_receipt', true)
            ->with('last_order_id', $order->id);
    }

    // =========================
    // RECEIPT
    // =========================
    public function receipt($id)
    {
        $order = Order::findOrFail($id);

        $items = OrderItem::where('order_id', $order->id)->get();

        return view('kasir.receipt', compact('order', 'items'));
    }
}