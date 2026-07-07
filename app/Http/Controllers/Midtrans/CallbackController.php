<?php

namespace App\Http\Controllers\Midtrans;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\PosPaymentService;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

/**
 * SATU-SATUNYA endpoint webhook yang didaftarkan di dashboard Midtrans
 * (Settings -> Configuration -> Payment Notification URL).
 *
 * Menangani notifikasi untuk order dari sumber manapun (customer / POS),
 * karena keduanya sama-sama tersimpan di tabel `orders`.
 *
 * - order_type === 'pos'  -> potong stok + catat finance via PosPaymentService
 * - selain itu (customer) -> hanya update status (sama seperti behavior lama,
 *   TIDAK menyentuh logic stok/finance milik flow customer)
 */
class CallbackController extends Controller
{
    public function handle(Request $request, PosPaymentService $posPaymentService)
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = config('midtrans.is_sanitized');
        Config::$is3ds        = config('midtrans.is_3ds');

        $notification = new Notification();

        $order = Order::where('order_number', $notification->order_id)->first();

        if (!$order) {
            return response()->json([
                'message' => 'Order not found',
            ], 404);
        }

        switch ($notification->transaction_status) {

            case 'capture':
            case 'settlement':

                if ($order->order_type === 'pos') {
                    $posPaymentService->finalizePayment($order);
                } else {
                    $order->update(['status' => 'paid']);
                }

                break;

            case 'pending':
                $order->update(['status' => 'pending']);
                break;

            case 'expire':
                $order->update(['status' => 'expired']);
                break;

            case 'cancel':
            case 'deny':
                $order->update(['status' => 'cancelled']);
                break;
        }

        return response()->json([
            'success' => true,
        ]);
    }
}
