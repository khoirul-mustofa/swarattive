<?php

namespace App\Filament\Resources\HeroSlides\Schemas;

use Filament\Schemas\Schema;

class HeroSlideForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Gambar & Detail')
                    ->schema([
                        \Filament\Forms\Components\FileUpload::make('image')
                            ->image()
                            ->directory('hero-slides')
                            ->required()
                            ->columnSpanFull()
                            ->helperText('Gambar utama untuk slider. Direkomendasikan ukuran 1920x1080px.'),
                        \Filament\Forms\Components\TextInput::make('title')
                            ->maxLength(255),
                        \Filament\Forms\Components\Textarea::make('description')
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ])->columns(1),

                \Filament\Schemas\Components\Section::make('Tombol & Pengaturan')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('button_text')
                            ->default('Pesan Sekarang')
                            ->maxLength(255),
                        \Filament\Forms\Components\TextInput::make('button_url')
                            ->default('/booking')
                            ->maxLength(255),
                        \Filament\Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Urutan tampilan (angka yang lebih kecil tampil lebih dulu).'),
                        \Filament\Forms\Components\Toggle::make('is_active')
                            ->default(true),
                    ])->columns(2),
            ]);
    }
}
