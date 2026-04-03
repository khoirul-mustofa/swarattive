<?php

namespace App\Filament\Resources\ServicePackage\Pages;

use App\Filament\Resources\ServicePackage\ServicePackageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServicePackages extends ListRecords
{
    protected static string $resource = ServicePackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
