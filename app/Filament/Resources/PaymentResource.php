<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Payment\Pages\CreatePayment;
use App\Filament\Resources\Payment\Pages\EditPayment;
use App\Filament\Resources\Payment\Pages\ListPayments;
use App\Models\Payment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCreditCard;

    protected static ?string $navigationLabel = 'Payments';

    protected static ?string $modelLabel = 'Payment';

    protected static ?string $pluralModelLabel = 'Payments';

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'payment_code';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Payment Detail')
                    ->columns(2)
                    ->schema([
                        \Filament\Forms\Components\Select::make('booking_id')
                            ->relationship('booking', 'booking_code')
                            ->required()
                            ->searchable()
                            ->preload(),
                        \Filament\Forms\Components\Select::make('payment_method_id')
                        ->relationship('paymentMethod', 'name')
                            ->native(false)
                            ->disablePlaceholderSelection()
                            ->required(),
                        \Filament\Forms\Components\TextInput::make('amount')
                            ->numeric()
                            ->required()
                            ->prefix('Rp'),
                        \Filament\Forms\Components\DateTimePicker::make('payment_date')
    ->native(false)
    ->displayFormat('d M Y H:i')
    ->required()
    ->locale("id")
    ->default(now()),
                        \Filament\Forms\Components\Select::make('status')
                            ->native(false)
                            ->disablePlaceholderSelection()
                            ->options([
                                'pending' => 'Pending',
                                'completed' => 'Completed',
                                'failed' => 'Failed',
                                'refunded' => 'Refunded',
                            ])
                            ->required()
                            ->default('pending'),
                        \Filament\Forms\Components\FileUpload::make('proof_image')
                            ->image()
                            ->directory('payments/proofs')
                            ->columnSpanFull(),
                        \Filament\Forms\Components\Textarea::make('notes')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('payment_code')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('booking.booking_code')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('paymentMethod.name')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('amount')
                    ->money('IDR')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'completed' => 'success',
                        'failed' => 'danger',
                        'refunded' => 'gray',
                    })
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('payment_date')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        'failed' => 'Failed',
                        'refunded' => 'Refunded',
                    ]),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPayments::route('/'),
            'create' => CreatePayment::route('/create'),
            'edit' => EditPayment::route('/{record}/edit'),
        ];
    }
}
