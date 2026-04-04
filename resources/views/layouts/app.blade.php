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
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav x-data="{ open: false }" class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <span class="text-2xl font-bold text-amber-600">Swarattive</span>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}"
                        class="{{ request()->routeIs('home') ? 'text-amber-600 font-semibold border-b-2 border-amber-600' : 'text-gray-700' }} hover:text-amber-600 transition-all py-1">Beranda</a>
                    <a href="{{ route('portfolio.index') }}"
                        class="{{ request()->routeIs('portfolio.*') ? 'text-amber-600 font-semibold border-b-2 border-amber-600' : 'text-gray-700' }} hover:text-amber-600 transition-all py-1">Karya</a>
                    <a href="{{ route('services.index') }}"
                        class="{{ request()->routeIs('services.*') ? 'text-amber-600 font-semibold border-b-2 border-amber-600' : 'text-gray-700' }} hover:text-amber-600 transition-all py-1">Layanan</a>
                    <a href="{{ route('about.index') }}"
                        class="{{ request()->routeIs('about.*') ? 'text-amber-600 font-semibold border-b-2 border-amber-600' : 'text-gray-700' }} hover:text-amber-600 transition-all py-1">Tentang</a>
                    <a href="{{ route('blog.index') }}"
                        class="{{ request()->routeIs('blog.*') ? 'text-amber-600 font-semibold border-b-2 border-amber-600' : 'text-gray-700' }} hover:text-amber-600 transition-all py-1">Artikel</a>
                    <a href="{{ route('contact.index') }}"
                        class="{{ request()->routeIs('contact.*') ? 'text-amber-600 font-semibold border-b-2 border-amber-600' : 'text-gray-700' }} hover:text-amber-600 transition-all py-1">Kontak</a>
                    <a href="{{ route('booking.index') }}"
                        class="bg-amber-600 text-white px-4 py-2 rounded-lg hover:bg-amber-700 transition-colors {{ request()->routeIs('booking.*') ? 'ring-2 ring-amber-600 ring-offset-2' : '' }}">
                        Pemesanan
                    </a>
                </div>

                <div class="md:hidden">
                    <button @click="open = !open" class="text-gray-700 hover:text-amber-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-show="open" x-transition class="md:hidden bg-white border-t">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}"
                    class="block px-3 py-2 {{ request()->routeIs('home') ? 'text-amber-600 bg-amber-50 font-bold' : 'text-gray-700' }} hover:text-amber-600 rounded-lg">Beranda</a>
                <a href="{{ route('portfolio.index') }}"
                    class="block px-3 py-2 {{ request()->routeIs('portfolio.*') ? 'text-amber-600 bg-amber-50 font-bold' : 'text-gray-700' }} hover:text-amber-600 rounded-lg">Karya</a>
                <a href="{{ route('services.index') }}"
                    class="block px-3 py-2 {{ request()->routeIs('services.*') ? 'text-amber-600 bg-amber-50 font-bold' : 'text-gray-700' }} hover:text-amber-600 rounded-lg">Layanan</a>
                <a href="{{ route('about.index') }}"
                    class="block px-3 py-2 {{ request()->routeIs('about.*') ? 'text-amber-600 bg-amber-50 font-bold' : 'text-gray-700' }} hover:text-amber-600 rounded-lg">Tentang</a>
                <a href="{{ route('blog.index') }}"
                    class="block px-3 py-2 {{ request()->routeIs('blog.*') ? 'text-amber-600 bg-amber-50 font-bold' : 'text-gray-700' }} hover:text-amber-600 rounded-lg">Artikel</a>
                <a href="{{ route('contact.index') }}"
                    class="block px-3 py-2 {{ request()->routeIs('contact.*') ? 'text-amber-600 bg-amber-50 font-bold' : 'text-gray-700' }} hover:text-amber-600 rounded-lg">Kontak</a>
                <a href="{{ route('booking.index') }}"
                    class="block px-3 py-2 {{ request()->routeIs('booking.*') ? 'bg-amber-600 text-white' : 'bg-amber-500 text-white' }} rounded-lg font-bold text-center">Pemesanan</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#3d2b1f] text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 text-amber-400">Swarattive</h3>
                    <p class="text-gray-300">Layanan fotografi profesional untuk setiap momen berharga Anda.</p>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Layanan</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="{{ route('services.index') }}" class="hover:text-amber-400">Fotografi Pernikahan</a>
                        </li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-amber-400">Pre-Wedding</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-amber-400">Potret</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-amber-400">Komersial</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="{{ route('portfolio.index') }}" class="hover:text-amber-400">Karya</a></li>
                        <li><a href="{{ route('about.index') }}" class="hover:text-amber-400">Tentang Kami</a></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-amber-400">Artikel</a></li>
                        <li><a href="{{ route('booking.index') }}" class="hover:text-amber-400">Pemesanan</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li>+62 812 3456 7890</li>
                        <li>hello@swarattive.com</li>
                        <li>Jakarta, Indonesia</li>
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