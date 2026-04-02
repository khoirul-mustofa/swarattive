<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Booking\Pages\CreateBooking;
use App\Filament\Resources\Booking\Pages\EditBooking;
use App\Filament\Resources\Booking\Pages\ListBookings;
use App\Models\Booking;
use BackedEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static ?string $navigationLabel = 'Bookings';

    protected static ?string $modelLabel = 'Booking';

    protected static ?string $pluralModelLabel = 'Bookings';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'booking_code';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Customer Detail')
                    ->description('Client and contact information')
                    ->columns(2)
                    ->schema([
                        Select::make('client_id')
                            ->relationship('client', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')->required(),
                                TextInput::make('email')->email()->required(),
                                TextInput::make('phone')->tel()->required(),
                            ]),
                        TextInput::make('booking_code')
                            ->required()
                            ->disabled()
                            ->dehydrated(false)
                            ->placeholder('SWR-YYYYMMDD-XXX'),
                    ]),
                Section::make('Service & Team')
                    ->columns(2)
                    ->schema([
                        Select::make('service_id')
                            ->relationship('service', 'name')
                            ->required()
                            ->native(false)
                            ->disablePlaceholderSelection()
                            ->reactive()
                            ->afterStateUpdated(fn (callable $set) => $set('package_id', null)),
                        Select::make('package_id')
                            ->relationship('package', 'name', fn ($query, $get) => $query->where('service_id', $get('service_id')))
                            ->searchable()
                            ->preload(),
                        Select::make('team_member_id')
                            ->relationship('teamMember', 'name')
                            ->native(false)
                            ->disablePlaceholderSelection()
                            ->label('Photographer'),
                        TextInput::make('total_price')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),
                    ]),
                Section::make('Schedule & Location')
                    ->columns(2)
                    ->schema([
                        DatePicker::make('booking_date')
                            ->native(false)
                            ->required(),
                        TimePicker::make('booking_time')
                            ->native(false)
                            ->required(),
                        Select::make('location_type')
                            ->native(false)
                            ->disablePlaceholderSelection()
                            ->options([
                                'studio' => 'Studio',
                                'outdoor' => 'Outdoor',
                                'venue' => 'Venue',
                                'custom' => 'Custom',
                            ])
                            ->required(),
                        Textarea::make('location_address')
                            ->columnSpanFull(),
                    ]),
                Section::make('Status & Notes')
                    ->columns(2)
                    ->schema([
                        Select::make('status')
                            ->native(false)
                            ->disablePlaceholderSelection()
                            ->options([
                                'pending' => 'Pending',
                                'confirmed' => 'Confirmed',
                                'cancelled' => 'Cancelled',
                                'completed' => 'Completed',
                            ])
                            ->required()
                            ->default('pending'),
                        Textarea::make('notes')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('booking_code')
                    ->searchable()
                    ->sortable()
                    ->fontFamily('mono')
                    ->copyable(),
                TextColumn::make('client.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('service.name')
                    ->sortable(),
                TextColumn::make('booking_date')
                    ->date()
                    ->sortable(),
                SelectColumn::make('status')
                    ->native(false)
                    ->disablePlaceholderSelection()
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                        'completed' => 'Completed',
                    ])
                    ->sortable(),
                TextColumn::make('total_price')
                    ->money('IDR')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                        'completed' => 'Completed',
                    ]),
                Filter::make('booking_date')
                    ->form([
                        DatePicker::make('from'),
                        DatePicker::make('until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn ($query) => $query->whereDate('booking_date', '>=', $data['from']))
                            ->when($data['until'], fn ($query) => $query->whereDate('booking_date', '<=', $data['until']));
                    }),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBookings::route('/'),
            'create' => CreateBooking::route('/create'),
            'edit' => EditBooking::route('/{record}/edit'),
        ];
    }
}
