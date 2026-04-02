@extends('layouts.app')

@section('title', 'Status Booking: ' . $booking->booking_code . ' - Swarattive Photography')

@section('content')
<div class="bg-[#faf7f4] min-h-screen py-12 md:py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header Status --}}
        <div class="bg-white rounded-3xl shadow-sm border border-[#ede8e3] overflow-hidden mb-8">
            <div class="bg-[#3d2b1f] px-6 py-10 md:px-10 text-center md:text-left flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <div class="flex flex-col md:flex-row items-center gap-3 mb-2">
                        <h1 class="text-white font-serif font-bold text-2xl md:text-3xl">Status Pesanan</h1>
                        <span class="px-4 py-1 rounded-full text-[10px] uppercase font-bold tracking-widest shadow-sm
                            @if($booking->status == 'pending') bg-amber-500 text-white
                            @elseif($booking->status == 'confirmed') bg-blue-500 text-white
                            @elseif($booking->status == 'completed') bg-green-500 text-white
                            @elseif($booking->status == 'cancelled') bg-red-500 text-white
                            @endif">
                            {{ $booking->status }}
                        </span>
                    </div>
                    <p class="text-white/60 font-mono text-sm tracking-widest uppercase">Kode Booking: {{ $booking->booking_code }}</p>
                </div>
                <div class="flex justify-center md:justify-end gap-3">
                    <a href="{{ route('booking.index') }}" class="px-6 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-bold uppercase tracking-widest transition-all">Pesan Lagi</a>
                    <button onclick="window.print()" class="p-3 rounded-xl bg-white/10 hover:bg-white/20 text-white transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 00-2 2h2m2 4h10a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 00-2 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    </button>
                </div>
            </div>

            {{-- Progress Stepper --}}
            <div class="p-8 md:p-10 border-b border-[#f0ece7]">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none" aria-hidden="true">
                        <div class="w-full h-0.5 bg-gray-100"></div>
                    </div>
                    <div class="relative flex justify-between">
                        @php
                            $steps = [
                                ['id' => 'pending', 'label' => 'Pesanan Dibuat', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                                ['id' => 'confirmed', 'label' => 'Dikonfirmasi', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                ['id' => 'completed', 'label' => 'Sesi Selesai', 'icon' => 'M5 13l4 4L19 7']
                            ];
                            $currentStatusIdx = ['pending' => 0, 'confirmed' => 1, 'completed' => 2][$booking->status] ?? -1;
                        @endphp

                        @foreach($steps as $idx => $step)
                            <div class="flex flex-col items-center">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center z-10 shadow-sm transition-all duration-500
                                    @if($idx <= $currentStatusIdx) bg-[#3d2b1f] text-[#f0c27f] @else bg-white text-gray-300 border @endif">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}"/></svg>
                                </div>
                                <span class="mt-2 text-[10px] font-bold uppercase tracking-wider @if($idx <= $currentStatusIdx) text-[#3d2b1f] @else text-gray-400 @endif">{{ $step['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="p-8 md:p-10 grid grid-cols-1 md:grid-cols-2 gap-10">
                {{-- Info Booking --}}
                <div class="space-y-6">
                    <h3 class="text-lg font-serif font-bold text-[#3d2b1f] border-b border-[#f0ece7] pb-3">Detail Pesanan</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-start">
                            <span class="text-xs text-[#7a6b5d] uppercase tracking-widest font-medium">Layanan & Paket</span>
                            <div class="text-right">
                                <p class="text-sm font-bold text-[#3d2b1f]">{{ $booking->service->name }}</p>
                                @if($booking->package)
                                    <p class="text-xs text-[#3d2b1f] italic">{{ $booking->package->name }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-[#7a6b5d] uppercase tracking-widest font-medium">Jadwal Sesi</span>
                            <span class="text-sm font-semibold text-[#3d2b1f]">{{ $booking->booking_date->translatedFormat('d F Y') }} | {{ $booking->booking_time->format('H:i') }} WIB</span>
                        </div>
                        <div class="flex justify-between items-start">
                            <span class="text-xs text-[#7a6b5d] uppercase tracking-widest font-medium">Lokasi</span>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-[#3d2b1f] capitalize">{{ $booking->location_type }}</p>
                                @if($booking->location_address)
                                    <p class="text-xs text-[#7a6b5d] max-w-[200px] leading-tight mt-1">{{ $booking->location_address }}</p>
                                @endif
                            </div>
                        </div>
                        @if($booking->teamMember)
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-[#7a6b5d] uppercase tracking-widest font-medium">Fotografer</span>
                            <span class="text-sm font-semibold text-[#3d2b1f]">{{ $booking->teamMember->name }}</span>
                        </div>
                        @endif
                        <div class="pt-4 border-t border-dashed border-gray-200">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-[#3d2b1f] font-bold">Total Biaya</span>
                                <span class="text-2xl font-serif font-bold text-[#3d2b1f]">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Info Klien & Pembayaran --}}
                <div class="space-y-6">
                    <h3 class="text-lg font-serif font-bold text-[#3d2b1f] border-b border-[#f0ece7] pb-3">Informasi Pelanggan</h3>
                    <div class="bg-[#fdfaf8] rounded-2xl p-6 border border-[#f0ece7] space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-[#3d2b1f] flex items-center justify-center text-[#f0c27f]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <span class="text-sm font-semibold text-[#3d2b1f]">{{ $booking->client->name }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-white border border-gray-100 flex items-center justify-center text-[#9a8b7d]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <span class="text-sm text-[#7a6b5d]">{{ $booking->client->email }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-white border border-gray-100 flex items-center justify-center text-[#9a8b7d]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <span class="text-sm text-[#7a6b5d]">{{ $booking->client->phone }}</span>
                        </div>
                    </div>

                    @if($booking->status == 'pending')
                    <div class="bg-amber-50 rounded-2xl p-6 border border-amber-100 space-y-4">
                        <h4 class="text-sm font-bold text-amber-800 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Selesaikan Pembayaran
                        </h4>
                        <p class="text-xs text-amber-700 leading-relaxed">Harap selesaikan pembayaran DP sebesar **Rp {{ number_format($booking->total_price * 0.3, 0, ',', '.') }}** (30% dari total biaya) untuk mengunci jadwal pemotretan Anda.</p>
                        <div class="pt-2">
                            <button onclick="window.open('https://wa.me/6281234567890?text=Halo%20Swarattive,%20saya%20ingin%20konfirmasi%20pembayaran%20untuk%20booking%20{{ $booking->booking_code }}', '_blank')" 
                                class="w-full bg-[#3d2b1f] text-white py-3 rounded-xl text-xs font-bold uppercase tracking-widest hover:shadow-lg transition-all flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                Konfirmasi Pembayaran
                            </button>
                        </div>
                    </div>
                    @else
                    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 italic text-center">
                        <p class="text-xs text-[#9a8b7d]">Terima kasih telah mempercayakan momen Anda kepada Swarattive!</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        <p class="text-center text-[#9a8b7d] text-xs mt-6">Punya pertanyaan? Hubungi kami di hello@swarattive.com</p>
    </div>
</div>
@endsection
