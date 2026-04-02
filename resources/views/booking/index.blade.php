@extends('layouts.app')

@section('title', 'Sesi Booking - Swarattive Photography')
@section('description', 'Pesan sesi foto Anda hari ini. Pilih layanan, paket, dan fotografer favorit Anda.')

@section('content')
<div class="bg-[#faf7f4] min-h-screen py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl font-serif font-bold text-[#3d2b1f] mb-4">Mulai Sesi Anda</h1>
            <p class="text-lg text-[#7a6b5d] max-w-2xl mx-auto">Abadikan momen berharga Anda bersama Swarattive. Silakan lengkapi formulir di bawah ini untuk memesan jadwal pemotretan.</p>
        </div>

        @if(session('error'))
            <div class="mb-8 bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <livewire:booking-form />
    </div>
</div>
@endsection
