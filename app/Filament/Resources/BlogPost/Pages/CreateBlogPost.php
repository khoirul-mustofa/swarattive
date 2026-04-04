<?php

namespace App\Filament\Resources\BlogPost\Pages;

use App\Filament\Resources\BlogPost\BlogPostResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBlogPost extends CreateRecord
{
    protected static string $resource = BlogPostResource::class;
}
