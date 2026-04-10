<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $settings = \App\Models\ContactSetting::first();
        return view('contact.index', compact('settings'));
    }

    public function store(StoreContactMessageRequest $request)
    {
        ContactMessage::create([
            ...$request->validated(),
            'ip_address' => $request->ip(),
        ]);

        $settings = \App\Models\ContactSetting::first();
        $phone = $settings->phone ?? '6281234567890';
        
        // Membersihkan nomor ke format yang dibaca WA
        $whatsappNumber = preg_replace('/[^0-9]/', '', $phone);
        if (strpos($whatsappNumber, '0') === 0) {
            $whatsappNumber = '62' . substr($whatsappNumber, 1);
        }

        $message = "Halo Swarattive, saya ingin konsultasi layanan dari website:\n\n";
        $message .= "Nama: " . $request->name . "\n";
        $message .= "Email: " . $request->email . "\n";
        $message .= "Tertarik Pada: " . $request->interest . "\n";
        $message .= "Pesan: " . $request->message;

        $waLink = "https://wa.me/{$whatsappNumber}?text=" . urlencode($message);

        return redirect()->away($waLink);
    }
}
