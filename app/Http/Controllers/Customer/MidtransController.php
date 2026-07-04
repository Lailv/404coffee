<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;

class MidtransController extends Controller
{
    public function payment(Order $order)
    {
        return view(

            'customer.payment',

            compact('order')

        );
    }

    public function pay(Order $order)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $params = [

            'transaction_details' => [

                'order_id' => $order->order_number,

                'gross_amount' => $order->total_amount,

            ],

            'customer_details' => [

                'first_name' => $order->customer_name,

                'phone' => $order->customer_phone,

            ],

        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json([

            'snap_token' => $snapToken,

        ]);
    }

    // ======================================================
    // PAYMENT SUCCESS (UNTUK DEMO)
    // ======================================================

    public function success(Order $order)
    {
        $order->update([

            'status' => 'paid'

        ]);

        session()->forget('cart');

        return response()->json([

            'success' => true

        ]);
    }

    // ======================================================
    // CALLBACK MIDTRANS (UNTUK PRODUCTION)
    // ======================================================

    public function callback(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $notification = new Notification();

        $order = Order::where(

            'order_number',

            $notification->order_id

        )->first();

        if (!$order) {

            return response()->json([

                'message' => 'Order not found'

            ], 404);

        }

        $transaction = $notification->transaction_status;

        switch ($transaction) {

            case 'capture':
            case 'settlement':

                $order->update([

                    'status' => 'paid'

                ]);

                break;

            case 'pending':

                $order->update([

                    'status' => 'pending'

                ]);

                break;

            case 'expire':

                $order->update([

                    'status' => 'expired'

                ]);

                break;

            case 'cancel':
            case 'deny':

                $order->update([

                    'status' => 'cancelled'

                ]);

                break;
        }

        return response()->json([

            'success' => true

        ]);
    }
}