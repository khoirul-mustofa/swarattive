<?php

namespace App\Filament\Resources\ContactSettings\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ContactSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Kontak')
                    ->description('Kelola informasi yang ditampilkan di halaman kontak.')
                    ->schema([
                        TextInput::make('office_name')
                            ->label('Nama Kantor')
                            ->required(),
                        Textarea::make('address')
                            ->label('Alamat Lengkap')
                            ->required()
                            ->rows(3),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required(),
                        TextInput::make('phone')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->required(),
                    ])->columns(2),

                Section::make('Google Maps')
                    ->description('Masukkan koordinat lokasi (Latitude, Longitude).')
                    ->schema([
                        TextInput::make('map_coordinates')
                            ->label('Koordinat Lokasi')
                            ->placeholder('-2.621959, 101.357772')
                            ->helperText('Contoh: -6.200000, 106.816666')
                            ->required(),
                    ]),
            ]);
    }
}
