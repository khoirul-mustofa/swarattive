@extends('layouts.app')

@section('title', 'Selamat Datang di Swarattive Photography')
@section('description', 'Layanan fotografi profesional untuk mengabadikan momen berharga Anda')

@section('content')
    <!-- Hero Slider Section -->
    @if(isset($heroSlides) && $heroSlides->count() > 0)
        <section
            x-data="{ currentSlide: 0, slides: {{ $heroSlides->count() }}, init() { setInterval(() => { this.currentSlide = (this.currentSlide + 1) % this.slides }, 5000) } }"
            class="relative h-screen bg-neutral-900 overflow-hidden">
            @foreach($heroSlides as $index => $slide)
                <div x-show="currentSlide === {{ $index }}" x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-105" class="absolute inset-0 bg-cover bg-center"
                    style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ str_starts_with($slide->image, 'http') ? $slide->image : asset('storage/' . $slide->image) }}');">
                    <div class="absolute inset-0 flex items-center justify-start max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="text-left text-white max-w-2xl px-4">
                            <h1 class="text-5xl md:text-7xl font-serif font-bold mb-6 leading-tight">
                                {{ $slide->title }}
                            </h1>
                            <p class="text-xl md:text-2xl mb-8 text-gray-200">
                                {{ $slide->description }}
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4 justify-start">
                                <a href="{{ $slide->button_url }}"
                                    class="bg-amber-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-amber-700 transition-colors shadow-lg text-center">
                                    {{ $slide->button_text }}
                                </a>
                                <a href="{{ route('portfolio.index') }}"
                                    class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-gray-900 transition-colors text-center">
                                    Lihat Portofolio
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Indicators -->
            <div class="absolute bottom-20 left-0 right-0 flex justify-center gap-2 z-10 hidden md:flex">
                <template x-for="i in slides" :key="i">
                    <button @click="currentSlide = i - 1" class="w-3 h-3 rounded-full transition-colors duration-300"
                        :class="currentSlide === i - 1 ? 'bg-amber-400' : 'bg-white/50 hover:bg-white/80'">
                    </button>
                </template>
            </div>
        </section>
    @else
        <!-- Fallback Hero Section -->
        <section class="relative h-screen bg-cover bg-center bg-neutral-900"
            style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('images/hero-fallback.jpg') }}');">
            <div class="absolute inset-0 flex items-center justify-start max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-left text-white max-w-2xl px-4">
                    <h1 class="text-5xl md:text-7xl font-serif font-bold mb-6">
                        Selamat Datang di<br>
                        <span class="text-amber-400">Swarattive</span><br>
                        Photography
                    </h1>
                    <p class="text-xl md:text-2xl mb-8 animate-slide-up text-gray-200">
                        Mengabadikan momen terindah dalam hidup Anda dengan sentuhan seni dan keindahan abadi.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-start animate-slide-up">
                        <a href="{{ route('portfolio.index') }}"
                            class="bg-amber-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-amber-700 transition-colors shadow-lg text-center">
                            Lihat Portofolio
                        </a>
                        <a href="{{ route('booking.index') }}"
                            class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-gray-900 transition-colors text-center">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Services Preview -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-serif font-bold text-gray-900 mb-4">Layanan Kami</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Layanan fotografi profesional yang disesuaikan dengan
                    kebutuhan Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($services as $service)
                    @php
                        $icon = $service->icon ?: 'M12 4v16m8-8H4'; // fallback default icon
                    @endphp
                    <div class="text-center group">
                        <div
                            class="bg-amber-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-amber-600 transition-colors">
                            <svg class="w-10 h-10 text-amber-600 group-hover:text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">{{ $service->name }}</h3>
                        <p class="text-gray-600">{{ Str::limit($service->description, 70) }}</p>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                        <p class="text-gray-500">Belum ada layanan yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Portfolio Preview -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-serif font-bold text-gray-900 mb-4">Karya Terbaru</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Jelajahi proyek fotografi terbaru kami</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($portfolioItems as $item)
                    <div class="group relative overflow-hidden rounded-lg shadow-lg aspect-square">
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="lazy" decoding="async"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300">
                            <div
                                class="absolute bottom-6 left-6 text-white translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                <h3 class="text-xl font-bold mb-1">{{ $item->title }}</h3>
                                <p class="text-amber-400 text-sm font-semibold tracking-wider uppercase">
                                    {{ $item->category->name ?? 'Photography' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20 bg-white rounded-xl border-2 border-dashed border-gray-200">
                        <p class="text-gray-500">Portofolio terbaru belum tersedia.</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-16 font-semibold">
                <a href="{{ route('portfolio.index') }}"
                    class="group inline-flex items-center text-amber-600 text-lg hover:text-amber-700 transition-colors">
                    Lihat Semua Karya
                    <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Latest From Blog -->
    @if($latestBlogPosts->count() > 0)
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-serif font-bold text-gray-900 mb-4">Artikel Terbaru</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Inspirasi dan tips seputar dunia fotografi</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($latestBlogPosts as $post)
                        <article
                            class="group relative bg-white border border-gray-100 rounded-2xl p-4 hover:shadow-2xl transition-all duration-300">
                            <div class="relative h-48 mb-6 overflow-hidden rounded-xl">
                                <img src="{{ $post->image_url }}" alt="{{ $post->title }}" loading="lazy" decoding="async"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            </div>
                            <div class="px-2">
                                <div class="text-xs font-bold text-amber-600 uppercase tracking-widest mb-3">
                                    {{ $post->tags[0] ?? 'Inspiration' }}
                                </div>
                                <h3
                                    class="text-xl font-bold text-gray-900 mb-4 line-clamp-2 h-14 group-hover:text-amber-600 transition-colors">
                                    {{ $post->title }}
                                </h3>
                                <a href="{{ route('blog.show', $post->slug) }}"
                                    class="text-sm font-bold text-gray-400 group-hover:text-amber-600 transition-colors uppercase tracking-widest">
                                    Baca Artikel &rarr;
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- CTA Section -->
    <section class="py-20 bg-amber-600 relative overflow-hidden">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-white mb-6">Siap Mengabadikan Momen Anda?</h2>
            <p class="text-xl md:text-2xl text-amber-100 mb-10">Mari ciptakan kenangan indah bersama. Pesan sesi Anda
                hari ini!</p>
            <a href="{{ route('booking.index') }}"
                class="bg-white text-amber-600 px-10 py-4 rounded-xl font-bold text-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                Pesan Sesi Sekarang
            </a>
        </div>
    </section>
@endsection