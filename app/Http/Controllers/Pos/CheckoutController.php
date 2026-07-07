<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Models\FinanceTransaction;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Recipe;
use App\Services\MidtransService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // =========================
    // CHECKOUT (entry point)
    // =========================
    public function checkout(Request $request, MidtransService $midtransService)
    {
        // CART
        $cart = session()->get('cart', []);

        // CEK CART
        if (empty($cart)) {
            if ($request->wantsJson() || $request->payment_method === 'midtrans') {
                return response()->json([
                    'success' => false,
                    'message' => 'Cart kosong',
                ], 422);
            }

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

        if ($payment === 'midtrans') {
            return $this->checkoutMidtrans($request, $cart, $total, $midtransService);
        }

        return $this->checkoutCash($request, $cart, $total);
    }

    // =========================
    // CASH: PERSIS PERILAKU LAMA
    // (order langsung 'paid', stok & finance langsung diproses)
    // =========================
    private function checkoutCash(Request $request, array $cart, float $total)
    {
        $order = Order::create([
            'order_number'   => $this->generateOrderNumber(),
            'customer_name'  => $request->customer_name,
            'total_amount'   => $total,
            'payment_method' => 'cash',
            'order_type'     => 'pos',
            'status'         => 'paid',
        ]);

        FinanceTransaction::create([
            'type'     => 'income',
            'category' => 'Sales',
            'amount'   => $total,
            'note'     => 'Income dari penjualan POS - ' . $order->order_number,
        ]);

        foreach ($cart as $item) {
            $note = $request->notes[$item['id']] ?? null;

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item['id'],
                'qty'        => $item['qty'],
                'price'      => $item['price'],
                'note'       => $note,
            ]);

            $recipes = Recipe::where('product_id', $item['id'])->get();

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
    // MIDTRANS: order dibuat 'pending' dulu,
    // stok & finance BARU diproses saat finalizePayment()
    // (dipanggil dari MidtransController@success ATAU webhook)
    // =========================
    private function checkoutMidtrans(Request $request, array $cart, float $total, MidtransService $midtransService)
    {
        $order = Order::create([
            'order_number'   => $this->generateOrderNumber(),
            'customer_name'  => $request->customer_name,
            'total_amount'   => $total,
            'payment_method' => 'midtrans',
            'order_type'     => 'pos',
            'status'         => 'pending',
        ]);

        foreach ($cart as $item) {
            $note = $request->notes[$item['id']] ?? null;

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item['id'],
                'qty'        => $item['qty'],
                'price'      => $item['price'],
                'note'       => $note,
            ]);
        }

        // Cart dikosongkan karena item sudah tersimpan permanen di order_items.
        // Kalau pembayaran gagal/dibatalkan, kasir retry lewat tombol
        // "Bayar Ulang" yang hit ulang endpoint pos.payment.pay dengan order ini.
        session()->forget('cart');

        try {
            $snapToken = $midtransService->getSnapToken($order);

            return response()->json([
                'success'      => true,
                'order_id'     => $order->id,
                'order_number' => $order->order_number,
                'snap_token'   => $snapToken,
                'total'        => $total,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success'  => false,
                'message'  => $e->getMessage(),
                'order_id' => $order->id,
            ], 500);
        }
    }

    private function generateOrderNumber(): string
    {
        // ORD-<timestamp><random 3 digit> supaya lebih tahan collision
        // dibanding cuma ORD-<timestamp> kalau ada 2 checkout di detik sama.
        return 'ORD-' . time() . rand(100, 999);
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
