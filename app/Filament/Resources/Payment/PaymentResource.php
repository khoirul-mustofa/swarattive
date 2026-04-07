<?php

namespace App\Filament\Resources\Payment;

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

    protected static string|\UnitEnum|null $navigationGroup = 'Operasional Bisnis';
    protected static ?int $navigationSort = 3;

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
                                'settlement' => 'Settlement',
                                'failed' => 'Failed',
                                'expire' => 'Expire',
                                'cancel' => 'Cancel',
                                'refunded' => 'Refunded',
                            ])
                            ->required()
                            ->default('pending'),
                        \Filament\Forms\Components\FileUpload::make('proof_image')
                            ->image()
                            ->disk('public')
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
                        Payment::STATUS_PENDING => 'warning',
                        Payment::STATUS_SETTLEMENT => 'success',
                        Payment::STATUS_FAILED => 'danger',
                        Payment::STATUS_EXPIRE => 'danger',
                        Payment::STATUS_CANCEL => 'danger',
                        Payment::STATUS_REFUNDED => 'gray',
                    })
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('payment_date')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('status')
                    ->options([
                        Payment::STATUS_PENDING => 'Pending',
                        Payment::STATUS_SETTLEMENT => 'Settlement',
                        Payment::STATUS_FAILED => 'Failed',
                        Payment::STATUS_EXPIRE => 'Expire',
                        Payment::STATUS_CANCEL => 'Cancel',
                        Payment::STATUS_REFUNDED => 'Refunded',
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
