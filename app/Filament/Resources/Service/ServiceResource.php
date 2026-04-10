<?php

namespace App\Filament\Resources\Service;

use App\Filament\Resources\Service\Pages\CreateService;
use App\Filament\Resources\Service\Pages\EditService;
use App\Filament\Resources\Service\Pages\ListServices;
use App\Models\Service;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    protected static ?string $navigationLabel = 'Services';

    protected static ?string $modelLabel = 'Service';

    protected static ?string $pluralModelLabel = 'Services';

    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen Layanan';
    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Service Detail')
                    ->columns(2)
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('name')
                            ->label('Nama Layanan')
                            ->helperText('Contoh: Foto Pernikahan Paket Gold, Sesi Potret Wisuda, dll.')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($set, $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        \Filament\Forms\Components\TextInput::make('slug')
                            ->label('Slug / URL')
                            ->helperText('Slug otomatis dari nama, digunakan untuk URL layanan.')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        \Filament\Forms\Components\Select::make('category_id')
                            ->label('Kategori')
                            ->helperText('Pilih kategori besar untuk layanan ini.')
                            ->relationship('category', 'name')
                            ->native(false)
                            ->disablePlaceholderSelection()
                            ->required(),
                        \Filament\Forms\Components\TextInput::make('base_price')
                            ->label('Harga Dasar')
                            ->helperText('Harga awal untuk layanan ini.')
                            ->numeric()
                            ->required()
                            ->prefix('Rp'),
                        \Filament\Forms\Components\TextInput::make('duration_minutes')
                            ->label('Durasi (Menit)')
                            ->helperText('Estimasi waktu pengerjaan atau sesi foto.')
                            ->numeric()
                            ->label('Duration (Minutes)'),
                        \Filament\Forms\Components\Select::make('image_source')
                            ->label('Sumber Gambar')
                            ->helperText('Pilih metode pengisian gambar layanan.')
                            ->options([
                                'upload' => 'Upload Gambar (Produksi)',
                                'url' => 'URL Foto Eksternal (Seeded/Unsplash)',
                            ])
                            ->native(false)
                            ->default(fn ($get) => $get('image_path') ? 'upload' : 'url')
                            ->live()
                            ->dehydrated(false)
                            ->columnSpanFull(),
                        \Filament\Forms\Components\FileUpload::make('image_path')
                            ->label('Service Image (Local)')
                            ->image()
                            ->imageEditor()
                            ->optimize('webp')
                            ->disk('public')
                            ->directory('services')
                            ->visible(fn ($get) => $get('image_source') === 'upload')
                            ->required(fn ($get) => $get('image_source') === 'upload')
                            ->columnSpanFull(),
                        \Filament\Forms\Components\TextInput::make('image_url')
                            ->label('Service Image (External URL)')
                            ->url()
                            ->visible(fn ($get) => $get('image_source') === 'url')
                            ->required(fn ($get) => $get('image_source') === 'url')
                            ->columnSpanFull(),
                        \Filament\Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        \Filament\Forms\Components\Toggle::make('is_active')
                            ->required()
                            ->default(true),
                        \Filament\Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->columnSpanFull(),
                        \Filament\Forms\Components\FileUpload::make('icon')
                            ->label('Ikon Layanan (PNG/JPG)')
                            ->helperText('Unggah ikon layanan dalam format gambar (PNG/JPG/WebP). Disarankan menggunakan latar belakang transparan.')
                            ->image()
                            ->disk('public')
                            ->directory('icons')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\ImageColumn::make('image_url')
                    ->label('Gambar')
                    ->square(),
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('category.name')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('base_price')
                    ->money('IDR')
                    ->sortable(),
                \Filament\Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('sort_order')
                    ->sortable(),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),
                \Filament\Tables\Filters\TernaryFilter::make('is_active'),
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
            'index' => ListServices::route('/'),
            'create' => CreateService::route('/create'),
            'edit' => EditService::route('/{record}/edit'),
        ];
    }
}
