<?php

namespace App\Filament\Resources\BlogPost\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

class BlogPostInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Post Detail')
                    ->schema([
                        TextEntry::make('title')
                            ->columnSpanFull(),
                        TextEntry::make('slug'),
                        TextEntry::make('excerpt')
                            ->lineClamp(3)
                            ->columnSpanFull(),
                        TextEntry::make('content')
                            ->html()
                            ->prose()
                            ->columnSpanFull(),
                        ImageEntry::make('image_url')
                            ->label('Thumbnail'),
                        TextEntry::make('tags')
                            ->badge(),
                    ])->columns(2),

                Section::make('Status')
                    ->schema([
                        IconEntry::make('is_published')
                            ->label('Published')
                            ->boolean(),
                        TextEntry::make('published_at')
                            ->dateTime(),
                        TextEntry::make('created_at')
                            ->dateTime(),
                    ])->columns(3),
            ]);
    }
}
