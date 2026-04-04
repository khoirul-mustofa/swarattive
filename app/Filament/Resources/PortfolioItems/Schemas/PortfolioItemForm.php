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
use Filament\Forms\Set;
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
                            ->afterStateUpdated(fn ($set, ?string $state) => $set('slug', Str::slug($state))),

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
                        Select::make('image_source')
                            ->label('Sumber Foto Utama')
                            ->options([
                                'upload' => 'Upload Gambar (Produksi)',
                                'url' => 'URL Foto Eksternal (Seeded/Unsplash)',
                            ])
                            ->native(false)
                            ->default(fn ($get) => $get('image_path') ? 'upload' : 'url')
                            ->live()
                            ->dehydrated(false),
                            
                        FileUpload::make('image_path')
                            ->label('Foto Utama (Local)')
                            ->helperText('Foto terbaik yang mewakili karya ini.')
                            ->image()
                            ->imageEditor()
                            ->optimize('webp')
                            ->disk('public')
                            ->directory('portfolio')
                            ->visible(fn ($get) => $get('image_source') === 'upload')
                            ->required(fn ($get) => $get('image_source') === 'upload'),
                            
                        TextInput::make('image_url')
                            ->label('Foto Utama (External URL)')
                            ->url()
                            ->visible(fn ($get) => $get('image_source') === 'url')
                            ->required(fn ($get) => $get('image_source') === 'url'),

                        Select::make('gallery_source')
                            ->label('Sumber Galeri Foto')
                            ->options([
                                'upload' => 'Upload Galeri (Produksi)',
                                'url' => 'URL JSON Eksternal (Seeded)',
                            ])
                            ->native(false)
                            ->default(fn ($get) => $get('gallery_image_paths') ? 'upload' : 'url')
                            ->live()
                            ->dehydrated(false)
                            ->columnSpanFull(),

                        FileUpload::make('gallery_image_paths')
                            ->label('Galeri Foto (Local)')
                            ->helperText('Upload beberapa foto tambahan.')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->disk('public')
                            ->directory('portfolio/gallery')
                            ->visible(fn ($get) => $get('gallery_source') === 'upload')
                            ->nullable(),

                        TagsInput::make('gallery_images')
                            ->label('Galeri Foto (External URLs)')
                            ->helperText('Masukkan kumpulan URL gambar eksternal (Pisahkan dengan Enter).')
                            ->placeholder('https://example.com/photo1.jpg')
                            ->visible(fn ($get) => $get('gallery_source') === 'url')
                            ->nullable(),
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
