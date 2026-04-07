<?php

namespace App\Filament\Resources\Booking\Pages;

use App\Filament\Resources\Booking\BookingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;
use App\Models\SiteSetting;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Booking;

class EditBooking extends EditRecord
{
    protected static string $resource = BookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('downloadInvoice')
                ->label('Download Invoice')
                ->icon('heroicon-o-document-arrow-down')
                ->color('warning')
                ->action(function (Booking $record) {
                    $siteName = SiteSetting::getValue('site_name', 'Swarattive');
                    $contactAddress = SiteSetting::getValue('contact_address', 'Jakarta, Indonesia');
                    $contactPhone = SiteSetting::getValue('contact_phone', '+62 812 3456 7890');
                    $contactEmail = SiteSetting::getValue('contact_email', 'hello@swarattive.com');
                    
                    $logoPath = public_path('images/logo-primary.png');
                    $logoBase64 = null;
                    if (file_exists($logoPath)) {
                        $type = pathinfo($logoPath, PATHINFO_EXTENSION);
                        $data = file_get_contents($logoPath);
                        $logoBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    }

                    $pdf = Pdf::loadView('pdf.booking-invoice', [
                        'booking' => $record,
                        'logo' => $logoBase64,
                        'siteName' => $siteName,
                        'contactAddress' => $contactAddress,
                        'contactPhone' => $contactPhone,
                        'contactEmail' => $contactEmail,
                    ]);

                    return response()->streamDownload(function () use ($pdf) {
                        echo $pdf->stream();
                    }, "invoice-{$record->booking_code}.pdf");
                }),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
