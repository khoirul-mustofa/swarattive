<?php

namespace App\Filament\Resources\ServicePackage;

use App\Filament\Resources\ServicePackage\Pages\CreateServicePackage;
use App\Filament\Resources\ServicePackage\Pages\EditServicePackage;
use App\Filament\Resources\ServicePackage\Pages\ListServicePackages;
use App\Models\ServicePackage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ServicePackageResource extends Resource
{
    protected static ?string $model = ServicePackage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedGift;

    protected static ?string $navigationLabel = 'Service Packages';

    protected static ?string $modelLabel = 'Service Package';

    protected static ?string $pluralModelLabel = 'Service Packages';

    protected static ?int $navigationSort = 8;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Package Detail')
                    ->columns(2)
                    ->schema([
                        \Filament\Forms\Components\Select::make('service_id')
                            ->relationship('service', 'name')
                            ->native(false)
                            ->disablePlaceholderSelection()
                            ->required(),
                        \Filament\Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        \Filament\Forms\Components\TextInput::make('price')
                            ->numeric()
                            ->required()
                            ->prefix('Rp'),
                        \Filament\Forms\Components\Toggle::make('is_featured')
                            ->default(false),
                        \Filament\Forms\Components\TagsInput::make('features')
                            ->columnSpanFull(),
                        \Filament\Forms\Components\Textarea::make('description')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('service.name')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('price')
                    ->money('IDR')
                    ->sortable(),
                \Filament\Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('service')
                    ->relationship('service', 'name'),
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
            'index' => ListServicePackages::route('/'),
            'create' => CreateServicePackage::route('/create'),
            'edit' => EditServicePackage::route('/{record}/edit'),
        ];
    }
}
