<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Alumni System') }} - @yield('title', 'Profile')</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    
    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50 antialiased">
    
    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">
        
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-0"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            
            <!-- Logo -->
            <div class="flex items-center justify-center h-16 bg-blue-600">
                <span class="text-xl font-bold text-white">Admin Panel</span>
            </div>

            <!-- Navigation -->
            <nav class="mt-8 px-4 space-y-2">
                <a href="{{ route('alumni.profile') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('alumni.profile') ? 'bg-blue-50 text-blue-600' : '' }}">
                    <i class="fas fa-user mr-3"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('home') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-home mr-3"></i>
                    <span>Back to Home</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-4 py-3 text-red-600 rounded-lg hover:bg-red-50">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- Top Bar -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between h-16 px-4 lg:px-8">
                    <!-- Mobile Menu Button -->
                    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 lg:hidden">
                        <i class="fas fa-bars text-xl"></i>
                    </button>

                    <div class="flex-1 lg:ml-0 ml-4">
                        <h1 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Profile')</h1>
                    </div>

                    <!-- User Info -->
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600 hidden sm:block">{{ auth()->user()->name }}</span>
                        <img src="{{ auth()->user()->alumniProfile?->profile_picture_url ?? asset('images/default-avatar.png') }}" 
                             alt="Profile" 
                             class="w-10 h-10 rounded-full border-2 border-blue-600">
                    </div>
                </div>
            </header>

            <!-- Flash Messages -->
            <div class="px-4 lg:px-8 mt-4">
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                        <button @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                        <button @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif
            </div>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 px-4 lg:px-8 py-6">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>