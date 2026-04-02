<?php

namespace App\Filament\Resources\Booking\Pages;

use App\Filament\Resources\BookingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBooking extends CreateRecord
{
    protected static string $resource = BookingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['booking_code'])) {
            $date = now()->format('Ymd');
            $count = \App\Models\Booking::whereDate('created_at', today())->count() + 1;
            $data['booking_code'] = 'SWR-' . $date . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);
        }

        return $data;
    }
}
