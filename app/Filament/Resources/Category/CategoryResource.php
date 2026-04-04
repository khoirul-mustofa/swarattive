<?php

namespace App\Filament\Resources\Category;

use App\Filament\Resources\Category\Pages\CreateCategory;
use App\Filament\Resources\Category\Pages\EditCategory;
use App\Filament\Resources\Category\Pages\ListCategories;
use App\Models\Category;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static ?string $navigationLabel = 'Categories';

    protected static ?string $modelLabel = 'Category';

    protected static ?string $pluralModelLabel = 'Categories';

    protected static ?int $navigationSort = 6;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Category Detail')
                    ->columns(2)
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('name')
                            ->label('Nama Kategori')
                            ->helperText('Contoh: Wedding, Portrait, Commercial, dll.')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($set, $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        \Filament\Forms\Components\TextInput::make('slug')
                            ->label('Slug / URL')
                            ->helperText('Akan terisi otomatis dari nama kategori.')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        \Filament\Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                        \Filament\Forms\Components\Select::make('image_source')
                            ->label('Sumber Gambar')
                            ->helperText('Pilih asal gambar untuk kategori ini.')
                            ->options([
                                'upload' => 'Upload Gambar (Produksi)',
                                'url' => 'URL Foto Eksternal (Seeded/Unsplash)',
                            ])
                            ->native(false)
                            ->default(fn ($get) => $get('image_path') ? 'upload' : 'url')
                            ->live()
                            ->dehydrated(false),
                        \Filament\Forms\Components\FileUpload::make('image_path')
                            ->label('Foto Kategori (Local)')
                            ->image()
                            ->imageEditor()
                            ->optimize('webp')
                            ->disk('public')
                            ->directory('categories')
                            ->visible(fn ($get) => $get('image_source') === 'upload')
                            ->required(fn ($get) => $get('image_source') === 'upload'),
                        \Filament\Forms\Components\TextInput::make('image_url')
                            ->label('Foto Kategori (External URL)')
                            ->url()
                            ->visible(fn ($get) => $get('image_source') === 'url')
                            ->required(fn ($get) => $get('image_source') === 'url'),
                        \Filament\Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->helperText('Penjelasan singkat mengenai kategori ini.')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\ImageColumn::make('image_url')
                    ->label('Foto Kategori'),
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('slug')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('services_count')
                    ->counts('services')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('sort_order')
                    ->sortable(),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->filters([
                //
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
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
}
