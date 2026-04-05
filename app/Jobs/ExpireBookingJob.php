<?php

namespace App\Jobs;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ExpireBookingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $bookingId;

    /**
     * Create a new job instance.
     */
    public function __construct($bookingId)
    {
        $this->bookingId = $bookingId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $booking = Booking::find($this->bookingId);

        if (!$booking) {
            return;
        }

        // Only expire if it's still unpaid and pending
        if ($booking->payment_status === Booking::PAYMENT_UNPAID && $booking->status === Booking::STATUS_PENDING) {
            $booking->update([
                'payment_status' => Booking::PAYMENT_EXPIRED,
                'status' => Booking::STATUS_CANCELLED,
            ]);

            // Optional: Update associated pending payments to failed
            $booking->payments()->where('status', 'pending')->update(['status' => 'failed']);

            Log::info("Booking {$booking->booking_code} has expired and released.");
        }
    }
}
