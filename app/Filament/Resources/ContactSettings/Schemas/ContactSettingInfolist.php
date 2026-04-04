<?php

namespace App\Filament\Resources\ContactSettings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

class ContactSettingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Kontak')
                    ->schema([
                        TextEntry::make('office_name')
                            ->label('Nama Kantor'),
                        TextEntry::make('address')
                            ->label('Alamat Lengkap'),
                        TextEntry::make('email')
                            ->label('Email'),
                        TextEntry::make('phone')
                            ->label('Nomor Telepon'),
                        TextEntry::make('google_maps_iframe')
                            ->label('Google Maps Embed URL'),
                        TextEntry::make('google_maps_url')
                            ->label('Google Maps External URL'),
                    ])->columns(2),
            ]);
    }
}
