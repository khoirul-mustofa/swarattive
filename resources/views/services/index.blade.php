@extends('layouts.app')

@section('title', 'Layanan Kami - Swarattive Photography')
@section('description', 'Jelajahi berbagai paket layanan fotografi profesional yang ditawarkan oleh Swarattive Photography.')

@section('content')
<!-- Hero Section -->
<section class="relative h-[60vh] lg:h-[70vh] bg-cover bg-center bg-neutral-900" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ $hero['image'] ? (str_starts_with($hero['image'], 'http') ? $hero['image'] : asset('storage/' . $hero['image'])) : asset('images/services-hero-fallback.jpg') }}');">
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="text-center text-white px-4">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-serif font-bold mb-6 animate-fade-in drop-shadow-lg">
                @php
                    $titleParts = explode(' ', $hero['title']);
                    $lastWord = array_pop($titleParts);
                    $firstPart = implode(' ', $titleParts);
                @endphp
                {{ $firstPart }} <span class="text-amber-400">{{ $lastWord }}</span>
            </h1>
            <p class="text-lg md:text-xl lg:text-2xl mb-8 max-w-3xl mx-auto animate-slide-up text-gray-200 drop-shadow-md">
                {{ $hero['subtitle'] }}
            </p>
        </div>
    </div>
</section>

<!-- Services Collection Section -->
<section class="py-20 bg-[#faf7f4]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($categories->count() > 0)
            @foreach($categories as $category)
                @php
                    // Ambil services untuk kategori yang bersangkutan dari koleksi global
                    $categoryServices = $services->where('category_id', $category->id);
                @endphp

                @if($categoryServices->count() > 0)
                    <div class="mb-20">
                        <div class="mb-10 text-center md:text-left border-b-2 border-[#e8ddd2] pb-6">
                            <h2 class="text-3xl font-serif font-bold text-[#3d2b1f] uppercase tracking-wide">{{ $category->name }}</h2>
                            @if($category->description)
                                <p class="text-[#7a6b5d] mt-3 max-w-3xl">{{ $category->description }}</p>
                            @endif
                        </div>

                        <div class="space-y-8 xl:space-y-12">
                            @foreach($categoryServices as $service)
                                <div id="{{ $service->slug }}" class="bg-white rounded-2xl shadow-sm border border-[#ede8e3] overflow-hidden flex flex-col lg:flex-row transition-all hover:shadow-xl group">
                                    <div class="relative w-full lg:w-5/12 aspect-[4/3] lg:aspect-auto lg:h-auto overflow-hidden flex-shrink-0">
                                        @if($service->image_url)
                                            <img src="{{ $service->image_url }}" 
                                                alt="{{ $service->name }}" 
                                                loading="lazy" decoding="async"
                                                class="w-full h-full object-cover lg:absolute lg:inset-0 group-hover:scale-105 transition-transform duration-700 ease-in-out">
                                        @else
                                            <x-image-placeholder class="w-full h-full lg:absolute lg:inset-0" />
                                        @endif
                                        <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold text-[#3d2b1f] shadow-sm">
                                            {{ $service->duration_minutes }} Menit
                                        </div>
                                    </div>
                                    
                                    <div class="p-6 xl:p-10 flex-1 flex flex-col w-full">
                                        <h3 class="text-xl lg:text-3xl font-bold text-[#3d2b1f] mb-3 group-hover:text-amber-700 transition-colors">{{ $service->name }}</h3>
                                        <p class="text-sm lg:text-base text-[#7a6b5d] leading-relaxed mb-6">{{ $service->description }}</p>
                                        
                                        <div class="mt-auto border-t border-gray-100 pt-6">
                                            <div class="{{ $service->packages->count() > 0 ? 'mb-6' : '' }}">
                                                <div class="text-xs text-[#9a8b7d] uppercase tracking-wider font-bold mb-1">Harga Dasar Mulai</div>
                                                <div class="text-2xl lg:text-3xl font-extrabold text-[#d28e46]">Rp {{ number_format($service->base_price, 0, ',', '.') }}</div>
                                            </div>

                                            @if($service->packages->count() > 0)
                                                <div class="border-t border-dashed border-[#e8ddd2] pt-6">
                                                    <h4 class="text-sm lg:text-base font-bold text-[#3d2b1f] mb-4 flex items-center">
                                                        <svg class="w-5 h-5 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                                                        Pilihan Paket
                                                    </h4>
                                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                        @foreach($service->packages as $package)
                                                            <div class="text-sm p-4 bg-[#fdfaf8] hover:bg-[#faf5ef] transition-colors border border-[#e8ddd2] rounded-xl flex flex-col">
                                                                <div class="flex justify-between items-start font-bold text-[#3d2b1f] gap-3 mb-4">
                                                                    <span class="leading-tight">{{ $package->name }}</span>
                                                                    <span class="text-amber-700 whitespace-nowrap text-right">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                                                                </div>

                                                                @if(is_array($package->features) && count($package->features) > 0)
                                                                    <ul class="mb-4 space-y-2">
                                                                        @foreach($package->features as $feature)
                                                                            <li class="flex items-start text-[11px] text-[#7a6b5d] leading-tight">
                                                                                <svg class="w-3.5 h-3.5 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                                                </svg>
                                                                                <span>{{ $feature }}</span>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                                @if($package->description)
                                                                    <p class="text-xs text-[#8a7b6d] leading-relaxed mt-auto border-t border-gray-100 pt-2">{{ $package->description }}</p>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <div class="text-center py-20">
                <p class="text-[#7a6b5d] text-lg">Belum ada layanan yang tersedia saat ini.</p>
            </div>
        @endif
    </div>
</section>

<!-- Meet The Team Section -->
<x-team-section :teamMembers="$teamMembers" />

<!-- CTA Section -->
<section class="py-20 bg-[#3d2b1f]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-serif font-bold text-white mb-6">Siap Mengabadikan Momen Anda?</h2>
        <p class="text-xl text-[#d4c9bb] mb-8">Pesan layanan hari ini dan raih pengalaman fotografi yang menjanjikan hasil melampaui harapan Anda.</p>
        <a href="{{ route('booking.index') }}" class="inline-block bg-[#f0c27f] text-[#3d2b1f] px-10 py-4 rounded-xl font-bold uppercase tracking-widest hover:bg-white transition-all shadow-lg active:scale-95">
            Booking Jadwal Sekarang
        </a>
    </div>
</section>

@endsection
