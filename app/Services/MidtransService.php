<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    /**
     * Create Snap Token for simplified checkout
     */
    public function createSnapToken(Booking $booking, Payment $payment)
    {
        $params = [
            'transaction_details' => [
                'order_id' => $payment->external_id,
                'gross_amount' => (int) $payment->amount,
            ],
            'customer_details' => [
                'first_name' => $booking->client->name,
                'email' => $booking->client->email,
                'phone' => $booking->client->phone,
            ],
            'item_details' => [
                [
                    'id' => $booking->service_id,
                    'price' => (int) $payment->amount,
                    'quantity' => 1,
                    'name' => $booking->service->name . ($booking->package ? ' - ' . $booking->package->name : ''),
                ]
            ],
            'enabled_payments' => [
                'credit_card', 'mandiri_clickpay', 'cimb_clicks',
                'bca_klikbca', 'bca_klikpay', 'bri_epay', 'echannel',
                'permata_va', 'bca_va', 'bni_va', 'bri_va', 'other_va',
                'gopay', 'indomaret', 'danamon_online', 'akulaku', 'shopeepay'
            ],
            'expiry' => [
                'start_time' => date('Y-m-d H:i:s O'),
                'unit' => 'minute',
                'duration' => 60
            ]
        ];

        try {
            return Snap::getSnapToken($params);
        } catch (\Exception $e) {
            Log::error('Midtrans Snap Error: ' . $e->getMessage());
            return null;
        }
    }
}
