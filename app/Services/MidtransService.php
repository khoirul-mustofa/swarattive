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
        // Bersihkan suffix acak sebelumnya jika ada (format: -XXXXX atau -FULL) untuk regenerasi
        // Kode booking asli (SWR-...) harus tetap utuh.
        $baseId = preg_replace('/-(FULL|[A-Z0-9]{5})$/', '', $payment->external_id);
        $uniqueId = $baseId . '-' . \Illuminate\Support\Str::upper(\Illuminate\Support\Str::random(5));
        
        // Update di database agar Webhook bisa menemukan datanya nanti
        $payment->update(['external_id' => $uniqueId]);

        $grossAmount = (int) ($payment->amount + $payment->admin_fee);

        $params = [
            'transaction_details' => [
                'order_id' => $uniqueId,
                'gross_amount' => $grossAmount,
            ],
            'customer_details' => [
                'first_name' => $booking->client->name,
                'email' => $booking->client->email,
                'phone' => $booking->client->phone,
            ],
            'item_details' => [
                [
                    'id' => 'SERVICE-' . $booking->service_id,
                    'price' => (int) $payment->amount,
                    'quantity' => 1,
                    'name' => $booking->service->name . ($booking->package ? ' - ' . $booking->package->name : ''),
                ],
                [
                    'id' => 'ADMIN-FEE',
                    'price' => (int) $payment->admin_fee,
                    'quantity' => 1,
                    'name' => 'Biaya Layanan/Admin',
                ]
            ],
            'expiry' => [
                'start_time' => date('Y-m-d H:i:s O'),
                'unit' => 'minute',
                'duration' => 60
            ]
        ];

        // Map enabled payments if needed, but for now we let it be flexible or use simple logic
        // If we want to be strict based on selection:
        /*
        $params['enabled_payments'] = match($payment->method) { ... };
        */

        try {
            return Snap::getSnapToken($params);
        } catch (\Exception $e) {
            Log::error('Midtrans Snap Error: ' . $e->getMessage());
            return null;
        }
    }
}
