@extends('layouts.app')

@section('title', 'Blog - Photography')

@section('content')
    <!-- PAGE BANNER -->
    <div class="relative w-full h-[40vh] min-h-[300px] flex items-center justify-center overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1452587925148-ce544e77e70d?auto=format&fit=crop&q=80&w=1920"
                alt="Blog Banner Background" class="w-full h-full object-cover">
        </div>
        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-black/60 z-10"></div>

        <!-- Banner Content -->
        <div class="relative z-20 text-center px-4 max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 tracking-tight">Blog</h1>
            <p class="text-lg md:text-xl text-gray-200 font-light">Tips, inspirasi, dan cerita di balik lensa</p>
        </div>
    </div>

    <!-- BLOG POSTS -->
    <section class="py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Blog Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($blogPosts as $post)
                    <!-- Blog Card -->
                    <article
                        class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ $post->image_url }}"
                                alt="{{ $post->title }}"
                                loading="lazy" decoding="async"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="text-sm font-semibold text-amber-600 tracking-wide uppercase mb-2">
                                {{ $post->tags[0] ?? 'Photography' }} &bull; {{ $post->published_at->format('d M Y') }}
                            </div>
                            <h3
                                class="text-xl font-bold text-gray-900 mb-3 leading-tight group-hover:text-amber-600 transition-colors">
                                {{ $post->title }}</h3>
                            <p class="text-gray-600 mb-6 flex-grow line-clamp-3">
                                {{ $post->excerpt }}</p>
                            <a href="{{ route('blog.show', $post->slug) }}"
                                class="inline-flex items-center text-sm font-semibold text-amber-600 hover:text-amber-800 transition-colors mt-auto">
                                Read More
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 text-lg">Belum ada artikel yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-16">
                {{ $blogPosts->links() }}
            </div>
        </div>
    </section>
@endsection