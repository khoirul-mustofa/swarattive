<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    protected $token;
    protected $baseUrl = 'https://api.fonnte.com';

    public function __construct()
    {
        $this->token = env('FONNTE_TOKEN');
    }

    public function sendMessage($target, $message)
    {
        if (empty($this->token)) {
            Log::warning('Fonnte token is not set. WhatsApp message not sent.');
            return false;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->post("{$this->baseUrl}/send", [
                'target' => $target,
                'message' => $message,
                'countryCode' => '62', // Default to Indonesia
            ]);

            if ($response->successful() && $response->json('status')) {
                return true;
            }

            Log::error('Fonnte API Error', ['response' => $response->json()]);
            return false;
        } catch (\Exception $e) {
            Log::error('Fonnte Exception', ['error' => $e->getMessage()]);
            return false;
        }
    }
}
