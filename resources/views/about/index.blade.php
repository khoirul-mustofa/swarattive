@extends('layouts.app')

@section('title', $about->story_title . ' — Swarattive Photography')

@section('content')
<!-- Page Banner -->
<section class="relative h-[50vh] lg:h-[60vh] overflow-hidden flex items-center justify-center">
    @if($about->page_banner_image_url)
        <img src="{{ $about->page_banner_image_url }}" alt="About Us Banner" 
            decoding="async"
            class="absolute inset-0 w-full h-full object-cover">
    @else
        <div class="absolute inset-0 bg-neutral-900">
            @if(file_exists(public_path('images/about-hero-fallback.jpg')))
                <img src="{{ asset('images/about-hero-fallback.jpg') }}" class="w-full h-full object-cover">
            @else
                <x-image-placeholder class="w-full h-full opacity-50" />
            @endif
        </div>
    @endif
    <div class="absolute inset-0 bg-linear-to-t from-black/80 via-black/40 to-transparent"></div>
    <div class="relative z-10 text-center text-white px-4">
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-serif font-bold mb-4 animate-fade-in drop-shadow-xl" x-data x-intersect="$el.classList.add('animate-slide-up')">
            {{ $about->story_title }}
        </h1>
        <p class="text-lg md:text-xl text-neutral-300 max-w-2xl mx-auto drop-shadow-md">
            Kisah di balik lensa kami
        </p>
    </div>
</section>

<!-- Our Story Section -->
<section class="py-20 lg:py-32 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="relative" x-data x-intersect="$el.classList.add('animate-fade-in-left')">
                <div class="aspect-4/5 rounded-3xl overflow-hidden shadow-2xl skew-y-1 lg:skew-y-2 hover:skew-y-0 transition-transform duration-700">
                    @if($about->story_image_url)
                        <img src="{{ $about->story_image_url }}" alt="Our Story Image" 
                            loading="lazy" decoding="async"
                            class="w-full h-full object-cover">
                    @else
                        @if(file_exists(public_path('images/about-story-fallback.jpg')))
                            <img src="{{ asset('images/about-story-fallback.jpg') }}" class="w-full h-full object-cover">
                        @else
                            <x-image-placeholder class="w-full h-full object-cover" />
                        @endif
                    @endif
                </div>
                <div class="absolute -bottom-8 -right-8 w-48 h-48 bg-amber-500/10 rounded-full blur-3xl -z-10"></div>
            </div>
            
            <div class="space-y-8" x-data x-intersect="$el.classList.add('animate-fade-in-right')">
                <div class="inline-block px-4 py-1.5 bg-amber-100 text-amber-700 rounded-full text-sm font-bold tracking-widest uppercase mb-4">
                    Cerita Kami
                </div>
                <h2 class="text-3xl md:text-5xl font-serif font-bold text-neutral-900 leading-tight">
                    Mengabadikan <span class="text-amber-600 italic">Momen</span> Abadi Melalui Lensa
                </h2>
                <div class="prose prose-lg text-neutral-600 max-w-none leading-relaxed">
                    {!! $about->story_content !!}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Behind The Scenes -->
<section class="py-20 lg:py-32 bg-neutral-50 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-1/3 h-full bg-linear-to-l from-amber-500/5 to-transparent pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16 lg:mb-24">
            <h2 class="text-3xl md:text-5xl font-serif font-bold text-neutral-900 mb-4">{{ $about->bts_title }}</h2>
            <p class="text-neutral-500 max-w-2xl mx-auto text-lg italic">{{ $about->bts_subtitle }}</p>
            <div class="w-24 h-1 bg-amber-500 mx-auto mt-8 rounded-full"></div>
        </div>

        @if($about->bts_items && count($about->bts_items) > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 xl:gap-12">
            @foreach($about->bts_items as $index => $item)
                <div class="group h-full" x-data x-intersect="$el.classList.add('scale-100 opacity-100')" class="scale-95 opacity-0 transition-all duration-700 delay-{{ $index * 100 }}">
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-neutral-200 h-full flex flex-col hover:shadow-xl hover:-translate-y-2 transition-all duration-500">
                        <div class="relative h-64 overflow-hidden">
                            @if(isset($item['image_url']))
                                <img src="{{ $item['image_url'] }}" alt="{{ $item['stage'] ?? $item['title'] ?? 'Tahapan' }}" 
                                    loading="lazy" decoding="async"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <x-image-placeholder class="w-full h-full" />
                            @endif
                            <div class="absolute inset-0 bg-linear-to-t from-black/60 to-transparent flex items-end p-6 translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-500">
                                <span class="bg-amber-500 text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full shadow-lg">Tahap {{ $index + 1 }}</span>
                            </div>
                        </div>
                        <div class="p-8 flex-1 flex flex-col">
                            <h4 class="text-xl font-bold text-neutral-900 mb-3 capitalize">
                                {{ str_replace('_', ' ', $item['stage'] ?? $item['title'] ?? 'Tahapan') }}
                            </h4>
                            <p class="text-neutral-600 leading-relaxed italic">
                                "{{ $item['description'] }}"
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

<!-- Meet The Team -->
<x-team-section :teamMembers="$teamMembers" />

<!-- Call to Action -->
<section class="py-20 lg:py-32 bg-neutral-900 relative overflow-hidden">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-amber-500/10 rounded-full blur-[120px] -z-0"></div>
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
        <h2 class="text-3xl md:text-5xl font-serif font-bold text-white mb-8">Siap Mengabadikan <span class="italic text-amber-500">Cerita</span> Anda?</h2>
        <p class="text-neutral-400 text-lg mb-12 max-w-2xl mx-auto italic">"Kami tidak hanya mengambil foto, kami membekukan waktu untuk menjadi warisan visual bagi Anda."</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
            <a href="{{ route('booking.index') }}" class="w-full sm:w-auto px-10 py-5 bg-amber-500 text-neutral-900 font-bold rounded-full hover:bg-amber-400 transition-all transform hover:scale-105 shadow-xl shadow-amber-500/20 active:scale-95">
                Mulai Sesi Foto
            </a>
            <a href="{{ route('contact.index') }}" class="w-full sm:w-auto px-10 py-5 border-2 border-white/20 text-white font-bold rounded-full hover:bg-white hover:text-neutral-900 transition-all active:scale-95">
                Konsultasi Gratis
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<style>
    @keyframes fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes slide-up {
        from { transform: translateY(30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    @keyframes fade-in-left {
        from { transform: translateX(-30px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes fade-in-right {
        from { transform: translateX(30px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    .animate-fade-in { animation: fade-in 1s ease-out forwards; }
    .animate-slide-up { animation: slide-up 1s ease-out forwards; }
    .animate-fade-in-left { animation: fade-in-left 1s ease-out forwards; }
    .animate-fade-in-right { animation: fade-in-right 1s ease-out forwards; }
</style>
@endpush
