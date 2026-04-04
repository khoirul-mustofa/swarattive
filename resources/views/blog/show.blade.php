@extends('layouts.app')

@section('title', $blogPost->title . ' - Swarattive Blog')
@section('description', $blogPost->excerpt)

@section('content')
    <!-- ARTICLE HERO -->
    <div class="relative w-full h-[50vh] min-h-[400px] flex items-end overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="{{ $blogPost->image_url }}" alt="{{ $blogPost->title }}" 
                decoding="async" 
                class="w-full h-full object-cover">
        </div>
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent z-10"></div>

        <!-- Banner Content -->
        <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12 w-full">
            <div class="max-w-3xl">
                <div class="flex items-center gap-3 mb-4">
                    @foreach($blogPost->tags ?? [] as $tag)
                        <span class="px-3 py-1 bg-amber-600 text-white text-xs font-semibold rounded-full uppercase tracking-wider">
                            {{ $tag }}
                        </span>
                    @endforeach
                </div>
                <h1 class="text-3xl md:text-5xl font-bold text-white mb-4 leading-tight">
                    {{ $blogPost->title }}
                </h1>
                <div class="flex items-center text-gray-300 text-sm gap-4">
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $blogPost->published_at->format('d M Y') }}
                    </span>
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $blogPost->reading_time }} menit baca
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- ARTICLE CONTENT -->
    <article class="py-16 md:py-24 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back to Blog -->
            <a href="{{ route('blog.index') }}" class="inline-flex items-center text-amber-600 hover:text-amber-700 font-semibold mb-12 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar Artikel
            </a>

            <!-- Content Area -->
            <div class="rich-text-content">
                {!! $blogPost->content !!}
            </div>
        </div>
    </article>

    <!-- RELATED POSTS -->
    @if($relatedPosts->count() > 0)
        <section class="py-16 md:py-24 bg-gray-50 border-t">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-end mb-12">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Artikel Terkait</h2>
                        <p class="text-gray-600">Lebih banyak cerita dan tips untuk Anda</p>
                    </div>
                    <a href="{{ route('blog.index') }}" class="hidden md:block text-amber-600 hover:text-amber-700 font-semibold">
                        Lihat Semua Artikel &rarr;
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($relatedPosts as $post)
                        <article class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col">
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ $post->image_url }}" alt="{{ $post->title }}" 
                                    loading="lazy" decoding="async"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            </div>
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="text-xs font-semibold text-amber-600 tracking-wide uppercase mb-2">
                                    {{ $post->tags[0] ?? 'Photography' }} &bull; {{ $post->published_at->format('d M Y') }}
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-3 leading-tight group-hover:text-amber-600 transition-colors">
                                    {{ $post->title }}
                                </h3>
                                <a href="{{ route('blog.show', $post->slug) }}" class="inline-flex items-center text-sm font-semibold text-amber-600 hover:text-amber-700 transition-colors mt-auto">
                                    Baca Selengkapnya &rarr;
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <style>
        .rich-text-content {
            @apply text-gray-800 leading-relaxed text-lg;
        }
        .rich-text-content p {
            @apply mb-6;
        }
        .rich-text-content h2 {
            @apply text-2xl md:text-3xl font-bold text-gray-900 mt-12 mb-6;
        }
        .rich-text-content h3 {
            @apply text-xl md:text-2xl font-bold text-gray-900 mt-8 mb-4;
        }
        .rich-text-content ul {
            @apply list-disc list-inside mb-6 space-y-2;
        }
        .rich-text-content ol {
            @apply list-decimal list-inside mb-6 space-y-2;
        }
        .rich-text-content blockquote {
            @apply border-l-4 border-amber-600 pl-6 italic text-gray-600 my-8 py-2;
        }
    </style>
@endsection
