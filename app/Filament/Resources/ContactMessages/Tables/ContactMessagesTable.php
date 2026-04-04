<?php

namespace App\Filament\Resources\ContactMessages\Tables;

use App\Filament\Resources\ContactMessages\ContactMessageResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactMessagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('interest')
                    ->badge(),
                TextColumn::make('message')
                    ->limit(50),
                TextColumn::make('read_at')
                    ->label('Status')
                    ->badge()
                    ->state(fn ($record): string => $record->read_at ? 'Read' : 'New')
                    ->color(fn (string $state): string => $state === 'Read' ? 'success' : 'danger')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Received At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                // EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->recordUrl(fn ($record) => ContactMessageResource::getUrl('view', ['record' => $record]));
    }
}
