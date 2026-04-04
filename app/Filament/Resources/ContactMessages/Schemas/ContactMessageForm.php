<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->disabled(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->disabled(),
                TextInput::make('interest')
                    ->disabled(),
                Textarea::make('message')
                    ->disabled()
                    ->columnSpanFull(),
                TextInput::make('ip_address')
                    ->disabled(),
                DateTimePicker::make('read_at')
                    ->disabled(),
            ]);
    }
}
