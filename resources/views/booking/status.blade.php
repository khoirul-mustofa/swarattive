@extends('layouts.app')

@section('title', 'Status Booking: ' . $booking->booking_code . ' - Swarattive Photography')

@section('content')
    <div class="bg-[#faf7f4] min-h-screen py-12 md:py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header Status --}}
            <div class="bg-white rounded-3xl shadow-sm border border-[#ede8e3] overflow-hidden mb-8">
                <div
                    class="bg-[#3d2b1f] px-6 py-10 md:px-10 text-center md:text-left flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <div class="flex flex-col md:flex-row items-center gap-3 mb-2">
                            <h1 class="text-white font-serif font-bold text-2xl md:text-3xl">Status Pesanan</h1>
                            <span class="px-4 py-1 rounded-full text-[10px] uppercase font-bold tracking-widest shadow-sm
                                @if($booking->status == 'pending') bg-amber-500 text-white
                                @elseif($booking->status == 'confirmed') bg-green-500 text-white
                                @elseif($booking->status == 'completed') bg-blue-500 text-white
                                @elseif($booking->status == 'cancelled') bg-red-500 text-white
                                @endif">
                                {{ $booking->status }}
                            </span>
                            <span class="px-4 py-1 rounded-full text-[10px] uppercase font-bold tracking-widest shadow-sm
                                @if(in_array($booking->payment_status, ['unpaid', 'pending'])) bg-gray-200 text-gray-700
                                @elseif(in_array($booking->payment_status, ['settlement', 'fully_paid'])) bg-green-100 text-green-700
                                @elseif(in_array($booking->payment_status, ['expire', 'failed', 'cancel', 'expired'])) bg-red-100 text-red-700
                                @else bg-blue-100 text-blue-700
                                @endif">
                                Pembayaran:
                                @if(in_array($booking->payment_status, ['unpaid', 'pending'])) Belum Dibayar
                                @elseif(in_array($booking->payment_status, ['settlement', 'fully_paid'])) Lunas
                                @elseif(in_array($booking->payment_status, ['expire', 'failed', 'cancel', 'expired'])) Gagal
                                @else {{ $booking->payment_status }}
                                @endif
                            </span>
                        </div>
                        <p class="text-white/60 font-mono text-sm tracking-widest uppercase">Kode Booking:
                            {{ $booking->booking_code }}</p>
                    </div>
                    <div class="flex justify-center md:justify-end gap-3">
                        @if(in_array($booking->payment_status, ['settlement', 'fully_paid']))
                            <a href="{{ route('booking.index') }}"
                                class="px-6 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-bold uppercase tracking-widest transition-all">Pesan
                                Lagi</a>
                            <a href="{{ route('booking.invoice.preview', $booking->booking_code) }}"
                                class="p-3 rounded-xl bg-white/10 hover:bg-white/20 text-white transition-all"
                                title="Preview Invoice">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Progress Stepper --}}
                <div class="p-8 md:p-10 border-b border-[#f0ece7]">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none"
                            aria-hidden="true">
                            <div class="w-full h-0.5 bg-gray-100"></div>
                        </div>
                        <div class="relative flex justify-between">
                            @php
                                $steps = [
                                    ['id' => 'menunggu_pembayaran', 'label' => 'Pembayaran', 'icon' => 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z'],
                                    ['id' => 'menunggu_jadwal', 'label' => 'Jadwal', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                                    ['id' => 'pelaksanaan', 'label' => 'Sesi Foto', 'icon' => 'M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z'],
                                    ['id' => 'editing', 'label' => 'Editing', 'icon' => 'M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z'],
                                    ['id' => 'siap_dikirim', 'label' => 'Hasil Siap', 'icon' => 'M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4'],
                                    ['id' => 'selesai', 'label' => 'Selesai', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z']
                                ];

                                // Map status to index for coloring
                                $statusMap = array_column($steps, 'id');
                                $currentStatus = $booking->production_progress;

                                // Automated check: if fully paid, at least we are in 'menunggu_jadwal' (index 1)
                                if (in_array($booking->payment_status, ['settlement', 'fully_paid']) && $currentStatus == 'menunggu_pembayaran') {
                                    $currentStatus = 'menunggu_jadwal';
                                }

                                $currentStatusIdx = array_search($currentStatus, $statusMap);
                            @endphp

                            @foreach($steps as $idx => $step)
                                <div class="flex flex-col items-center">
                                    <div
                                        class="w-10 h-10 rounded-full flex items-center justify-center z-10 shadow-sm transition-all duration-500
                                            @if($idx <= $currentStatusIdx) bg-[#3d2b1f] text-[#f0c27f] @else bg-white text-gray-300 border @endif">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="{{ $step['icon'] }}" />
                                        </svg>
                                    </div>
                                    <span
                                        class="mt-2 text-[8px] md:text-[10px] font-bold uppercase tracking-wider @if($idx <= $currentStatusIdx) text-[#3d2b1f] @else text-gray-400 @endif text-center">{{ $step['label'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="p-8 md:p-10 grid grid-cols-1 md:grid-cols-2 gap-10">
                    {{-- Info Booking --}}
                    <div class="space-y-6">
                        <h3 class="text-lg font-serif font-bold text-[#3d2b1f] border-b border-[#f0ece7] pb-3">Detail
                            Pesanan</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-start">
                                <span class="text-xs text-[#7a6b5d] uppercase tracking-widest font-medium">Layanan &
                                    Paket</span>
                                <div class="text-right">
                                    <p class="text-sm font-bold text-[#3d2b1f]">{{ $booking->service->name }}</p>
                                    @if($booking->package)
                                        <p class="text-xs text-[#3d2b1f] italic">{{ $booking->package->name }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-[#7a6b5d] uppercase tracking-widest font-medium">Jadwal
                                    Sesi</span>
                                <span
                                    class="text-sm font-semibold text-[#3d2b1f]">{{ $booking->booking_date->translatedFormat('d F Y') }}
                                    | {{ $booking->booking_time->format('H:i') }} WIB</span>
                            </div>
                            <div class="flex justify-between items-start">
                                <span class="text-xs text-[#7a6b5d] uppercase tracking-widest font-medium">Lokasi</span>
                                <div class="text-right">
                                    <p class="text-sm font-semibold text-[#3d2b1f] capitalize">{{ $booking->location_type }}
                                    </p>
                                    @if($booking->location_address)
                                        <p class="text-xs text-[#7a6b5d] max-w-[200px] leading-tight mt-1">
                                            {{ $booking->location_address }}</p>
                                    @endif
                                </div>
                            </div>
                            @if($booking->teamMember)
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-[#7a6b5d] uppercase tracking-widest font-medium">Fotografer</span>
                                    <span class="text-sm font-semibold text-[#3d2b1f]">{{ $booking->teamMember->name }}</span>
                                </div>
                            @endif
                            <div class="pt-4 border-t border-dashed border-gray-200 space-y-2">
                                <div class="flex justify-between items-center text-xs text-[#7a6b5d]">
                                    <span>Subtotal Pesanan</span>
                                    <span>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center text-xs text-amber-600">
                                    <span>Biaya Layanan/Admin</span>
                                    <span>+ Rp {{ number_format($booking->admin_fee, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                                    <span class="text-sm text-[#3d2b1f] font-bold">Total Pembayaran</span>
                                    <span class="text-2xl font-serif font-bold text-[#3d2b1f]">Rp
                                        {{ number_format($booking->total_price + $booking->admin_fee, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Info Klien & Pembayaran --}}
                    <div class="space-y-6">
                        <h3 class="text-lg font-serif font-bold text-[#3d2b1f] border-b border-[#f0ece7] pb-3">Informasi
                            Pelanggan</h3>
                        <div class="bg-[#fdfaf8] rounded-2xl p-6 border border-[#f0ece7] space-y-3">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-lg bg-[#3d2b1f] flex items-center justify-center text-[#f0c27f]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-semibold text-[#3d2b1f]">{{ $booking->client->name }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-lg bg-white border border-gray-100 flex items-center justify-center text-[#9a8b7d]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="text-sm text-[#7a6b5d]">{{ $booking->client->email }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-lg bg-white border border-gray-100 flex items-center justify-center text-[#9a8b7d]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <span class="text-sm text-[#7a6b5d]">{{ $booking->client->phone }}</span>
                            </div>
                        </div>

                        @if(in_array($booking->payment_status, ['unpaid', 'pending']))
                            <div class="bg-amber-50 rounded-2xl p-6 border border-amber-100 space-y-4">
                                <h4 class="text-sm font-bold text-amber-800 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Selesaikan Pembayaran
                                </h4>
                                @php
                                    $pendingPayment = $booking->payments()->where('status', 'pending')->first();
                                @endphp

                                @if($pendingPayment)
                                    <p class="text-xs text-amber-700 leading-relaxed">
                                        Harap selesaikan pembayaran sebesar **Rp
                                        {{ number_format($pendingPayment->amount + $pendingPayment->admin_fee, 0, ',', '.') }}**
                                        untuk mengunci jadwal pemotretan Anda.
                                    </p>
                                    <div class="pt-2">
                                        <button id="pay-button" data-snap="{{ $pendingPayment->snap_token }}"
                                            class="w-full bg-[#3d2b1f] text-white py-3 rounded-xl text-xs font-bold uppercase tracking-widest hover:scale-105 transition-transform duration-300 shadow-md flex items-center justify-center gap-2 group">
                                            <svg class="w-4 h-4 group-hover:rotate-12 transition-transform duration-300" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                            </svg>
                                            Bayar Sekarang
                                        </button>
                                    </div>
                                @else
                                    <p class="text-xs text-red-700 italic">Terjadi kesalahan pada data pembayaran. Silakan hubungi
                                        admin.</p>
                                @endif
                            </div>
                        @elseif(in_array($booking->payment_status, ['settlement', 'fully_paid']))
                            <div class="bg-green-50 rounded-2xl p-6 border border-green-100 text-center">
                                <p class="text-xs text-green-700 font-bold mb-1 italic">Pembayaran Lunas!</p>
                                <p class="text-[10px] text-green-600">Terima kasih. Sampai jumpa di hari sesi pemotretan.</p>
                            </div>
                        @elseif(in_array($booking->payment_status, ['expire', 'failed', 'cancel', 'expired']))
                            <div class="bg-red-50 rounded-2xl p-6 border border-red-100 text-center">
                                <p class="text-xs text-red-700 font-bold mb-1 italic">Booking Kedaluwarsa</p>
                                <p class="text-[10px] text-red-600">Waktu pembayaran telah habis atau transaksi gagal. Silakan
                                    buat pesanan baru.</p>
                                <a href="{{ route('booking.index') }}"
                                    class="mt-3 inline-block text-xs font-bold text-[#3d2b1f] border-b border-[#3d2b1f]">Pesan
                                    Ulang</a>
                            </div>
                        @endif
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 italic text-center">
                            <p class="text-xs text-[#9a8b7d]">Terima kasih telah mempercayakan momen Anda kepada Swarattive!
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-center text-[#9a8b7d] text-xs mt-6">Punya pertanyaan? Hubungi kami di hello@swarattive.com</p>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const payButton = document.getElementById('pay-button');
        if (payButton) {
            payButton.onclick = function () {
                snap.pay(payButton.dataset.snap, {
                    onSuccess: function (result) {
                        Swal.fire({
                            title: 'Pembayaran Berhasil!',
                            text: 'Terima kasih, pembayaran Anda telah kami terima.',
                            icon: 'success',
                            confirmButtonText: 'Lihat Invoice',
                            confirmButtonColor: '#3d2b1f',
                        }).then((result) => {
                            window.location.href = "{{ route('booking.invoice.preview', $booking->booking_code) }}";
                        });
                    },
                    onPending: function (result) {
                        Swal.fire({
                            title: 'Pembayaran Pending',
                            text: 'Harap selesaikan pembayaran sesuai instruksi di Midtrans.',
                            icon: 'info',
                            confirmButtonText: 'Oke',
                            confirmButtonColor: '#3d2b1f',
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    onError: function (result) {
                        Swal.fire({
                            title: 'Pembayaran Gagal',
                            text: 'Terjadi kesalahan saat memproses pembayaran Anda. Silakan coba lagi.',
                            icon: 'error',
                            confirmButtonText: 'Tutup',
                            confirmButtonColor: '#3d2b1f',
                        });
                    },
                    onClose: function () {
                        Swal.fire({
                            title: 'Pembayaran Dibatalkan',
                            text: 'Anda menutup jendela pembayaran sebelum selesai.',
                            icon: 'warning',
                            confirmButtonText: 'Oke',
                            confirmButtonColor: '#3d2b1f',
                        });
                    }
                });
            };
        }
    </script>
@endpush