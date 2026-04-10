@extends('layouts.app')

@section('title', 'Preview Invoice: ' . $booking->booking_code . ' - Swarattive Photography')

@section('content')
<div class="bg-[#faf7f4] min-h-screen">
    {{-- Sticky Header for Actions --}}
    <div class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-[#ede8e3] py-4 shadow-sm">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('booking.status', $booking->booking_code) }}" class="flex items-center gap-2 text-[#7a6b5d] hover:text-[#3d2b1f] transition-colors text-sm font-bold uppercase tracking-widest">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>Kembali</span>
                </a>
                <div class="hidden sm:block h-6 w-px bg-[#ede8e3]"></div>
                <div class="hidden sm:block">
                    <p class="text-xs text-[#7a6b5d] font-mono tracking-wider uppercase">Invoice Preview #{{ $booking->booking_code }}</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3">
                <a href="{{ route('booking.invoice.download', $booking->booking_code) }}" class="flex items-center gap-2 px-6 py-2.5 bg-[#3d2b1f] text-white rounded-xl text-xs font-bold uppercase tracking-widest hover:scale-105 transition-all shadow-md group">
                    <svg class="w-4 h-4 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    <span>Download PDF</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Invoice Preview Area --}}
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white shadow-2xl rounded-sm overflow-hidden mx-auto" style="width: 210mm; min-height: 297mm; transform-origin: top center;">
            {{-- We render the same view used for PDF --}}
            {{-- Note: we pass the same data. The view includes <html> and <body> tags which is not ideal but browser will handle it. --}}
            {{-- Alternatively, we can use an iframe for 100% accuracy. --}}
            <iframe srcdoc="{{ view('pdf.booking-invoice', [
                'booking' => $booking,
                'logo' => $logo,
                'siteName' => $siteName,
                'contactAddress' => $contactAddress,
                'contactPhone' => $contactPhone,
                'contactEmail' => $contactEmail,
            ])->render() }}" class="w-full" style="height: 297mm; border: none;"></iframe>
        </div>
        
        <div class="mt-8 text-center text-[#9a8b7d] text-xs">
            <p>Tampilan di atas adalah pratinjau invoice Anda. Klik tombol "Download PDF" untuk menyimpan salinan resmi.</p>
        </div>
    </div>
</div>

<style>
    @media (max-width: 210mm) {
        .bg-white[style*="width: 210mm"] {
            width: 100% !important;
            transform: scale(calc(100vw / 210mm * 0.9));
            transform-origin: top center;
        }
    }
</style>
@endsection
