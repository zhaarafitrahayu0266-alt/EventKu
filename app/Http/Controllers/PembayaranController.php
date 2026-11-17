<?php

namespace App\Http\Controllers;

use Midtrans\Config;
use Midtrans\Snap;

class PembayaranController extends Controller
{
    public function coba()
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = config('midtrans.is_sanitized');
        Config::$is3ds        = config('midtrans.is_3ds');

        $params = [
            'transaction_details' => [
                'order_id'     => 'TES-' . time(),
                'gross_amount' => 30000,
            ],
            'customer_details' => [
                'first_name' => 'Pelanggan Tes',
                'email'      => 'tes@example.com',
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('pembayaran.coba', compact('snapToken'));
    }
}