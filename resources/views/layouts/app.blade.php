<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Swarattive Photography')</title>
    <meta name="description"
        content="@yield('description', 'Professional photography services for your special moments')">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <script>
        // Inisialisasi tema sebelum render untuk mencegah FOUC
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="bg-gray-50 dark:bg-neutral-900 transition-colors duration-500 text-gray-900 dark:text-gray-100">
    <!-- Navigation -->
    <nav x-data="{ 
            open: false, 
            scrolled: false,
            theme: localStorage.theme || 'system',
            setTheme(val) {
                this.theme = val;
                if (val === 'system') {
                    localStorage.removeItem('theme');
                    if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                } else {
                    localStorage.theme = val;
                    if (val === 'dark') {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                }
            }
        }" 
        @scroll.window="scrolled = (window.pageYOffset > 20)"
        @click.outside="open = false" 
        :class="{ 'bg-white dark:bg-neutral-900 shadow-xl py-0': scrolled || open, 'bg-transparent py-2': !scrolled && !open }"
        class="fixed w-full top-0 z-50 transition-all duration-500 ease-in-out">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 transition-all duration-500" :class="scrolled || open ? 'h-16' : 'h-20'">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                        <span class="text-2xl font-bold transition-colors duration-500" 
                            :class="scrolled || open ? 'text-amber-600' : 'text-white'">Swarattive</span>
                    </a>
                </div>

                {{-- Desktop Navigation (Layar Lebar) --}}
                <div class="hidden lg:flex items-center space-x-8">
                    @php
                        $navLinks = [
                            ['route' => 'home', 'label' => 'Beranda', 'activePattern' => 'home'],
                            ['route' => 'portfolio.index', 'label' => 'Karya', 'activePattern' => 'portfolio.*'],
                            ['route' => 'services.index', 'label' => 'Layanan', 'activePattern' => 'services.*'],
                            ['route' => 'about.index', 'label' => 'Tentang', 'activePattern' => 'about.*'],
                            ['route' => 'blog.index', 'label' => 'Artikel', 'activePattern' => 'blog.*'],
                            ['route' => 'contact.index', 'label' => 'Kontak', 'activePattern' => 'contact.*'],
                            ['route' => 'booking.check', 'label' => 'Cek Pesanan', 'activePattern' => 'booking.check'],
                        ];
                    @endphp

                    @foreach($navLinks as $link)
                        <a href="{{ route($link['route']) }}" wire:navigate
                            class="transition-all duration-300 py-1 border-b-2"
                            :class="{ 
                                '{{ request()->routeIs($link['activePattern']) ? 'text-amber-600 border-amber-600 font-semibold' : 'text-gray-700 border-transparent' }} hover:text-amber-600': scrolled || open,
                                '{{ request()->routeIs($link['activePattern']) ? 'text-white border-white font-semibold' : 'text-white/80 border-transparent' }} hover:text-white': !scrolled && !open 
                            }">
                            {{ $link['label'] }}
                        </a>
                    @endforeach

                    <a href="{{ route('booking.index') }}" wire:navigate
                        class="bg-amber-600 text-white px-6 py-2.5 rounded-full font-bold tracking-wider uppercase text-[10px] hover:bg-amber-700 transition-all shadow-lg hover:shadow-amber-600/20 active:scale-95 {{ request()->routeIs('booking.*') ? 'ring-2 ring-amber-600 ring-offset-2' : '' }}">
                        Pemesanan
                    </a>

                    {{-- Theme Toggle Desktop --}}
                    <div class="relative ml-2" x-data="{ showThemeMenu: false }">
                        <button @click="showThemeMenu = !showThemeMenu" 
                            class="p-2 rounded-full transition-colors duration-300"
                            :class="scrolled || open ? 'hover:bg-gray-100 text-gray-700 dark:text-gray-300 dark:hover:bg-neutral-800' : 'hover:bg-white/10 text-white'">
                            <svg x-show="theme === 'light'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"></path></svg>
                            <svg x-show="theme === 'dark'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                            <svg x-show="theme === 'system'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </button>
                        <div x-show="showThemeMenu" @click.outside="showThemeMenu = false" 
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            class="absolute right-0 mt-2 w-32 bg-white dark:bg-neutral-800 rounded-xl shadow-2xl py-2 border border-gray-100 dark:border-neutral-700 z-50">
                            <button @click="setTheme('light'); showThemeMenu = false" class="w-full text-left px-4 py-2 text-xs font-semibold hover:bg-amber-50 dark:hover:bg-amber-900/20 transition-colors flex items-center gap-2" :class="theme === 'light' ? 'text-amber-600' : 'text-gray-700 dark:text-gray-300'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"></path></svg>
                                Light
                            </button>
                            <button @click="setTheme('dark'); showThemeMenu = false" class="w-full text-left px-4 py-2 text-xs font-semibold hover:bg-amber-50 dark:hover:bg-amber-900/20 transition-colors flex items-center gap-2" :class="theme === 'dark' ? 'text-amber-600' : 'text-gray-700 dark:text-gray-300'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                                Dark
                            </button>
                            <button @click="setTheme('system'); showThemeMenu = false" class="w-full text-left px-4 py-2 text-xs font-semibold hover:bg-amber-50 dark:hover:bg-amber-900/20 transition-colors flex items-center gap-2" :class="theme === 'system' ? 'text-amber-600' : 'text-gray-700 dark:text-gray-300'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                System
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Tablet Navigation (Hanya Menu Penting) --}}
                <div class="hidden md:flex lg:hidden items-center space-x-6">
                    <a href="{{ route('home') }}" wire:navigate
                        class="transition-all duration-300 text-sm font-medium"
                        :class="scrolled || open ? 'text-gray-700' : 'text-white'">Beranda</a>
                    <a href="{{ route('services.index') }}" wire:navigate
                        class="transition-all duration-300 text-sm font-medium"
                        :class="scrolled || open ? 'text-gray-700' : 'text-white'">Layanan</a>
                    <a href="{{ route('booking.index') }}" wire:navigate
                        class="bg-amber-600 text-white px-4 py-2 rounded-full hover:bg-amber-700 transition-colors text-xs font-bold uppercase tracking-widest">
                        Pemesanan
                    </a>
                </div>

                <div class="lg:hidden">
                    <button @click="open = !open" class="p-2 transition-colors duration-300" 
                        :class="scrolled || open ? 'text-gray-700' : 'text-white'">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-show="open" x-transition class="lg:hidden bg-white dark:bg-neutral-900 border-t dark:border-neutral-800 transition-colors duration-500">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" wire:navigate
                    class="block px-3 py-2 {{ request()->routeIs('home') ? 'text-amber-600 dark:text-amber-500 bg-amber-50 dark:bg-amber-900/20 font-bold' : 'text-gray-700 dark:text-gray-300' }} hover:text-amber-600 dark:hover:text-amber-500 rounded-lg transition-colors">Beranda</a>
                <a href="{{ route('portfolio.index') }}" wire:navigate
                    class="block px-3 py-2 {{ request()->routeIs('portfolio.*') ? 'text-amber-600 dark:text-amber-500 bg-amber-50 dark:bg-amber-900/20 font-bold' : 'text-gray-700 dark:text-gray-300' }} hover:text-amber-600 dark:hover:text-amber-500 rounded-lg transition-colors">Karya</a>
                <a href="{{ route('services.index') }}" wire:navigate
                    class="block px-3 py-2 {{ request()->routeIs('services.*') ? 'text-amber-600 dark:text-amber-500 bg-amber-50 dark:bg-amber-900/20 font-bold' : 'text-gray-700 dark:text-gray-300' }} hover:text-amber-600 dark:hover:text-amber-500 rounded-lg transition-colors">Layanan</a>
                <a href="{{ route('about.index') }}" wire:navigate
                    class="block px-3 py-2 {{ request()->routeIs('about.*') ? 'text-amber-600 dark:text-amber-500 bg-amber-50 dark:bg-amber-900/20 font-bold' : 'text-gray-700 dark:text-gray-300' }} hover:text-amber-600 dark:hover:text-amber-500 rounded-lg transition-colors">Tentang</a>
                <a href="{{ route('blog.index') }}" wire:navigate
                    class="block px-3 py-2 {{ request()->routeIs('blog.*') ? 'text-amber-600 dark:text-amber-500 bg-amber-50 dark:bg-amber-900/20 font-bold' : 'text-gray-700 dark:text-gray-300' }} hover:text-amber-600 dark:hover:text-amber-500 rounded-lg transition-colors">Artikel</a>
                <a href="{{ route('contact.index') }}" wire:navigate
                    class="block px-3 py-2 {{ request()->routeIs('contact.*') ? 'text-amber-600 dark:text-amber-500 bg-amber-50 dark:bg-amber-900/20 font-bold' : 'text-gray-700 dark:text-gray-300' }} hover:text-amber-600 dark:hover:text-amber-500 rounded-lg transition-colors">Kontak</a>
                <a href="{{ route('booking.check') }}" wire:navigate
                    class="block px-3 py-2 {{ request()->routeIs('booking.check') ? 'text-amber-600 dark:text-amber-500 bg-amber-50 dark:bg-amber-900/20 font-bold' : 'text-gray-700 dark:text-gray-300' }} hover:text-amber-600 dark:hover:text-amber-500 rounded-lg transition-colors">Cek
                    Pesanan</a>
                <a href="{{ route('booking.index') }}" wire:navigate
                    class="block px-3 py-2 {{ request()->routeIs('booking.*') ? 'bg-amber-600 text-white' : 'bg-amber-500 text-white' }} rounded-lg font-bold text-center">Pemesanan</a>
                
                <div class="pt-4 pb-2 border-t border-gray-100 dark:border-neutral-800">
                    <p class="px-3 text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Pilih Tema</p>
                    <div class="flex items-center gap-2 px-3">
                        <button @click="setTheme('light')" class="flex-1 flex flex-col items-center gap-1 p-2 rounded-xl transition-all" :class="theme === 'light' ? 'bg-amber-600 text-white' : 'bg-gray-50 text-gray-700 dark:bg-neutral-800 dark:text-gray-300'">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"></path></svg>
                            <span class="text-[8px] font-bold uppercase tracking-widest">Terang</span>
                        </button>
                        <button @click="setTheme('dark')" class="flex-1 flex flex-col items-center gap-1 p-2 rounded-xl transition-all" :class="theme === 'dark' ? 'bg-amber-600 text-white' : 'bg-gray-50 text-gray-700 dark:bg-neutral-800 dark:text-gray-300'">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                            <span class="text-[8px] font-bold uppercase tracking-widest">Gelap</span>
                        </button>
                        <button @click="setTheme('system')" class="flex-1 flex flex-col items-center gap-1 p-2 rounded-xl transition-all" :class="theme === 'system' ? 'bg-amber-600 text-white' : 'bg-gray-50 text-gray-700 dark:bg-neutral-800 dark:text-gray-300'">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span class="text-[8px] font-bold uppercase tracking-widest">Sistem</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#3d2b1f] dark:bg-black text-white transition-colors duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 text-amber-400">{{ config('app.name', 'Laravel') }}</h3>
                    <p class="text-gray-300">{{ $footerSettings['description'] }}</p>
                </div>


                <div>
                    <h4 class="text-lg font-semibold mb-4">Layanan</h4>
                    <ul class="space-y-2 text-gray-300">
                        @foreach($footerSettings['categories'] as $cat)
                            <li><a href="{{ route('services.index') }}#{{ $cat->slug }}" wire:navigate
                                    class="hover:text-amber-400">{{ $cat->name }}</a></li>
                        @endforeach
                    </ul>
                </div>


                <div>
                    <h4 class="text-lg font-semibold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="{{ route('portfolio.index') }}" wire:navigate
                                class="hover:text-amber-400">Karya</a></li>
                        <li><a href="{{ route('about.index') }}" wire:navigate class="hover:text-amber-400">Tentang
                                Kami</a></li>
                        <li><a href="{{ route('blog.index') }}" wire:navigate class="hover:text-amber-400">Artikel</a>
                        </li>
                        <li><a href="{{ route('booking.index') }}" wire:navigate
                                class="hover:text-amber-400">Pemesanan</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li>{{ $footerSettings['phone'] }}</li>
                        <li>{{ $footerSettings['email'] }}</li>
                        <li>{!! nl2br(e($footerSettings['address'])) !!}</li>
                    </ul>
                </div>

            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} SWARATTIVE Photography. Hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>