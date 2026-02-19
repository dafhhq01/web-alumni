<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Alumni System') }} - @yield('title', 'Home')</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        /* ============================================
           GRADIENT BLOBS - CSS MURNI
           ============================================ */

        /* Container utama untuk semua gradient blobs */
        .gradient-blobs-container {
            position: fixed;
            inset: 0;
            z-index: -1;
            pointer-events: none;
            overflow: hidden;
        }

        /* Base style untuk semua gradient blobs */
        .gradient-blob {
            position: absolute;
            border-radius: 50%;
            /* Radial gradient: dari #7391E7 (tengah) ke #FFFFFF (luar) */
            background: radial-gradient(circle at center,
                    #7391E7 0%,
                    rgba(115, 145, 231, 0.8) 30%,
                    rgba(115, 145, 231, 0.4) 60%,
                    rgba(255, 255, 255, 0) 100%);
            filter: blur(60px);
            opacity: 0.6;
        }

        /* Blob 1: Pojok kiri atas */
        .gradient-blob-1 {
            width: 600px;
            height: 600px;
            top: -200px;
            left: -200px;
        }

        /* Blob 2: Tengah kanan */
        .gradient-blob-2 {
            width: 500px;
            height: 500px;
            top: 30%;
            right: -150px;
        }

        /* Blob 3: Tengah kiri */
        .gradient-blob-3 {
            width: 400px;
            height: 400px;
            top: 60%;
            left: -100px;
        }

        /* Blob 4: Pojok kanan bawah (footer area) */
        .gradient-blob-4 {
            width: 700px;
            height: 700px;
            bottom: -250px;
            right: -200px;
        }

        /* Blob 5: Tengah halaman */
        .gradient-blob-5 {
            width: 300px;
            height: 300px;
            top: 45%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0.3;
        }

        /* ============================================
           RESPONSIVE GRADIENT BLOBS
           ============================================ */
        @media (max-width: 768px) {
            .gradient-blob-1 {
                width: 400px;
                height: 400px;
                top: -150px;
                left: -150px;
            }

            .gradient-blob-2 {
                width: 350px;
                height: 350px;
                right: -100px;
            }

            .gradient-blob-3 {
                width: 300px;
                height: 300px;
                left: -80px;
            }

            .gradient-blob-4 {
                width: 500px;
                height: 500px;
                bottom: -200px;
                right: -150px;
            }

            .gradient-blob-5 {
                width: 200px;
                height: 200px;
            }
        }

        @media (max-width: 480px) {
            .gradient-blob {
                filter: blur(40px);
                opacity: 0.4;
            }

            .gradient-blob-1 {
                width: 300px;
                height: 300px;
                top: -100px;
                left: -100px;
            }

            .gradient-blob-2 {
                width: 250px;
                height: 250px;
                right: -80px;
            }

            .gradient-blob-3 {
                width: 200px;
                height: 200px;
                left: -60px;
            }

            .gradient-blob-4 {
                width: 350px;
                height: 350px;
                bottom: -150px;
                right: -100px;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="antialiased" style="background-color: #E6EBFF;">

    <!-- ============================================
         GRADIENT BLOBS - 5 BUAH LINGKARAN GRADIENT
         ============================================ -->
    <div class="gradient-blobs-container">
        <div class="gradient-blob gradient-blob-1"></div>
        <div class="gradient-blob gradient-blob-2"></div>
        <div class="gradient-blob gradient-blob-3"></div>
        <div class="gradient-blob gradient-blob-4"></div>
        <div class="gradient-blob gradient-blob-5"></div>
    </div>

    <!-- Navigation Bar -->
    <nav class="sticky top-0 z-50" style="background-color: rgba(230, 235, 255, 0.85); backdrop-filter: blur(12px);" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <span class="text-2xl font-bold" style="color: #3851A5;">alumni</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex lg:items-center lg:space-x-6">
                    <a href="{{ route('home') }}"
                        class="px-4 py-2 text-sm font-semibold rounded-xl transition-all duration-300 
       {{ request()->routeIs('home') 
          ? 'text-blue-700 bg-white/50 shadow-sm ring-1 ring-white/20' 
          : 'text-gray-600 hover:text-blue-600 hover:bg-white/30' }}">
                        Home
                    </a>

                    <a href="{{ route('news.index') }}"
                        class="px-4 py-2 text-sm font-semibold rounded-xl transition-all duration-300 
       {{ request()->routeIs('news.*') 
          ? 'text-blue-700 bg-white/50 shadow-sm ring-1 ring-white/20' 
          : 'text-gray-600 hover:text-blue-600 hover:bg-white/30' }}">
                        News
                    </a>

                    <a href="{{ route('events.index') }}"
                        class="px-4 py-2 text-sm font-semibold rounded-xl transition-all duration-300 
       {{ request()->routeIs('events.*') 
          ? 'text-blue-700 bg-white/50 shadow-sm ring-1 ring-white/20' 
          : 'text-gray-600 hover:text-blue-600 hover:bg-white/30' }}">
                        Events
                    </a>

                    <a href="{{ route('gallery.index') }}"
                        class="px-4 py-2 text-sm font-semibold rounded-xl transition-all duration-300 
       {{ request()->routeIs('gallery.*') 
          ? 'text-blue-700 bg-white/50 shadow-sm ring-1 ring-white/20' 
          : 'text-gray-600 hover:text-blue-600 hover:bg-white/30' }}">
                        Gallery
                    </a>

                    <a href="{{ route('alumni.directory') }}"
                        class="px-4 py-2 text-sm font-semibold rounded-xl transition-all duration-300 
       {{ (request()->routeIs('alumni.directory') || request()->routeIs('alumni.show')) 
          ? 'text-blue-700 bg-white/50 shadow-sm ring-1 ring-white/20' 
          : 'text-gray-600 hover:text-blue-600 hover:bg-white/30' }}">
                        Alumni Directory
                    </a>

                    <a href="{{ route('donations.index') }}"
                        class="px-4 py-2 text-sm font-semibold rounded-xl transition-all duration-300 
       {{ request()->routeIs('donations.*') 
          ? 'text-blue-700 bg-white/50 shadow-sm ring-1 ring-white/20' 
          : 'text-gray-600 hover:text-blue-600 hover:bg-white/30' }}">
                        Donations
                    </a>

                    @auth
                    @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
                    <a href="{{ auth()->user()->hasRole('super-admin') ? route('super-admin.dashboard') : route('admin.dashboard') }}"
                        class="ml-4 px-6 py-2 rounded-full text-white text-sm font-bold shadow-md hover:shadow-lg transition-all duration-300"
                        style="background: linear-gradient(180deg, #3851A5 0%, #7391E7 100%);">
                        <i class="fas fa-cog mr-2"></i>Admin
                    </a>
                    @else
                    <a href="{{ route('alumni.profile') }}"
                        class="ml-4 px-6 py-2 rounded-full text-white text-sm font-bold shadow-md hover:shadow-lg transition-all duration-300"
                        style="background: linear-gradient(180deg, #3851A5 0%, #7391E7 100%);">
                        <i class="fas fa-user mr-2"></i>Profile
                    </a>
                    @endif
                    @else
                    <a href="{{ route('login') }}"
                        class="ml-4 px-8 py-2 rounded-full text-white text-sm font-bold shadow-md hover:shadow-lg transition-all duration-300"
                        style="background: linear-gradient(180deg, #3851A5 0%, #7391E7 100%);">
                        Login
                    </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center lg:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="p-2 rounded-lg text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-200">
                        <i class="fas fa-bars text-xl" x-show="!mobileMenuOpen"></i>
                        <i class="fas fa-times text-xl" x-show="mobileMenuOpen" x-cloak></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen"
            x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            @click.away="mobileMenuOpen = false"
            class="lg:hidden absolute top-full left-0 right-0 shadow-lg"
            style="background-color: rgba(230, 235, 255, 0.95); backdrop-filter: blur(12px);">
            <div class="px-4 py-4 space-y-2 max-w-7xl mx-auto">
                <a href="{{ route('home') }}"
                    class="block px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-300 
   {{ request()->routeIs('home') 
      ? 'text-blue-700 bg-white/60 shadow-sm ring-1 ring-white/30' 
      : 'text-gray-700 hover:text-blue-600 hover:bg-white/40' }}">
                    <i class="fas fa-home w-6"></i>Home
                </a>

                <a href="{{ route('news.index') }}"
                    class="block px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-300 
   {{ request()->routeIs('news.*') 
      ? 'text-blue-700 bg-white/60 shadow-sm ring-1 ring-white/30' 
      : 'text-gray-700 hover:text-blue-600 hover:bg-white/40' }}">
                    <i class="fas fa-newspaper w-6"></i>News
                </a>

                <a href="{{ route('events.index') }}"
                    class="block px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-300 
   {{ request()->routeIs('events.*') 
      ? 'text-blue-700 bg-white/60 shadow-sm ring-1 ring-white/30' 
      : 'text-gray-700 hover:text-blue-600 hover:bg-white/40' }}">
                    <i class="fas fa-calendar w-6"></i>Events
                </a>

                <a href="{{ route('gallery.index') }}"
                    class="block px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-300 
   {{ request()->routeIs('gallery.*') 
      ? 'text-blue-700 bg-white/60 shadow-sm ring-1 ring-white/30' 
      : 'text-gray-700 hover:text-blue-600 hover:bg-white/40' }}">
                    <i class="fas fa-images w-6"></i>Gallery
                </a>

                <a href="{{ route('alumni.directory') }}"
                    class="block px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-300 
   {{ (request()->routeIs('alumni.directory') || request()->routeIs('alumni.show')) 
      ? 'text-blue-700 bg-white/60 shadow-sm ring-1 ring-white/30' 
      : 'text-gray-700 hover:text-blue-600 hover:bg-white/40' }}">
                    <i class="fas fa-users w-6"></i>Alumni Directory
                </a>

                <a href="{{ route('donations.index') }}"
                    class="block px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-300 
   {{ request()->routeIs('donations.*') 
      ? 'text-blue-700 bg-white/60 shadow-sm ring-1 ring-white/30' 
      : 'text-gray-700 hover:text-blue-600 hover:bg-white/40' }}">
                    <i class="fas fa-heart w-6"></i>Donations
                </a>

                <div class="pt-4 border-t border-blue-200/50 mt-4">
                    @auth
                    @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
                    <a href="{{ auth()->user()->hasRole('super-admin') ? route('super-admin.dashboard') : route('admin.dashboard') }}"
                        class="block w-full text-center px-6 py-3 rounded-full text-white text-sm font-bold shadow-md"
                        style="background: linear-gradient(180deg, #3851A5 0%, #7391E7 100%);">
                        <i class="fas fa-cog mr-2"></i>Admin Panel
                    </a>
                    @else
                    <a href="{{ route('alumni.profile') }}"
                        class="block w-full text-center px-6 py-3 rounded-full text-white text-sm font-bold shadow-md"
                        style="background: linear-gradient(180deg, #3851A5 0%, #7391E7 100%);">
                        <i class="fas fa-user mr-2"></i>My Profile
                    </a>
                    @endif
                    @else
                    <div class="space-y-2">
                        <a href="{{ route('login') }}"
                            class="block w-full text-center px-6 py-3 rounded-full text-white text-sm font-bold shadow-md"
                            style="background: linear-gradient(180deg, #3851A5 0%, #7391E7 100%);">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                        <a href="{{ route('register') }}"
                            class="block w-full text-center px-6 py-3 rounded-full text-sm font-bold border-2 transition-colors duration-200"
                            style="color: #3851A5; border-color: #3851A5;">
                            <i class="fas fa-user-plus mr-2"></i>Register
                        </a>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 relative z-10">
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
            <button @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 relative z-10">
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
            <button @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    @endif

    <!-- Main Content -->
    <main class="min-h-screen relative z-0">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-white mt-20 relative z-10" style="background: linear-gradient(180deg, #1a2744 0%, #0f172a 100%);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- About -->
                <div>
                    <h3 class="text-xl font-bold mb-4" style="color: #7391E7;">Alumni System</h3>
                    <p class="text-gray-400 text-sm">
                        Connecting alumni, sharing stories, building networks.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4" style="color: #7391E7;">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('news.index') }}" class="text-gray-400 hover:text-white transition-colors">News</a></li>
                        <li><a href="{{ route('events.index') }}" class="text-gray-400 hover:text-white transition-colors">Events</a></li>
                        <li><a href="{{ route('alumni.directory') }}" class="text-gray-400 hover:text-white transition-colors">Alumni Directory</a></li>
                        <li><a href="{{ route('donations.index') }}" class="text-gray-400 hover:text-white transition-colors">Donations</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-semibold mb-4" style="color: #7391E7;">Contact</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><i class="fas fa-envelope mr-2" style="color: #7391E7;"></i> info@alumni.com</li>
                        <li><i class="fas fa-phone mr-2" style="color: #7391E7;"></i> +62 123 4567 890</li>
                        <li><i class="fas fa-map-marker-alt mr-2" style="color: #7391E7;"></i> Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} Alumni System. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>

</html>