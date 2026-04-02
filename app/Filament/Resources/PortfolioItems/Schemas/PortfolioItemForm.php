<?php

namespace App\Filament\Resources\PortfolioItems\Schemas;

use App\Models\Category;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PortfolioItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Karya')
                    ->description('Detail utama portfolio item')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->helperText('Nama atau judul karya foto, contoh: "Pernikahan Budi & Sari".')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                $set('slug', Str::slug($state));
                            }),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->helperText('URL unik untuk karya ini. Terisi otomatis dari judul, bisa diubah manual.')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Select::make('category_id')
                            ->native(false)
                            ->disablePlaceholderSelection()
                            ->label('Kategori')
                            ->helperText('Pilih jenis sesi foto, misal: Wedding, Prewedding, Maternity, dll.')
                            ->options(Category::query()->where('is_active', true)->pluck('name', 'id'))
                            ->searchable()
                            ->required(),

                        TextInput::make('client_name')
                            ->label('Nama Klien')
                            ->helperText('Nama klien yang difoto. Boleh dikosongkan jika tidak ingin ditampilkan.')
                            ->maxLength(255)
                            ->nullable(),

                        DatePicker::make('shoot_date')
                            ->label('Tanggal Pemotretan')
                            ->helperText('Tanggal sesi foto dilaksanakan.')
                            ->native(false)
                            ->required()
                            ->columnSpan(1),

                        TagsInput::make('tags')
                            ->label('Tags')
                            ->helperText('Kata kunci terkait karya ini, misal: outdoor, studio, sunset. Tekan Enter untuk menambah tag baru.')
                            ->placeholder('Tambah tag lalu tekan Enter...')
                            ->nullable()
                            ->columnSpan(1),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->helperText('Ceritakan singkat tentang sesi foto ini: suasana, konsep, atau momen spesialnya.')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                Section::make('Media')
                    ->description('Foto utama dan galeri karya')
                    ->columns(2)
                    ->schema([
                        FileUpload::make('image_url')
                            ->label('Foto Utama')
                            ->helperText('Foto terbaik yang mewakili karya ini. Akan ditampilkan sebagai thumbnail di halaman portfolio.')
                            ->image()
                            ->disk('public')
                            ->directory('images')
                            ->imageEditor()
                            ->required()
                            ->columnSpanFull(),

                        FileUpload::make('gallery_images')
                            ->label('Galeri Foto')
                            ->helperText('Upload beberapa foto tambahan untuk galeri karya ini. Bisa diurutkan ulang dengan drag & drop.')
                            ->image()
                            ->disk('public')
                            ->directory('images')
                            ->multiple()
                            ->reorderable()
                            ->nullable()
                            ->columnSpanFull(),
                    ]),

                Section::make('Status')
                    ->description('Atur visibilitas karya di halaman portfolio')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Tampilkan sebagai Featured')
                            ->helperText('Aktifkan agar karya ini tampil di bagian unggulan (featured) pada halaman beranda.')
                            ->default(false),

                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->helperText('Karya hanya akan tampil di halaman portfolio jika statusnya aktif.')
                            ->default(true),
                    ]),
            ]);
    }
}
