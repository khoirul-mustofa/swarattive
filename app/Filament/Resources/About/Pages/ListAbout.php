<?php

namespace App\Filament\Resources\About\Pages;

use App\Filament\Resources\About\AboutResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAbout extends ListRecords
{
    protected static string $resource = AboutResource::class;

    public function mount(): void
    {
        redirect(AboutResource::getUrl('edit', ['record' => 1]));
    }

    protected function getHeaderActions(): array
    {
        return [
            // No Create action needed
        ];
    }
}
