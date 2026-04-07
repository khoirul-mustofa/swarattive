<?php

namespace App\Observers;

use App\Models\Booking;

class BookingObserver
{
    /**
     * Handle the Booking "created" event.
     */
    public function created(Booking $booking): void
    {
        //
    }

    /**
     * Handle the Booking "updated" event.
     */
    public function updated(Booking $booking): void
    {
        // Jika statusnya berubah dan menjadi confirmed
        if ($booking->isDirty('status') && $booking->status === Booking::STATUS_CONFIRMED) {
            // Send Email
            try {
                \Illuminate\Support\Facades\Mail::to($booking->client->email)
                    ->send(new \App\Mail\BookingStatusNotification($booking));
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Failed to send booking confirmation email: ' . $e->getMessage());
            }

            // Send WA
            try {
                $fonnteService = new \App\Services\FonnteService();
                $message = "Halo {$booking->client->name},\n\n";
                $message .= "Pesanan Anda dengan kode *{$booking->booking_code}* telah *DIKONFIRMASI*.\n\n";
                $message .= "Silakan cek status selengkapnya di: " . route('booking.status', $booking->booking_code) . "\n\n";
                $message .= "Terima kasih telah mempercayakan momen Anda kepada Swarattive!";
                
                $fonnteService->sendMessage($booking->client->phone, $message);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Failed to send booking confirmation WA: ' . $e->getMessage());
            }
        }
    }

    /**
     * Handle the Booking "deleted" event.
     */
    public function deleted(Booking $booking): void
    {
        //
    }

    /**
     * Handle the Booking "restored" event.
     */
    public function restored(Booking $booking): void
    {
        //
    }

    /**
     * Handle the Booking "force deleted" event.
     */
    public function forceDeleted(Booking $booking): void
    {
        //
    }
}
