<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use App\Models\ServicePackage;
use App\Models\TeamMember;
use App\Models\Client;
use App\Models\Booking;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\SiteSetting;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingController extends Controller
{
    public function index()
    {
        return view('booking.index');
    }

    public function check()
    {
        return view('booking.check');
    }

    public function show($booking_code)
    {
        $booking = Booking::with([
            'client',
            'service.category',
            'package',
            'teamMember',
            'payments.paymentMethod'
        ])
        ->where('booking_code', $booking_code)
        ->firstOrFail();

        return view('booking.status', compact('booking'));
    }

    public function checkStatus(Request $request)
    {
        return $this->show($request->booking_code);
    }

    public function previewInvoice($booking_code)
    {
        $data = $this->getInvoiceData($booking_code);
        return view('booking.invoice-preview', $data);
    }

    public function downloadInvoice($booking_code)
    {
        $data = $this->getInvoiceData($booking_code);

        $pdf = Pdf::loadView('pdf.booking-invoice', $data);

        return $pdf->download("invoice-{$data['booking']->booking_code}.pdf");
    }

    private function getInvoiceData($booking_code)
    {
        $booking = Booking::with(['client', 'service', 'package', 'payments'])
            ->where('booking_code', $booking_code)
            ->firstOrFail();

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

        return [
            'booking' => $booking,
            'logo' => $logoBase64,
            'siteName' => $siteName,
            'contactAddress' => $contactAddress,
            'contactPhone' => $contactPhone,
            'contactEmail' => $contactEmail,
        ];
    }
}
