@extends('layouts.app')

@section('title', 'Welcome to Swarattive Photography')
@section('description', 'Professional photography services for your special moments')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-screen bg-cover bg-center"
        style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');">
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center text-white px-4">
                <h1 class="text-5xl md:text-7xl font-serif font-bold mb-6 animate-fade-in">
                    Welcome to<br>
                    <span class="text-amber-400">Swarattive</span><br>
                    Photography
                </h1>
                <p class="text-xl md:text-2xl mb-8 max-w-2xl mx-auto animate-slide-up">
                    Mengabadikan momen terindah dalam hidup Anda dengan sentuhan seni dan keindahan abadi.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center animate-slide-up">
                    <a href="{{ route('portfolio.index') }}"
                        class="bg-amber-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-amber-700 transition-colors">
                        View Portfolio
                    </a>
                    <a href="{{ route('booking.index') }}"
                        class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-gray-900 transition-colors">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Preview -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-serif font-bold text-gray-900 mb-4">Our Services</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Professional photography services tailored to your needs
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                    $serviceIcons = [
                        'Wedding Photography' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z',
                        'Pre-Wedding' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                        'Portrait' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                        'Commercial' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'
                    ];
                @endphp

                @forelse($services as $service)
                    @php
                        $icon = 'M12 4v16m8-8H4'; // default
                        if (Str::contains($service->name, ['Wedding', 'Menikah'], true)) {
                            $icon = $serviceIcons['Wedding Photography'];
                        } elseif (Str::contains($service->name, ['Pre-Wedding', 'Prewedding'], true)) {
                            $icon = $serviceIcons['Pre-Wedding'];
                        } elseif (Str::contains($service->name, ['Portrait', 'Wajah'], true)) {
                            $icon = $serviceIcons['Portrait'];
                        } elseif (Str::contains($service->name, ['Commercial', 'Produk'], true)) {
                            $icon = $serviceIcons['Commercial'];
                        }
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
                <h2 class="text-4xl font-serif font-bold text-gray-900 mb-4">Recent Work</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Explore our latest photography projects</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($portfolioItems as $item)
                    <div class="group relative overflow-hidden rounded-lg shadow-lg aspect-square">
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300">
                            <div
                                class="absolute bottom-6 left-6 text-white translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                <h3 class="text-xl font-bold mb-1">{{ $item->title }}</h3>
                                <p class="text-amber-400 text-sm font-semibold tracking-wider uppercase">
                                    {{ $item->category->name ?? 'Photography' }}</p>
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
                    View Full Portfolio
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
                    <h2 class="text-4xl font-serif font-bold text-gray-900 mb-4">Latest Stories</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Inspirasi dan tips seputar dunia fotografi</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($latestBlogPosts as $post)
                        <article
                            class="group relative bg-white border border-gray-100 rounded-2xl p-4 hover:shadow-2xl transition-all duration-300">
                            <div class="relative h-48 mb-6 overflow-hidden rounded-xl">
                                <img src="{{ $post->image_url }}" alt="{{ $post->title }}"
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
                                    Read Story &rarr;
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
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-white mb-6">Ready to Capture Your Moments?</h2>
            <p class="text-xl md:text-2xl text-amber-100 mb-10">Let's create beautiful memories together. Book your session
                today!</p>
            <a href="{{ route('booking.index') }}"
                class="bg-white text-amber-600 px-10 py-4 rounded-xl font-bold text-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                Book Your Session Now
            </a>
        </div>
    </section>
@endsection