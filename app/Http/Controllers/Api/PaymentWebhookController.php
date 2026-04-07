<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

class PaymentWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed !== $request->signature_key) {
            Log::warning('Midtrans Webhook: Invalid Signature', ['request' => $request->all()]);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $payment = Payment::where('external_id', $request->order_id)->first();

        if (!$payment) {
            Log::error('Midtrans Webhook: Payment Not Found', ['order_id' => $request->order_id]);
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $transactionStatus = $request->transaction_status;
        $type = $request->payment_type;
        $orderId = $request->order_id;
        $fraudStatus = $request->fraud_status;

        if ($transactionStatus == 'capture') {
            if ($type == 'credit_card') {
                if ($fraudStatus == 'challenge') {
                    $payment->update(['status' => 'pending']);
                } else {
                    $this->markAsPaid($payment);
                }
            }
        } else if ($transactionStatus == 'settlement') {
            $this->markAsPaid($payment);
        } else if ($transactionStatus == 'pending') {
            $payment->update(['status' => 'pending']);
        } else if ($transactionStatus == 'deny') {
            $payment->update(['status' => 'failed']);
            $payment->booking->update(['payment_status' => Booking::PAYMENT_FAILED]);
        } else if ($transactionStatus == 'expire') {
            $payment->update(['status' => 'failed']);
            $payment->booking->update(['payment_status' => Booking::PAYMENT_EXPIRED]);
        } else if ($transactionStatus == 'cancel') {
            $payment->update(['status' => 'failed']);
            $payment->booking->update(['payment_status' => Booking::PAYMENT_FAILED]);
        }

        return response()->json(['message' => 'Webhook processed']);
    }

    protected function markAsPaid(Payment $payment)
    {
        $payment->update([
            'status' => Payment::STATUS_SETTLEMENT,
            'paid_at' => now(),
        ]);

        $booking = $payment->booking;
        
        $booking->update([
            'payment_status' => Booking::PAYMENT_SETTLEMENT,
            'status' => Booking::STATUS_CONFIRMED,
            'confirmed_at' => now(),
        ]);
    }
}
