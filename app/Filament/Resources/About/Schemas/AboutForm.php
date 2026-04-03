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
                        FileUpload::make('page_banner_image_url')
                            ->label('Banner Image')
                            ->image()
                            ->disk('public')
                            ->directory('abouts')
                            ->columnSpanFull(),
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
                        FileUpload::make('story_image_url')
                            ->label('Story Image')
                            ->image()
                            ->disk('public')
                            ->directory('abouts')
                            ->columnSpanFull(),
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
                                FileUpload::make('image_url')
                                    ->label('Image')
                                    ->image()
                                    ->disk('public')
                                    ->directory('abouts'),
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
