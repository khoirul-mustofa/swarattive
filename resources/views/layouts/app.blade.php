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
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
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
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-amber-600 transition-colors">Home</a>
                    <a href="{{ route('portfolio.index') }}"
                        class="text-gray-700 hover:text-amber-600 transition-colors">Portfolio</a>
                    <a href="{{ route('services.index') }}"
                        class="text-gray-700 hover:text-amber-600 transition-colors">Services</a>
                    <a href="{{ route('about.index') }}"
                        class="text-gray-700 hover:text-amber-600 transition-colors">About</a>
                    <a href="{{ route('blog.index') }}"
                        class="text-gray-700 hover:text-amber-600 transition-colors">Blog</a>
                    <a href="{{ route('contact.index') }}"
                        class="text-gray-700 hover:text-amber-600 transition-colors">Contact</a>
                    <a href="{{ route('booking.index') }}"
                        class="bg-amber-600 text-white px-4 py-2 rounded-lg hover:bg-amber-700 transition-colors">
                        Booking
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
                <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-700 hover:text-amber-600">Home</a>
                <a href="{{ route('portfolio.index') }}"
                    class="block px-3 py-2 text-gray-700 hover:text-amber-600">Portfolio</a>
                <a href="{{ route('services.index') }}"
                    class="block px-3 py-2 text-gray-700 hover:text-amber-600">Services</a>
                <a href="{{ route('about.index') }}"
                    class="block px-3 py-2 text-gray-700 hover:text-amber-600">About</a>
                <a href="{{ route('blog.index') }}" class="block px-3 py-2 text-gray-700 hover:text-amber-600">Blog</a>
                <a href="{{ route('contact.index') }}"
                    class="block px-3 py-2 text-gray-700 hover:text-amber-600">Contact</a>
                <a href="{{ route('booking.index') }}"
                    class="block px-3 py-2 bg-amber-600 text-white rounded-lg">Booking</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 text-amber-400">Swarattive</h3>
                    <p class="text-gray-300">Professional photography services for your special moments.</p>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Services</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="{{ route('services.index') }}" class="hover:text-amber-400">Wedding Photography</a>
                        </li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-amber-400">Pre-Wedding</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-amber-400">Portrait</a></li>
                        <li><a href="{{ route('services.index') }}" class="hover:text-amber-400">Commercial</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="{{ route('portfolio.index') }}" class="hover:text-amber-400">Portfolio</a></li>
                        <li><a href="{{ route('about.index') }}" class="hover:text-amber-400">About Us</a></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-amber-400">Blog</a></li>
                        <li><a href="{{ route('booking.index') }}" class="hover:text-amber-400">Booking</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li>+62 812 3456 7890</li>
                        <li>hello@swarattive.com</li>
                        <li>Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} SWARATTIVE Photography. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>