@extends('layouts.app')

@section('title', $portfolioItem->title . ' - Swarattive Photography')
@section('description', substr(strip_tags($portfolioItem->description), 0, 160))

@section('content')

    {{-- ===================== HERO ===================== --}}
    <div class="relative h-[360px] md:h-[480px] overflow-hidden">
        <img src="{{ asset('storage/' . $portfolioItem->image_url) }}"
             alt="{{ $portfolioItem->title }}"
             class="absolute inset-0 w-full h-full object-cover scale-105">
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/80"></div>

        {{-- Breadcrumb --}}
        <div class="absolute top-6 left-1/2 -translate-x-1/2 w-full max-w-[1100px] px-6">
            <nav class="flex items-center gap-2 text-white/50 text-xs">
                <a href="{{ route('portfolio.index') }}" class="hover:text-white transition-colors">Portfolio</a>
                <span>/</span>
                <span class="text-[#f0c27f]">{{ $portfolioItem->category->name }}</span>
            </nav>
        </div>

        {{-- Judul --}}
        <div class="relative h-full flex flex-col items-center justify-center text-center px-4">
            <span class="text-[#f0c27f] text-[10px] uppercase tracking-[4px] font-semibold mb-3">
                {{ $portfolioItem->category->name }}
            </span>
            <h1 class="text-white font-serif font-bold text-3xl sm:text-4xl md:text-5xl leading-tight max-w-3xl">
                {{ $portfolioItem->title }}
            </h1>
            @if($portfolioItem->is_featured)
                <span class="mt-4 inline-flex items-center gap-1.5 bg-[#f0c27f] text-[#3d2b1f] text-[10px] font-bold uppercase tracking-widest px-3.5 py-1.5 rounded-full shadow-lg">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    Unggulan
                </span>
            @endif
        </div>
    </div>

    {{-- ===================== KONTEN ===================== --}}
    <div class="bg-[#faf7f4] py-14 md:py-20">
        <div class="max-w-[1100px] mx-auto px-4 sm:px-6">
            <div class="flex flex-col lg:flex-row gap-10 xl:gap-14">

                {{-- ========= KIRI: Foto & Galeri ========= --}}
                <div class="flex-1 min-w-0">

                    {{-- Foto Utama --}}
                    <div class="rounded-2xl overflow-hidden shadow-lg mb-8">
                        <img src="{{ asset('storage/' . $portfolioItem->image_url) }}"
                             alt="{{ $portfolioItem->title }}"
                             class="w-full object-cover">
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-10">
                        <h2 class="text-[#3d2b1f] font-serif font-bold text-xl mb-3">Tentang Karya Ini</h2>
                        <p class="text-[#7a6b5d] leading-relaxed text-[0.95rem]">{{ $portfolioItem->description }}</p>
                    </div>

                    {{-- Galeri --}}
                    @if($portfolioItem->gallery_images && count($portfolioItem->gallery_images) > 0)
                        <div>
                            <h2 class="text-[#3d2b1f] font-serif font-bold text-xl mb-4">
                                Galeri Foto
                                <span class="text-[#9a8b7d] font-sans font-normal text-sm ml-2">({{ count($portfolioItem->gallery_images) }} foto)</span>
                            </h2>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                @foreach($portfolioItem->gallery_images as $gImg)
                                    <button type="button"
                                            onclick="openLightbox('{{ asset('storage/' . $gImg) }}')"
                                            class="group relative overflow-hidden rounded-xl aspect-square cursor-zoom-in shadow-sm hover:shadow-md transition-shadow">
                                        <img src="{{ asset('storage/' . $gImg) }}"
                                             alt="Galeri"
                                             loading="lazy"
                                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300 flex items-center justify-center">
                                            <svg class="w-7 h-7 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 drop-shadow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                            </svg>
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- ========= KANAN: Info (Sticky) ========= --}}
                <aside class="w-full lg:w-[300px] xl:w-[320px] flex-shrink-0">
                    <div class="sticky top-24 space-y-5">

                        {{-- Detail Card --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-[#ede8e3] overflow-hidden">
                            <div class="bg-[#3d2b1f] px-5 py-4">
                                <h3 class="text-white font-serif font-semibold text-base">Detail Karya</h3>
                            </div>
                            <ul class="divide-y divide-[#f0ece7]">
                                {{-- Kategori --}}
                                <li class="flex items-center gap-3 px-5 py-4">
                                    <div class="w-8 h-8 rounded-lg bg-[#f5f0eb] flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4 text-[#3d2b1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-[10px] text-[#a89880] uppercase tracking-widest font-medium">Kategori</p>
                                        <p class="text-[#3d2b1f] font-semibold text-sm truncate">{{ $portfolioItem->category->name }}</p>
                                    </div>
                                </li>

                                {{-- Klien --}}
                                @if($portfolioItem->client_name)
                                <li class="flex items-center gap-3 px-5 py-4">
                                    <div class="w-8 h-8 rounded-lg bg-[#f5f0eb] flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4 text-[#3d2b1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-[10px] text-[#a89880] uppercase tracking-widest font-medium">Klien</p>
                                        <p class="text-[#3d2b1f] font-semibold text-sm truncate">{{ $portfolioItem->client_name }}</p>
                                    </div>
                                </li>
                                @endif

                                {{-- Tanggal --}}
                                @if($portfolioItem->shoot_date)
                                <li class="flex items-center gap-3 px-5 py-4">
                                    <div class="w-8 h-8 rounded-lg bg-[#f5f0eb] flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4 text-[#3d2b1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-[10px] text-[#a89880] uppercase tracking-widest font-medium">Tanggal Pemotretan</p>
                                        <p class="text-[#3d2b1f] font-semibold text-sm">{{ $portfolioItem->shoot_date->translatedFormat('d F Y') }}</p>
                                    </div>
                                </li>
                                @endif

                                {{-- Jumlah galeri --}}
                                @if($portfolioItem->gallery_images && count($portfolioItem->gallery_images) > 0)
                                <li class="flex items-center gap-3 px-5 py-4">
                                    <div class="w-8 h-8 rounded-lg bg-[#f5f0eb] flex items-center justify-center shrink-0">
                                        <svg class="w-4 h-4 text-[#3d2b1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-[10px] text-[#a89880] uppercase tracking-widest font-medium">Galeri</p>
                                        <p class="text-[#3d2b1f] font-semibold text-sm">{{ count($portfolioItem->gallery_images) }} foto</p>
                                    </div>
                                </li>
                                @endif
                            </ul>
                        </div>

                        {{-- Tags --}}
                        @if($portfolioItem->tags && count($portfolioItem->tags) > 0)
                        <div class="bg-white rounded-2xl shadow-sm border border-[#ede8e3] px-5 py-4">
                            <p class="text-[10px] text-[#a89880] uppercase tracking-widest font-medium mb-3">Tags</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($portfolioItem->tags as $tag)
                                    <span class="text-[11px] text-[#3d2b1f] bg-[#f5f0eb] border border-[#e0d5c9] px-3 py-1 rounded-full font-medium">
                                        #{{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        {{-- CTA Booking --}}
                        <div class="bg-[#3d2b1f] rounded-2xl px-5 py-6 text-center shadow-md">
                            <p class="text-[#f0c27f] font-serif text-lg font-semibold mb-1">Suka karya ini?</p>
                            <p class="text-white/60 text-xs mb-5 leading-relaxed">Konsultasikan sesi foto Anda bersama kami.</p>
                            <a href="{{ route('booking.index') }}"
                               class="block w-full bg-[#f0c27f] hover:bg-[#e0b46a] text-[#3d2b1f] text-xs font-bold uppercase tracking-widest py-3 rounded-xl transition-colors duration-200">
                                Booking Sekarang
                            </a>
                        </div>

                        {{-- Kembali --}}
                        <a href="{{ route('portfolio.index') }}"
                           class="flex items-center justify-center gap-2 text-[#9a8b7d] hover:text-[#3d2b1f] transition-colors text-xs font-medium py-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Kembali ke Karya
                        </a>
                    </div>
                </aside>

            </div>

            {{-- ========= KARYA TERKAIT ========= --}}
            @if($relatedItems->isNotEmpty())
            <div class="mt-20 pt-12 border-t border-[#e8ddd2]">
                <div class="text-center mb-8">
                    <p class="text-[#9a8b7d] text-xs uppercase tracking-widest mb-1">Kategori yang sama</p>
                    <h2 class="text-[#3d2b1f] font-serif font-bold text-2xl">Karya Terkait</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($relatedItems->take(3) as $related)
                        <a href="{{ route('portfolio.show', $related->slug) }}"
                           class="group relative rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow duration-300 aspect-[4/3] block bg-gray-100">
                            <img src="{{ asset('storage/' . $related->image_url) }}"
                                 alt="{{ $related->title }}"
                                 loading="lazy"
                                 class="w-full h-full object-cover transition-transform duration-600 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent
                                        opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                                <p class="text-[#f0c27f] text-[9px] uppercase tracking-widest mb-0.5">{{ $related->category->name }}</p>
                                <h3 class="text-white font-serif font-semibold text-sm leading-snug">{{ $related->title }}</h3>
                                @if($related->client_name)
                                    <p class="text-white/60 text-[11px] mt-0.5">{{ $related->client_name }}</p>
                                @endif
                            </div>
                            @if($related->is_featured)
                                <span class="absolute top-2.5 left-2.5 bg-[#f0c27f] text-[#3d2b1f] text-[8px] font-bold uppercase tracking-widest px-2 py-0.5 rounded-full">★ Unggulan</span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>

    {{-- LIGHTBOX --}}
    <div id="lightbox"
         class="fixed inset-0 z-[9999] bg-black/92 backdrop-blur-sm hidden items-center justify-center p-4"
         onclick="closeLightbox()">
        <button onclick="closeLightbox()"
                class="absolute top-4 right-5 text-white/50 hover:text-white text-4xl leading-none transition-colors">&times;</button>
        <img id="lightboxImg" src="" alt=""
             class="max-w-full max-h-[90vh] object-contain rounded-xl shadow-2xl"
             onclick="event.stopPropagation()">
    </div>

@endsection

@push('scripts')
<script>
function openLightbox(src) {
    document.getElementById('lightboxImg').src = src;
    const lb = document.getElementById('lightbox');
    lb.classList.remove('hidden');
    lb.classList.add('flex');
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    document.getElementById('lightbox').classList.add('hidden');
    document.getElementById('lightbox').classList.remove('flex');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });
</script>
@endpush
