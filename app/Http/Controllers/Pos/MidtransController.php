<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\MidtransService;
use App\Services\PosPaymentService;

class MidtransController extends Controller
{
    // =========================
    // PAYMENT PAGE (opsional, kalau butuh halaman terpisah)
    // =========================
    public function payment(Order $order)
    {
        return view('pos.payment', compact('order'));
    }

    // =========================
    // GENERATE SNAP TOKEN
    // Dipakai juga untuk RETRY pembayaran order yang masih 'pending'
    // (tinggal panggil endpoint ini lagi dengan order id yang sama)
    // =========================
    public function pay(Order $order, MidtransService $midtransService)
    {
        try {
            $snapToken = $midtransService->getSnapToken($order);

            return response()->json([
                'success'    => true,
                'snap_token' => $snapToken,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    // =========================
    // PAYMENT SUCCESS
    // Dipanggil dari Snap.js onSuccess di frontend.
    // Idempotent -> aman walau webhook juga finalize order yang sama.
    // =========================
    public function success(Order $order, PosPaymentService $posPaymentService)
    {
        $order = $posPaymentService->finalizePayment($order);

        // Set flash yang sama seperti cash flow, supaya receipt modal
        // di /pos muncul otomatis setelah redirect dari frontend.
        session()->flash('show_receipt', true);
        session()->flash('last_order_id', $order->id);

        return response()->json([
            'success'  => true,
            'order_id' => $order->id,
            'status'   => $order->status,
        ]);
    }
}
