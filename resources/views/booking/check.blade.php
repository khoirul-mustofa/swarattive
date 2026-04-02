@extends('layouts.app')

@section('title', 'Cek Status Booking - Swarattive Photography')
@section('description', 'Cari dan periksa status pesanan foto Anda menggunakan kode booking.')

@section('content')
<div class="bg-[#faf7f4] min-h-[70vh] flex items-center justify-center py-12">
    <div class="max-w-md w-full px-4 sm:px-6">
        <div class="bg-white rounded-3xl shadow-xl border border-[#ede8e3] overflow-hidden">
            {{-- Header --}}
            <div class="bg-[#3d2b1f] px-8 py-10 text-center">
                <div class="bg-[#f0c27f] w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 rotate-3 shadow-lg">
                    <svg class="w-8 h-8 text-[#3d2b1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <h1 class="text-2xl font-serif font-bold text-white mb-2">Lacak Pesanan</h1>
                <p class="text-white/60 text-sm">Masukkan kode booking Anda di bawah ini</p>
            </div>

            {{-- Form --}}
            <div class="p-8">
                @if(session('success'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded shadow-sm">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('booking.check.status') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="booking_code" class="block text-xs font-bold text-[#3d2b1f] uppercase tracking-widest mb-2">Nomor Kode Booking</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-[#9a8b7d]">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            </span>
                            <input type="text" id="booking_code" name="booking_code" placeholder="SWR-YYYYMMDD-00X" 
                                class="block w-full pl-10 pr-4 py-4 border-gray-200 rounded-xl focus:ring-[#3d2b1f] focus:border-[#3d2b1f] text-sm uppercase font-mono tracking-wider"
                                required>
                        </div>
                        @error('booking_code')
                            <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" 
                        class="w-full bg-[#3d2b1f] text-white py-4 rounded-xl font-bold uppercase tracking-widest hover:bg-black transition-all shadow-md flex items-center justify-center gap-2 group">
                        Cek Status Sekarang
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t border-gray-100">
                    <p class="text-xs text-[#9a8b7d] text-center mb-3">Lupa kode booking Anda? Silakan hubungi kami:</p>
                    <div class="flex justify-center gap-4">
                        <a href="https://wa.me/6281234567890" target="_blank" class="text-[#3d2b1f] hover:text-[#f0c27f] transition-colors flex items-center gap-1.5 text-xs font-bold uppercase tracking-tighter">
                            <span class="w-2 h-2 rounded-full bg-green-500"></span> WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
