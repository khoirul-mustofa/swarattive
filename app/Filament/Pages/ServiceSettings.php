<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ServiceSettings extends Page implements HasSchemas
{
    use InteractsWithSchemas;

    public function getView(): string
    {
        return 'filament.pages.service-settings';
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    protected static ?string $navigationLabel = 'Pengaturan Layanan';

    protected static ?string $title = 'Pengaturan Halaman Layanan';

    protected static ?int $navigationSort = 11;

    public static function getNavigationGroup(): ?string
    {
        return 'Pengaturan';
    }

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'hero_image' => SiteSetting::getValue('service_hero_image'),
            'hero_title' => SiteSetting::getValue('service_hero_title', 'Layanan Kami'),
            'hero_subtitle' => SiteSetting::getValue('service_hero_subtitle', 'Pilih paket dan layanan terbaik yang kami miliki untuk menyempurnakan hari istimewa Anda.'),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Hero Banner Halaman Layanan')
                    ->description('Sesuaikan tampilan banner utama pada katalog layanan pengunjung.')
                    ->columns(2)
                    ->schema([
                        FileUpload::make('hero_image')
                            ->label('Gambar Banner Hero')
                            ->image()
                            ->disk('public')
                            ->directory('images')
                            ->imageEditor()
                            ->columnSpanFull(),

                        TextInput::make('hero_title')
                            ->label('Judul Hero')
                            ->required()
                            ->maxLength(100),

                        Textarea::make('hero_subtitle')
                            ->label('Subjudul Hero')
                            ->rows(3)
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Pengaturan')
                ->icon(Heroicon::OutlinedCheckCircle)
                ->action('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        SiteSetting::setValue('service_hero_image', $data['hero_image'], 'image', 'service');
        SiteSetting::setValue('service_hero_title', $data['hero_title'], 'text', 'service');
        SiteSetting::setValue('service_hero_subtitle', $data['hero_subtitle'], 'text', 'service');

        Notification::make()
            ->success()
            ->title('Berhasil Disimpan')
            ->body('Hero banner halaman layanan telah diperbarui.')
            ->send();
    }
}
