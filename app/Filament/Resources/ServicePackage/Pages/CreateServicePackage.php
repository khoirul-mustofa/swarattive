<?php

namespace App\Filament\Resources\ServicePackage\Pages;

use App\Filament\Resources\ServicePackage\ServicePackageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateServicePackage extends CreateRecord
{
    protected static string $resource = ServicePackageResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
