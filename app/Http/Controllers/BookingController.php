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
}
