<?php

namespace App\Filament\Resources\About\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use App\Enums\PageStatusEnum;
use App\Enums\BtsStageEnum;

class AboutForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Page State')
                    ->schema([
                        Select::make('status')
                            ->options(PageStatusEnum::class)
                            ->native(false)
                            ->required(),
                    ]),

                Section::make('Header / Page Banner')
                    ->schema([
                        Select::make('page_banner_image_source')
                            ->label('Sumber Banner')
                            ->options([
                                'upload' => 'Upload Gambar (Produksi)',
                                'url' => 'URL Foto Eksternal (Seeded/Unsplash)',
                            ])
                            ->default(fn ($get) => $get('page_banner_image_path') ? 'upload' : 'url')
                            ->live()
                            ->dehydrated(false),

                        FileUpload::make('page_banner_image_path')
                            ->label('Banner Image (Local)')
                            ->image()
                            ->imageEditor()
                            ->optimize('webp')
                            ->disk('public')
                            ->directory('abouts')
                            ->visible(fn ($get) => $get('page_banner_image_source') === 'upload')
                            ->required(fn ($get) => $get('page_banner_image_source') === 'upload'),

                        TextInput::make('page_banner_image_url')
                            ->label('Banner Image (External URL)')
                            ->url()
                            ->visible(fn ($get) => $get('page_banner_image_source') === 'url')
                            ->required(fn ($get) => $get('page_banner_image_source') === 'url'),
                    ]),

                Section::make('Our Story')
                    ->columns(2)
                    ->schema([
                        TextInput::make('story_title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        RichEditor::make('story_content')
                            ->required()
                            ->columnSpanFull(),
                        
                        Select::make('story_image_source')
                            ->label('Sumber Gambar Cerita')
                            ->options([
                                'upload' => 'Upload Gambar (Produksi)',
                                'url' => 'URL Foto Eksternal (Seeded/Unsplash)',
                            ])
                            ->default(fn ($get) => $get('story_image_path') ? 'upload' : 'url')
                            ->live()
                            ->dehydrated(false),

                        FileUpload::make('story_image_path')
                            ->label('Story Image (Local)')
                            ->image()
                            ->imageEditor()
                            ->optimize('webp')
                            ->disk('public')
                            ->directory('abouts')
                            ->visible(fn ($get) => $get('story_image_source') === 'upload')
                            ->required(fn ($get) => $get('story_image_source') === 'upload'),

                        TextInput::make('story_image_url')
                            ->label('Story Image (External URL)')
                            ->url()
                            ->visible(fn ($get) => $get('story_image_source') === 'url')
                            ->required(fn ($get) => $get('story_image_source') === 'url'),
                    ]),

                Section::make('Behind The Scenes')
                    ->schema([
                        TextInput::make('bts_title')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('bts_subtitle')
                            ->maxLength(255),
                        Repeater::make('bts_items')
                            ->label('Behind The Scenes Items')
                            ->schema([
                                Select::make('stage')
                                    ->required()
                                    ->native(false)
                                    ->options(BtsStageEnum::class),
                                
                                Select::make('image_source')
                                    ->label('Sumber Gambar')
                                    ->options([
                                        'upload' => 'Upload',
                                        'url' => 'URL',
                                    ])
                                    ->default('url')
                                    ->live()
                                    ->dehydrated(false),

                                FileUpload::make('image_path')
                                    ->label('Image Upload')
                                    ->image()
                                    ->disk('public')
                                    ->directory('abouts')
                                    ->visible(fn ($get) => $get('image_source') === 'upload'),

                                TextInput::make('image_url')
                                    ->label('External URL')
                                    ->url()
                                    ->visible(fn ($get) => $get('image_source') === 'url'),

                                Textarea::make('description')
                                    ->maxLength(65535)
                                    ->columnSpanFull(),
                            ])
                            ->columns(2)
                            ->columnSpanFull()
                            ->defaultItems(3)
                            ->reorderable()
                            ->collapsible(),
                    ]),
            ]);
    }
}
