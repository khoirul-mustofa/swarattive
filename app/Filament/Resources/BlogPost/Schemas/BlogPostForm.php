<?php

namespace App\Filament\Resources\BlogPost\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Str;

class BlogPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Main Content')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Textarea::make('excerpt')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                        RichEditor::make('content')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Media & Tags')
                    ->schema([
                        Select::make('image_source')
                            ->label('Sumber Gambar')
                            ->options([
                                'upload' => 'Upload Gambar (Produksi)',
                                'url' => 'URL Foto Eksternal (Seeded/Unsplash)',
                            ])
                            ->default(fn ($get) => $get('image_path') ? 'upload' : 'url')
                            ->live()
                            ->dehydrated(false),
                        FileUpload::make('image_path')
                            ->label('Thumbnail Image (Local)')
                            ->image()
                            ->imageEditor()
                            ->optimize('webp')
                            ->disk('public')
                            ->directory('blog')
                            ->visible(fn ($get) => $get('image_source') === 'upload')
                            ->required(fn ($get) => $get('image_source') === 'upload'),
                        TextInput::make('image_url')
                            ->label('Thumbnail Image (External URL)')
                            ->url()
                            ->visible(fn ($get) => $get('image_source') === 'url')
                            ->required(fn ($get) => $get('image_source') === 'url'),
                        TagsInput::make('tags')
                            ->placeholder('Tambah tag baru')
                            ->separator(','),
                    ])->columns(2),

                Section::make('Publishing Status')
                    ->schema([
                        Toggle::make('is_published')
                            ->label('Published')
                            ->live(),
                        DateTimePicker::make('published_at')
                            ->label('Publish Date')
                            ->required(fn ($get) => $get('is_published'))
                            ->hidden(fn ($get) => !$get('is_published')),
                    ])->columns(2),
            ]);
    }
}
