<?php

namespace App\Filament\Resources\BlogPost\Pages;

use App\Filament\Resources\BlogPost\BlogPostResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBlogPost extends ViewRecord
{
    protected static string $resource = BlogPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
