<?php

namespace App\Filament\Resources\BlogPost\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Str;

class BlogPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Main Content')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Artikel')
                            ->helperText('Masukkan judul artikel yang menarik dan relevan.')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($set, ?string $state) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->label('Slug / URL')
                            ->helperText('Terisi otomatis dari judul. Digunakan sebagai alamat URL unik.')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Textarea::make('excerpt')
                            ->label('Ringkasan (Excerpt)')
                            ->helperText('Ringkasan singkat yang akan tampil di halaman daftar blog.')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                        RichEditor::make('content')
                            ->label('Konten Lengkap')
                            ->helperText('Tulis isi artikel secara detail di sini.')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Media & Tags')
                    ->schema([
                        Select::make('image_source')
                            ->label('Sumber Gambar')
                            ->helperText('Pilih apakah Anda ingin mengunggah gambar baru atau menggunakan tautan eksternal.')
                            ->options([
                                'upload' => 'Upload Gambar (Produksi)',
                                'url' => 'URL Foto Eksternal (Seeded/Unsplash)',
                            ])
                            ->native(false)
                            ->formatStateUsing(fn ($record) => $record?->image_path ? 'upload' : 'url')
                            ->live()
                            ->dehydrated(false),
                        FileUpload::make('image_path')
                            ->label('Gambar Artikel (Local)')
                            ->helperText('Unggah gambar thumbnail artikel. Format yang disarankan: .jpg, .webp (Maks 2MB).')
                            ->image()
                            ->imageEditor()
                            ->optimize('webp')
                            ->disk('public')
                            ->directory('blog')
                            ->visible(fn ($get) => $get('image_source') === 'upload')
                            ->required(fn ($get) => $get('image_source') === 'upload'),
                        TextInput::make('image_url')
                            ->label('Gambar Artikel (External URL)')
                            ->helperText('Masukkan tautan langsung gambar (Contoh: https://images.unsplash.com/...)')
                            ->url()
                            ->visible(fn ($get) => $get('image_source') === 'url')
                            ->required(fn ($get) => $get('image_source') === 'url'),
                        TagsInput::make('tags')
                            ->label('Label / Tags')
                            ->helperText('Tekan ENTER untuk menambahkan tag baru.')
                            ->placeholder('Tambah tag baru')
                            ->separator(','),
                    ])->columns(2),

                Section::make('Publishing Status')
                    ->schema([
                        Toggle::make('is_published')
                            ->label('Publikasikan')
                            ->helperText('Aktifkan untuk menampilkan artikel ini di halaman blog depan.')
                            ->live(),
                        DateTimePicker::make('published_at')
                            ->label('Tanggal Publikasi')
                            ->helperText('Pilih waktu kapan artikel ini akan dirilis.')
                            ->native(false)
                            ->required(fn ($get) => $get('is_published'))
                            ->hidden(fn ($get) => !$get('is_published')),
                    ])->columns(2),
            ]);
    }
}
