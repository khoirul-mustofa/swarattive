<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Booking;
use App\Models\Service;
use App\Models\ContactMessage;

class SystemStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pesanan (Booking)', Booking::count())
                ->description('Jumlah seluruh pesanan yang masuk')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary'),
            Stat::make('Total Layanan', Service::count())
                ->description('Jumlah paket layanan yang tersedia')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('warning'),
            Stat::make('Pesan Kotak Masuk', ContactMessage::count())
                ->description('Pesan dari formulir kontak')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('success'),
        ];
    }
}
