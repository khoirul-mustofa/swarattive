<?php

namespace App\Filament\Resources\Payment\Pages;

use App\Filament\Resources\PaymentResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePayment extends CreateRecord
{
    protected static string $resource = PaymentResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['payment_code'])) {
            $data['payment_code'] = 'PAY-' . now()->format('YmdHis') . '-' . strtoupper(str()->random(4));
        }

        return $data;
    }
}
