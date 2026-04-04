@extends('layouts.app')

@section('title', 'Connect with Swarattive — Professional Photography')

@section('description', 'Hubungi tim kreatif Swarattive Photography untuk konsultasi layanan fotografi profesional.')

@section('content')
    <section class="relative bg-neutral-900 pt-32 pb-48 md:pt-48 md:pb-72 overflow-hidden">
        <div class="absolute inset-0 opacity-[0.03]">
            <div class="absolute top-0 left-0 w-full h-full"
                style="background-image: radial-gradient(#ffffff 1.5px, transparent 1.5px); background-size: 32px 32px;">
            </div>
        </div>

        <div
            class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[300px] md:w-[600px] h-[300px] bg-amber-500/20 blur-[100px] rounded-full pointer-events-none">
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-serif font-bold text-white mb-6 tracking-tight" x-data
                x-intersect="$el.classList.add('animate-slide-up')">
                Mari <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-amber-600 italic pr-2">Berkarya</span>
                Bersama
            </h1>
            <p class="text-neutral-400 text-lg md:text-2xl font-light max-w-2xl mx-auto italic leading-relaxed" x-data
                x-intersect="$el.classList.add('animate-slide-up')" style="animation-delay: 200ms;">
                "Kami percaya setiap bingkai punya cerita. Ceritakan milik Anda."
            </p>
        </div>
    </section>

    <section class="relative z-20 -mt-24 md:-mt-40 lg:-mt-48 pb-20 md:pb-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-[2rem] md:rounded-[3rem] shadow-[0_30px_60px_-15px_rgba(0,0,0,0.1)] overflow-hidden border border-neutral-100 flex flex-col lg:flex-row"
                x-data x-intersect="$el.classList.add('animate-fade-in')">

                <div class="w-full lg:w-3/5 p-8 sm:p-12 lg:p-20">
                    <div class="mb-10 lg:mb-12">
                        <h2 class="text-3xl lg:text-4xl font-serif font-bold text-neutral-900 mb-4">Kirim Pesan</h2>
                        <div class="w-16 h-1.5 bg-amber-500 rounded-full"></div>
                    </div>

                    <form id="contactForm" method="POST" action="{{ route('contact.store') }}" class="space-y-8"
                        x-data="{ loading: false }" @submit="loading = true">
                        @csrf
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label
                                        class="block text-[11px] font-bold uppercase tracking-widest text-neutral-500 mb-2 ml-1">Nama
                                        Lengkap</label>
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" required
                                        class="w-full px-5 py-4 bg-neutral-50/50 border {{ $errors->has('name') ? 'border-red-500' : 'border-neutral-200' }} rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-300 outline-none text-neutral-900 placeholder:text-neutral-300">
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label
                                        class="block text-[11px] font-bold uppercase tracking-widest text-neutral-500 mb-2 ml-1">Alamat
                                        Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        placeholder="john@example.com" required
                                        class="w-full px-5 py-4 bg-neutral-50/50 border {{ $errors->has('email') ? 'border-red-500' : 'border-neutral-200' }} rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-300 outline-none text-neutral-900 placeholder:text-neutral-300">
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label
                                    class="block text-[11px] font-bold uppercase tracking-widest text-neutral-500 mb-2 ml-1">Tertarik
                                    Pada</label>
                                <div class="relative">
                                    <select name="interest"
                                        class="w-full px-5 py-4 bg-neutral-50/50 border {{ $errors->has('interest') ? 'border-red-500' : 'border-neutral-200' }} rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-300 outline-none text-neutral-900 appearance-none cursor-pointer">
                                        <option value="Wedding & Engagement" {{ old('interest') == 'Wedding & Engagement' ? 'selected' : '' }}>Pernikahan & Tunangan</option>
                                        <option value="Portrait & Lifestyle" {{ old('interest') == 'Portrait & Lifestyle' ? 'selected' : '' }}>Potret & Gaya Hidup</option>
                                        <option value="Commercial & Branding" {{ old('interest') == 'Commercial & Branding' ? 'selected' : '' }}>Komersial & Branding</option>
                                        <option value="Other Projects" {{ old('interest') == 'Other Projects' ? 'selected' : '' }}>Proyek Lainnya</option>
                                    </select>
                                    @error('interest')
                                        <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                                    @enderror
                                    <div
                                        class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-amber-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label
                                    class="block text-[11px] font-bold uppercase tracking-widest text-neutral-500 mb-2 ml-1">Pesan</label>
                                <textarea name="message" rows="4" placeholder="Ceritakan ide atau keinginan Anda..." required
                                    class="w-full px-5 py-4 bg-neutral-50/50 border {{ $errors->has('message') ? 'border-red-500' : 'border-neutral-200' }} rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 transition-all duration-300 outline-none text-neutral-900 resize-none placeholder:text-neutral-300">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" :disabled="loading"
                            class="group relative w-full sm:w-auto px-10 py-4 bg-neutral-900 text-white rounded-full font-bold tracking-widest uppercase text-[11px] overflow-hidden transition-all hover:pr-14 active:scale-[0.98] shadow-lg hover:shadow-neutral-900/30 inline-flex items-center justify-center disabled:opacity-70 disabled:cursor-not-allowed">
                            <span class="relative z-10 transition-transform"
                                x-text="loading ? 'Mengirim...' : 'Kirim Pesan Sekarang'">Kirim Pesan Sekarang</span>
                            <div class="absolute inset-0 bg-amber-500 scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-500 -z-0"
                                :class="loading ? 'scale-x-100' : ''">
                            </div>
                            <svg x-show="!loading"
                                class="absolute right-5 w-4 h-4 text-white opacity-0 group-hover:opacity-100 transition-all duration-500 translate-x-2 group-hover:translate-x-0"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                            <svg x-show="loading" class="animate-spin absolute right-5 h-4 w-4 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </button>
                    </form>
                </div>

                <div
                    class="w-full lg:w-2/5 bg-neutral-900 relative overflow-hidden p-8 sm:p-12 lg:p-20 flex flex-col justify-between">
                    <div class="absolute inset-0 opacity-[0.05] pointer-events-none"
                        style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 24px 24px;">
                    </div>

                    <div class="relative z-10">
                        <div class="mb-12 lg:mb-16">
                            <h2 class="text-3xl font-serif font-bold text-white mb-4">
                                {{ $settings->office_name ?? 'Office Space' }}
                            </h2>
                            <div class="w-16 h-1.5 bg-amber-500 rounded-full"></div>
                        </div>

                        <div class="space-y-10 lg:space-y-12">
                            <div class="flex gap-5">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-amber-400 shrink-0 shadow-inner">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white text-xs mb-1.5 uppercase tracking-widest">Lokasi Kami</h4>
                                    <p class="text-neutral-400 font-light leading-relaxed text-sm">
                                        {!! nl2br(e($settings->address ?? "Jakarta SCBD Area,\nSudirman St. 123\nMetropolitan District, ID 12190")) !!}
                                    </p>
                                </div>
                            </div>

                            <div class="flex gap-5">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-amber-400 shrink-0 shadow-inner">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-white text-xs mb-1.5 uppercase tracking-widest">Pertanyaan Email
                                    </h4>
                                    <p
                                        class="text-neutral-400 font-light leading-relaxed text-sm hover:text-amber-400 transition-colors cursor-pointer">
                                        {{ $settings->email ?? 'hello@swarattive.com' }}</p>
                                    <p class="text-neutral-400 font-light leading-relaxed text-sm">
                                        {{ $settings->phone ?? '+62 812 3456 7890' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-24 md:mb-32">
        <div class="h-64 md:h-[400px] rounded-[2rem] md:rounded-[3rem] overflow-hidden relative shadow-2xl group">

            <!-- Google Maps Embed -->
            <iframe src="https://www.google.com/maps?q={{ str_replace(' ', '', $settings->map_coordinates ?? '-2.6219595688745705,101.35777227479358') }}&hl=id&z=14&output=embed"
                class="w-full h-full border-0 grayscale group-hover:grayscale-0 transition-all duration-[1.5s]">
            </iframe>

            <!-- Overlay -->
            <div
                class="absolute inset-0 bg-neutral-900/40 group-hover:bg-neutral-900/10 transition-colors duration-1000 pointer-events-none">
            </div>

            <!-- Button -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                <a href="https://www.google.com/maps?q={{ str_replace(' ', '', $settings->map_coordinates ?? '-2.6219595688745705,101.35777227479358') }}" target="_blank"
                    class="px-8 py-4 bg-white/90 backdrop-blur-sm text-neutral-900 text-[11px] font-black uppercase tracking-widest rounded-full shadow-2xl hover:bg-amber-500 hover:text-white transition-all duration-300 transform hover:-translate-y-1 inline-block">
                    Buka di Maps
                </a>
            </div>

        </div>
    </section>

    <div x-data="{ show: @json(session('success') ? true : false) }" x-init="if (show) setTimeout(() => show = false, 5000)"
        x-show="show" x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-10"
        class="fixed bottom-8 left-1/2 -translate-x-1/2 z-[100] bg-neutral-900/90 backdrop-blur-md text-white px-8 py-4 rounded-full shadow-2xl flex items-center gap-4 border border-white/10"
        style="display: none;">
        <div class="bg-amber-500 text-neutral-900 rounded-full p-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <span class="font-bold tracking-widest uppercase text-[11px]">Pesan Terkirim. Kami akan segera menghubungi Anda!</span>
    </div>
@endsection

@push('scripts')
    <style>
        @keyframes slide-up {
            from {
                transform: translateY(40px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-slide-up {
            opacity: 0;
            /* Hindari FOUC (Flash of Unstyled Content) sebelum animasi berjalan */
            animation: slide-up 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .animate-fade-in {
            opacity: 0;
            animation: fade-in 1.2s ease-out forwards;
        }
    </style>
@endpush