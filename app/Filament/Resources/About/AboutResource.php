<?php

namespace App\Filament\Resources\About;

use App\Filament\Resources\About\Pages\EditAbout;
use App\Filament\Resources\About\Pages\ListAbout;
use App\Filament\Resources\About\Schemas\AboutForm;
use App\Models\About;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInformationCircle;

    protected static ?string $navigationLabel = 'About Us';

    protected static ?string $modelLabel = 'About Information';

    protected static ?string $navigationGroup = 'Profil Perusahaan';
    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'story_title';

    public static function getNavigationUrl(): string
    {
        return static::getUrl('edit', ['record' => 1]);
    }

    public static function form(Schema $schema): Schema
    {
        return AboutForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAbout::route('/'),
            'edit' => EditAbout::route('/{record}/edit'),
        ];
    }
}
