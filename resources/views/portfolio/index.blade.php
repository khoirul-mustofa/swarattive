@extends('layouts.app')

@section('title', 'Portfolio - Swarattive Photography')
@section('description', 'Koleksi karya terbaik kami dalam berbagai sesi foto profesional')

@section('content')

    {{-- ===================== HERO BANNER ===================== --}}
    <div class="relative h-[320px] md:h-[400px] overflow-hidden">
        @if($heroSettings['image'])
            <img src="{{ str_starts_with($heroSettings['image'], 'http') ? $heroSettings['image'] : asset('storage/' . $heroSettings['image']) }}" alt="Portfolio Hero"
                 class="absolute inset-0 w-full h-full object-cover">
        @else
            <div class="absolute inset-0 bg-[#3d2b1f]"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-b from-[#3d2b1f]/70 via-[#3d2b1f]/50 to-[#3d2b1f]/80"></div>
        <div class="relative h-full flex flex-col items-center justify-center text-center px-4">
            @if($heroSettings['eyebrow'])
                <p class="text-[#f0c27f] uppercase tracking-[4px] text-xs font-semibold mb-3">{{ $heroSettings['eyebrow'] }}</p>
            @endif
            <h1 class="text-white font-serif font-bold text-4xl md:text-6xl mb-3 leading-tight">{{ $heroSettings['title'] }}</h1>
            @if($heroSettings['subtitle'])
                <p class="text-white/70 text-sm md:text-base max-w-md">{{ $heroSettings['subtitle'] }}</p>
            @endif
        </div>
    </div>

    {{-- ===================== MAIN SECTION ===================== --}}
    <section class="py-16 bg-[#faf7f4] dark:bg-neutral-900 transition-colors duration-500">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6">

            {{-- FILTER KATEGORI --}}
            <div class="flex flex-wrap justify-center gap-2 mb-12 portfolio__filters">
                <button
                    class="filter-btn active px-5 py-2 text-xs font-semibold uppercase tracking-widest rounded-full border transition-all duration-300 dark:bg-amber-600 dark:border-amber-600 dark:text-white"
                    data-filter="all">
                    Semua
                </button>
                @foreach($categories as $cat)
                    <button
                        class="filter-btn px-5 py-2 text-xs font-semibold uppercase tracking-widest rounded-full border transition-all duration-300 dark:border-neutral-700 dark:text-gray-400 dark:hover:bg-neutral-800 dark:hover:text-white"
                        data-filter="{{ $cat->slug }}">
                        {{ $cat->name }}
                    </button>
                @endforeach
            </div>

            {{-- GRID MASONRY --}}
            @if($portfolioItems->isNotEmpty())
                <div class="columns-1 sm:columns-2 lg:columns-3 gap-5 space-y-5" id="portfolioGallery">
                    @foreach($portfolioItems as $item)
                        <article class="portfolio__item break-inside-avoid group relative overflow-hidden rounded-2xl shadow-sm bg-white dark:bg-neutral-800 border border-transparent dark:border-neutral-700/50 animate-fadein transition-colors"
                                 data-category="{{ $item->category->slug }}">

                            <a href="{{ route('portfolio.show', $item->slug) }}" class="block">

                                {{-- Gambar --}}
                                <div class="relative overflow-hidden">
                                    <img src="{{ $item->image_url }}"
                                         alt="{{ $item->title }}"
                                         loading="lazy" decoding="async"
                                         class="w-full object-cover transition-transform duration-700 group-hover:scale-105">

                                    {{-- Overlay gradient --}}
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/10 to-transparent
                                                translate-y-2 opacity-0 group-hover:opacity-100 group-hover:translate-y-0
                                                transition-all duration-400 flex flex-col justify-end p-5">
                                        <span class="text-[#f0c27f] text-[10px] uppercase tracking-widest font-semibold mb-1">
                                            {{ $item->category->name }}
                                        </span>
                                        <h3 class="text-white font-serif text-lg font-semibold leading-snug mb-2">
                                            {{ $item->title }}
                                        </h3>
                                        <div class="flex items-center gap-3 text-white/65 text-xs">
                                            @if($item->client_name)
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                                    {{ $item->client_name }}
                                                </span>
                                            @endif
                                            @if($item->shoot_date)
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-3 h-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                                    {{ $item->shoot_date->format('M Y') }}
                                                </span>
                                            @endif
                                        </div>
                                        @if($item->tags && count($item->tags) > 0)
                                            <div class="flex flex-wrap gap-1 mt-2">
                                                @foreach(array_slice($item->tags, 0, 3) as $tag)
                                                    <span class="bg-white/15 text-white/90 text-[9px] px-2 py-0.5 rounded-full border border-white/20">#{{ $tag }}</span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Badges --}}
                                <div class="absolute top-3 left-3 right-3 flex justify-between items-start pointer-events-none">
                                    @if($item->is_featured)
                                        <span class="bg-[#f0c27f] text-[#3d2b1f] text-[9px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-full shadow">
                                            ★ Unggulan
                                        </span>
                                    @else
                                        <span></span>
                                    @endif
                                    @if($item->gallery_images && count($item->gallery_images) > 0)
                                        <span class="bg-black/50 backdrop-blur-sm text-white text-[9px] font-medium px-2 py-1 rounded-full flex items-center gap-1">
                                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            +{{ count($item->gallery_images) }}
                                        </span>
                                    @endif
                                </div>

                            </a>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="text-center py-24">
                    <svg class="w-20 h-20 mx-auto text-[#d4c9bb] dark:text-neutral-700 mb-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-[#9a8b7d] dark:text-gray-400 text-lg font-medium">Belum ada karya yang ditampilkan.</p>
                    <p class="text-[#b5a99a] dark:text-gray-600 text-sm mt-1">Tambahkan portfolio melalui dashboard admin.</p>
                </div>
            @endif

            {{-- PAGINATION --}}
            @if($portfolioItems->hasPages())
                <div class="mt-14 flex justify-center">
                    {{ $portfolioItems->links() }}
                </div>
            @endif

        </div>
    </section>

@endsection

@push('scripts')
<style>
    .filter-btn {
        color: #7a6b5d;
        border-color: #d4c9bb;
        background: transparent;
    }
    .filter-btn:hover,
    .filter-btn.active {
        background: #3d2b1f;
        color: #f9f5ef;
        border-color: #3d2b1f;
    }

    /* Dark mode overrides for manual styles */
    .dark .filter-btn {
        color: #9ca3af;
        border-color: #374151;
    }
    .dark .filter-btn:hover {
        background: #1f2937;
        color: white;
    }
    .dark .filter-btn.active {
        background: #d97706; /* amber-600 */
        border-color: #d97706;
        color: white;
    }

    .animate-fadein {
        animation: fadein 0.4s ease both;
    }
    @keyframes fadein {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const btns  = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('.portfolio__item');

    btns.forEach(btn => {
        btn.addEventListener('click', () => {
            btns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filter = btn.dataset.filter;

            items.forEach(item => {
                const show = filter === 'all' || item.dataset.category === filter;
                item.style.display = show ? '' : 'none';
            });
        });
    });

    // Intersection observer untuk animasi
    const io = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('animate-fadein');
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.08 });
    items.forEach(el => io.observe(el));
});
</script>
@endpush
