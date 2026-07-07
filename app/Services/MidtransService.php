<?php

namespace App\Services;

use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = config('midtrans.is_sanitized');
        Config::$is3ds        = config('midtrans.is_3ds');
    }

    /**
     * Generate Snap Token untuk sebuah order.
     * order_number dipakai sebagai order_id di Midtrans (harus unik).
     */
    public function getSnapToken(Order $order): string
    {
        $params = [
            'transaction_details' => [
                'order_id'     => $order->order_number,
                'gross_amount' => (int) round($order->total_amount),
            ],
            'customer_details' => [
                'first_name' => $order->customer_name ?: 'Customer',
                'phone'      => $order->customer_phone ?? '',
            ],
        ];

        return Snap::getSnapToken($params);
    }
}
