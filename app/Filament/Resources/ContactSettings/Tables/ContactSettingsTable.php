<?php

namespace App\Filament\Resources\ContactSettings\Tables;

use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('office_name')
                    ->label('Nama Kantor')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->icon('heroicon-o-envelope')
                    ->searchable(),
                TextColumn::make('phone')
                    ->icon('heroicon-o-phone')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Dibuat pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                // Kami membatasi penghapusan karena ini adalah singleton
            ]);
    }
}
