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

class PortfolioSettings extends Page implements HasSchemas
{
    use InteractsWithSchemas;

    public function getView(): string
    {
        return 'filament.pages.portfolio-settings';
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $navigationLabel = 'Pengaturan Portfolio';

    protected static ?string $title = 'Pengaturan Halaman Portfolio';

    protected static ?int $navigationSort = 10;

    public static function getNavigationGroup(): ?string
    {
        return 'Pengaturan';
    }

    // Form fields state
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'hero_image' => SiteSetting::getValue('portfolio_hero_image'),
            'hero_eyebrow' => SiteSetting::getValue('portfolio_hero_eyebrow', 'Our Work'),
            'hero_title' => SiteSetting::getValue('portfolio_hero_title', 'Portfolio'),
            'hero_subtitle' => SiteSetting::getValue('portfolio_hero_subtitle', 'Setiap karya adalah cerita — disimpan dalam satu bingkai.'),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Hero Banner')
                    ->description('Pengaturan tampilan banner utama di halaman portfolio publik')
                    ->columns(2)
                    ->schema([
                        FileUpload::make('hero_image')
                            ->label('Gambar Banner')
                            ->helperText('Foto latar belakang hero banner. Disarankan resolusi minimal 1920×1080px.')
                            ->image()
                            ->disk('public')
                            ->directory('images')
                            ->imageEditor()
                            ->nullable()
                            ->columnSpanFull(),

                        TextInput::make('hero_eyebrow')
                            ->label('Teks Kecil (eyebrow)')
                            ->helperText('Teks kecil di atas judul, misal: "Our Work".')
                            ->maxLength(60),

                        TextInput::make('hero_title')
                            ->label('Judul Banner')
                            ->helperText('Judul besar di tengah banner.')
                            ->required()
                            ->maxLength(100),

                        Textarea::make('hero_subtitle')
                            ->label('Subjudul')
                            ->helperText('Deskripsi singkat di bawah judul.')
                            ->rows(2)
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
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

        SiteSetting::setValue('portfolio_hero_image', $data['hero_image'], 'image', 'portfolio');
        SiteSetting::setValue('portfolio_hero_title', $data['hero_title'], 'text', 'portfolio');
        SiteSetting::setValue('portfolio_hero_subtitle', $data['hero_subtitle'], 'text', 'portfolio');
        SiteSetting::setValue('portfolio_hero_eyebrow', $data['hero_eyebrow'], 'text', 'portfolio');

        Notification::make()
            ->success()
            ->title('Tersimpan!')
            ->body('Pengaturan hero banner portfolio berhasil disimpan.')
            ->send();
    }
}
