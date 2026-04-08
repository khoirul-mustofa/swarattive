<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;
use App\Models\ServicePackage;
use App\Models\TeamMember;
use App\Models\Client;
use App\Models\Booking;
use App\Models\Payment;
use App\Services\MidtransService;
use App\Jobs\ExpireBookingJob;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BookingForm extends Component
{
    public $services;
    public $teamMembers;

    // Form inputs
    public $selectedService = null;
    public $selectedPackage = null;
    public $bookingDate;
    public $bookingTime = '';
    public $locationType = 'studio';
    public $locationAddress = '';
    public $clientName = '';
    public $clientEmail = '';
    public $clientPhone = '';
    public $notes = '';
    public $paymentMethod = 'va'; // Default to Bank Transfer

    // Computed / Dynamic
    public $availablePackages = [];
    public $totalAmount = 0;
    public $selectedServiceName = '';
    public $selectedPackageName = '';
    public $adminFee = 0;
    public $grossAmount = 0;

    public function mount()
    {
        $this->services = Service::with(['category', 'packages'])->active()->ordered()->get();
        $this->teamMembers = TeamMember::active()->ordered()->get();
        $this->calculateFees();
    }

    public function updatedSelectedService($value)
    {
        $this->selectedPackage = null;
        $this->selectedPackageName = '';
        $this->availablePackages = [];
        $this->totalAmount = 0;

        if ($value) {
            $service = collect($this->services)->firstWhere('id', $value);
            if ($service) {
                $this->selectedServiceName = $service->name;
                $this->availablePackages = $service->packages;
                $this->totalAmount = $service->base_price;
            }
        } else {
            $this->selectedServiceName = '';
        }
        $this->calculateFees();
    }

    public function updatedSelectedPackage($value)
    {
        if ($value) {
            $package = collect($this->availablePackages)->firstWhere('id', $value);
            if ($package) {
                $this->selectedPackageName = $package->name;
                $this->totalAmount = $package->price;
            }
        } else {
            $this->selectedPackageName = '';
            // Revert to service base price
            $service = collect($this->services)->firstWhere('id', $this->selectedService);
            if ($service) {
                $this->totalAmount = $service->base_price;
            }
        }
        $this->calculateFees();
    }

    public function updatedPaymentMethod()
    {
        $this->calculateFees();
    }

    public function calculateFees()
    {
        $basePrice = $this->totalAmount ?: 0;
        $fee = 0;

        switch ($this->paymentMethod) {
            case 'va':
                $fee = 4000;
                break;
            case 'credit_card':
                $fee = ($basePrice * 0.029) + 2000;
                break;
            case 'gopay':
            case 'shopeepay':
            case 'kredivo':
                $fee = $basePrice * 0.02;
                break;
            case 'qris':
                $fee = $basePrice * 0.007;
                break;
            case 'dana':
                $fee = $basePrice * 0.015;
                break;
            case 'akulaku':
                $fee = $basePrice * 0.017;
                break;
            case 'indomaret':
            case 'alfamart':
                $fee = 5000;
                break;
            default:
                $fee = 0;
        }

        $this->adminFee = round($fee);
        $this->grossAmount = $basePrice + $this->adminFee;
    }

    public function submit()
    {
        $validated = $this->validate([
            'selectedService' => 'required|exists:services,id',
            'selectedPackage' => 'nullable|exists:service_packages,id',
            'bookingDate' => 'required|date|after_or_equal:today',
            'bookingTime' => 'required',
            'locationType' => 'required|in:studio,outdoor,venue,custom',
            'locationAddress' => 'required_if:locationType,venue,custom',
            'clientName' => 'required|string|max:255',
            'clientEmail' => 'required|email|max:255',
            'clientPhone' => 'required|string|max:20',
            'notes' => 'nullable|string',
        ]);

        // Find or create client
        $client = Client::firstOrCreate(
            ['email' => $this->clientEmail],
            [
                'name' => $this->clientName,
                'phone' => $this->clientPhone,
            ]
        );

        // Start Transaction with Locking
        return DB::transaction(function () use ($client) {
            // Check for double booking with lock
            $existing = Booking::where('booking_date', $this->bookingDate)
                ->where('booking_time', $this->bookingTime)
                ->whereIn('status', [Booking::STATUS_PENDING, Booking::STATUS_CONFIRMED])
                ->lockForUpdate()
                ->first();

            if ($existing) {
                $this->addError('bookingTime', 'Maaf, slot waktu ini sudah terisi. Silakan pilih waktu lain.');
                return;
            }

            // Generate booking code
            $date = Carbon::now()->format('Ymd');
            $count = Booking::whereDate('created_at', today())->count() + 1;
            $bookingCode = 'SWR-' . $date . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);

            // Create booking
            $booking = Booking::create([
                'booking_code' => $bookingCode,
                'client_id' => $client->id,
                'service_id' => $this->selectedService,
                'package_id' => $this->selectedPackage ?: null,
                'booking_date' => $this->bookingDate,
                'booking_time' => $this->bookingTime,
                'location_type' => $this->locationType,
                'location_address' => $this->locationAddress ?: null,
                'total_price' => $this->totalAmount,
                'admin_fee' => $this->adminFee,
                'status' => Booking::STATUS_PENDING,
                'payment_status' => Booking::PAYMENT_UNPAID,
                'notes' => $this->notes ?: null,
            ]);

            // Calculate payment amount (Base + Fee)
            $payableAmount = $this->totalAmount + $this->adminFee;

            // Create Payment Record
            $paymentId = 'PAY-' . $bookingCode . '-FULL';
            $payment = Payment::create([
                'booking_id' => $booking->id,
                'external_id' => $paymentId,
                'amount' => $this->totalAmount,
                'admin_fee' => $this->adminFee,
                'payment_type' => 'full_payment', // Set to full_payment implicitly
                'status' => 'pending', 
            ]);

            // Generate Snap Token
            $midtrans = new MidtransService();
            $snapToken = $midtrans->createSnapToken($booking, $payment);

            if ($snapToken) {
                $payment->update(['snap_token' => $snapToken]);
            }

            // Dispatch Expiration Job (60 minutes)
            ExpireBookingJob::dispatch($booking->id)->delay(now()->addMinutes(60));

            return redirect()->route('booking.status', $booking->booking_code)
                ->with('success', 'Booking created! Please complete your payment.');
        });
    }

    public function render()
    {
        return view('livewire.booking-form');
    }
}
