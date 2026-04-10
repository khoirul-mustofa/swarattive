<?php

namespace App\Filament\Resources\Booking;

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
use Filament\Actions\Action;
use App\Models\SiteSetting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static ?string $navigationLabel = 'Bookings';

    protected static ?string $modelLabel = 'Booking';

    protected static ?string $pluralModelLabel = 'Bookings';

    protected static string|\UnitEnum|null $navigationGroup = 'Operasional Bisnis';
    protected static ?int $navigationSort = 1;

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
                            ->native(false)
                            ->disablePlaceholderSelection()
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
                            ->required()
                            ->label('Base Price'),
                        TextInput::make('admin_fee')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->label('Admin Fee (Midtrans)'),
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
                        Select::make('production_progress')
                            ->label('Progres Produksi')
                            ->native(false)
                            ->disablePlaceholderSelection()
                            ->options([
                                'menunggu_pembayaran' => '1. Menunggu Pembayaran',
                                'menunggu_jadwal' => '2. Menunggu Jadwal',
                                'pelaksanaan' => '3. Pelaksanaan / Sesi',
                                'editing' => '4. Proses Editing',
                                'siap_dikirim' => '5. Hasil Siap Dikirim',
                                'selesai' => '6. Selesai',
                            ])
                            ->required()
                            ->default('menunggu_pembayaran'),
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
                SelectColumn::make('production_progress')
                    ->label('Progres')
                    ->native(false)
                    ->disablePlaceholderSelection()
                    ->options([
                        'menunggu_pembayaran' => '1. Menunggu Pembayaran',
                        'menunggu_jadwal' => '2. Menunggu Jadwal',
                        'pelaksanaan' => '3. Pelaksanaan / Sesi',
                        'editing' => '4. Proses Editing',
                        'siap_dikirim' => '5. Hasil Siap Dikirim',
                        'selesai' => '6. Selesai',
                    ])
                    ->sortable(),
                TextColumn::make('total_price')
                    ->money('IDR')
                    ->sortable()
                    ->label('Base Price'),
                TextColumn::make('admin_fee')
                    ->money('IDR')
                    ->sortable()
                    ->label('Admin Fee'),
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
                Action::make('downloadInvoice')
                    ->label('Invoice')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('warning')
                    ->action(function (Booking $record) {
                        $siteName = SiteSetting::getValue('site_name', 'Swarattive');
                        $contactAddress = SiteSetting::getValue('contact_address', 'Jakarta, Indonesia');
                        $contactPhone = SiteSetting::getValue('contact_phone', '+62 812 3456 7890');
                        $contactEmail = SiteSetting::getValue('contact_email', 'hello@swarattive.com');
                        
                        $logoPath = public_path('images/logo-primary.png');
                        $logoBase64 = null;
                        if (file_exists($logoPath)) {
                            $type = pathinfo($logoPath, PATHINFO_EXTENSION);
                            $data = file_get_contents($logoPath);
                            $logoBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                        }

                        $pdf = Pdf::loadView('pdf.booking-invoice', [
                            'booking' => $record,
                            'logo' => $logoBase64,
                            'siteName' => $siteName,
                            'contactAddress' => $contactAddress,
                            'contactPhone' => $contactPhone,
                            'contactEmail' => $contactEmail,
                        ]);

                        return response()->streamDownload(function () use ($pdf) {
                            echo $pdf->stream();
                        }, "invoice-{$record->booking_code}.pdf");
                    }),
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
