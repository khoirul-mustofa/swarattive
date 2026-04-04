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

        return back()->with('success', true);
    }
}
