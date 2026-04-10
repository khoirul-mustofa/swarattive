<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Booking;
use App\Models\Service;
use App\Models\ContactMessage;
use App\Models\Payment;

class SystemStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalRevenue = Payment::where('status', 'paid')->sum('amount');
        $pendingBookings = Booking::where('status', 'pending')->count();
        $unreadMessages = ContactMessage::whereNull('read_at')->count();

        return [
            Stat::make('Total Pendapatan', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Total uang masuk dari pembayaran sukses')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Pesanan Menunggu', $pendingBookings)
                ->description('Perlu konfirmasi admin')
                ->descriptionIcon('heroicon-m-clock')
                ->color($pendingBookings > 0 ? 'danger' : 'gray'),

            Stat::make('Pesan Baru', $unreadMessages)
                ->description('Pesan belum dibaca')
                ->descriptionIcon('heroicon-m-envelope')
                ->color($unreadMessages > 0 ? 'warning' : 'gray'),

            Stat::make('Total Layanan', Service::count())
                ->description('Paket layanan aktif saat ini')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('info'),
        ];
    }
}
