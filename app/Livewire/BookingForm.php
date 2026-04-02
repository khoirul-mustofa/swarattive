<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;
use App\Models\ServicePackage;
use App\Models\TeamMember;
use App\Models\Client;
use App\Models\Booking;
use Illuminate\Support\Carbon;

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
    public $selectedTeamMember = null;
    public $clientName = '';
    public $clientEmail = '';
    public $clientPhone = '';
    public $notes = '';

    // Computed / Dynamic
    public $availablePackages = [];
    public $totalAmount = 0;
    public $selectedServiceName = '';
    public $selectedPackageName = '';

    public function mount()
    {
        $this->services = Service::with(['category', 'packages'])->active()->ordered()->get();
        $this->teamMembers = TeamMember::active()->ordered()->get();
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
    }

    public function submit()
    {
        $validated = $this->validate([
            'selectedService' => 'required|exists:services,id',
            'selectedPackage' => 'nullable|exists:service_packages,id',
            'selectedTeamMember' => 'nullable|exists:team_members,id',
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
            'team_member_id' => $this->selectedTeamMember ?: null,
            'booking_date' => $this->bookingDate,
            'booking_time' => $this->bookingTime,
            'location_type' => $this->locationType,
            'location_address' => $this->locationAddress ?: null,
            'total_price' => $this->totalAmount,
            'status' => 'pending',
            'notes' => $this->notes ?: null,
        ]);

        return redirect()->route('booking.check')
            ->with('success', 'Booking created successfully! Your booking code is: ' . $bookingCode);
    }

    public function render()
    {
        return view('livewire.booking-form');
    }
}
