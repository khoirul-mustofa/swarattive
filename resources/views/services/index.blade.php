@extends('layouts.app')

@section('title', 'Layanan Kami - Swarattive Photography')
@section('description', 'Jelajahi berbagai paket layanan fotografi profesional yang ditawarkan oleh Swarattive Photography.')

@section('content')
<!-- Hero Section -->
<section class="relative h-[60vh] bg-cover bg-center" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1554046920-90dc2c6b12a8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');">
    <div class="absolute inset-0 flex items-center justify-center">
        <div class="text-center text-white px-4">
            <h1 class="text-5xl md:text-6xl font-serif font-bold mb-4 animate-fade-in">
                Layanan <span class="text-amber-400">Kami</span>
            </h1>
            <p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto animate-slide-up text-gray-200">
                Pilih paket dan layanan terbaik yang kami miliki untuk menyempurnakan hari istimewa Anda. Kepuasan Anda adalah representasi karya kami.
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

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($categoryServices as $service)
                                <div class="bg-white rounded-2xl shadow-sm border border-[#ede8e3] overflow-hidden flex flex-col transition-all hover:shadow-lg group">
                                    <div class="relative h-64 overflow-hidden">
                                        <img src="{{ $service->image_url ? asset('storage/' . $service->image_url) : 'https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&w=800&q=80' }}" alt="{{ $service->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-4 py-1.5 rounded-full text-xs font-bold text-[#3d2b1f] shadow-sm">
                                            {{ $service->duration_minutes }} Menit
                                        </div>
                                    </div>
                                    
                                    <div class="p-6 flex-1 flex flex-col">
                                        <h3 class="text-xl font-bold text-[#3d2b1f] mb-2">{{ $service->name }}</h3>
                                        <p class="text-sm text-[#7a6b5d] mb-4 flex-1 line-clamp-3">{{ $service->description }}</p>
                                        
                                        <div class="mb-6">
                                            <div class="text-xs text-[#9a8b7d] uppercase tracking-wider font-semibold mb-1">Harga Dasar Mulai</div>
                                            <div class="text-2xl font-bold text-amber-600">Rp {{ number_format($service->base_price, 0, ',', '.') }}</div>
                                        </div>

                                        @if($service->packages->count() > 0)
                                            <div class="border-t border-dashed border-[#e8ddd2] pt-4 mt-auto">
                                                <h4 class="text-sm font-semibold text-[#3d2b1f] mb-3 flex items-center">
                                                    <svg class="w-4 h-4 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                                                    Pilihan Paket
                                                </h4>
                                                <div class="space-y-3">
                                                    @foreach($service->packages as $package)
                                                        <div class="text-sm p-3 bg-[#fcfaf8] border border-[#e8ddd2] rounded-lg">
                                                            <div class="flex justify-between items-start font-bold text-[#3d2b1f]">
                                                                <span>{{ $package->name }}</span>
                                                                <span>Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                                                            </div>
                                                            <p class="text-xs text-[#7a6b5d] mt-1">{{ $package->description }}</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
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
@if($teamMembers->count() > 0)
<section class="py-20 bg-white border-t border-[#ede8e3]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-serif font-bold text-[#3d2b1f] mb-4">Tim Profesional Kami</h2>
            <p class="text-lg text-[#7a6b5d] max-w-2xl mx-auto">Percayakan momen berharga Anda di tangan-tangan kreatif spesialis kami</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            @foreach($teamMembers as $member)
                <div class="text-center group">
                    <div class="relative w-40 h-40 mx-auto mb-6 rounded-full overflow-hidden border-4 border-[#faf7f4] shadow-md">
                        <img src="{{ $member->image_url ? asset('storage/' . $member->image_url) : 'https://ui-avatars.com/api/?name=' . urlencode($member->name) . '&size=200&background=f0c27f&color=3d2b1f' }}" alt="{{ $member->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <h3 class="text-xl font-bold text-[#3d2b1f] mb-1">{{ $member->name }}</h3>
                    <p class="text-sm font-semibold text-amber-600 mb-3">{{ $member->role }}</p>
                    @if($member->bio)
                        <p class="text-xs text-[#7a6b5d]">{{ $member->bio }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

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
