<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'CareerTrackr') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#F5F7FA]">
    <!-- Modern Dashboard Header -->
    <header class="bg-white border-b border-gray-200/50 sticky top-0 z-50">
        <div class="max-w-[1400px] mx-auto px-12 h-[88px] flex items-center justify-between">
            <!-- Left Section: Logo + Brand -->
            <div class="flex items-center gap-3">
                <!-- Logo Container -->
                <div class="relative">
                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.25 14.15v4.1a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25v-4.1m16.5 0a24 24 0 0 1-16.5 0m16.5 0v-2.4a2.25 2.25 0 0 0-2.25-2.25h-12a2.25 2.25 0 0 0-2.25 2.25v2.4m16.5 0L12 17.25 3.75 14.15M15 7.5v-1.5a2.25 2.25 0 0 0-2.25-2.25h-1.5A2.25 2.25 0 0 0 9 6v1.5"/>
                        </svg>
                    </div>
                    <!-- Sparkle Accent -->
                    <div class="absolute -top-1 -right-1">
                        <svg class="w-3.5 h-3.5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                </div>
                
                <!-- Brand Text -->
                <div>
                    <h1 class="text-lg font-bold text-teal-600 leading-tight">CareerTrackr</h1>
                    <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider">JOB HUNT OS</p>
                </div>
            </div>

            <!-- Center Navigation -->
            <nav class="flex items-center gap-1">
                <a href="{{ route('dashboard') }}" 
                   class="nav-link {{ request()->routeIs('dashboard') ? 'nav-link-active' : '' }}">
                    Tableau de bord
                </a>
                <a href="{{ route('candidatures.index') }}" 
                   class="nav-link {{ request()->routeIs('candidatures.*') ? 'nav-link-active' : '' }}">
                    Mes candidatures
                </a>
                <a href="#" class="nav-link">
                    Archives
                </a>
            </nav>

            <!-- Right Section -->
            <div class="flex items-center gap-3">
                <!-- Search Bar -->
                <div class="hidden lg:flex search-bar">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <span>Rechercher...</span>
                    <span class="kbd-shortcut ml-2">⌘K</span>
                </div>

                <!-- Theme Toggle -->
                <button class="hidden sm:flex w-9 h-9 items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50 hover:text-gray-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </button>

                <!-- CTA Button -->
                <a href="{{ route('candidatures.create') }}" 
                   class="hidden sm:flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-500 text-white text-sm font-semibold rounded-full shadow-lg shadow-emerald-500/20 hover:shadow-xl hover:shadow-emerald-500/30 hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nouvelle candidature
                </a>

                <!-- User Avatar -->
                <div class="flex items-center gap-3 ml-2 pl-3 border-l border-gray-200">
                    <div class="w-9 h-9 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-full flex items-center justify-center text-white text-sm font-bold shadow-md">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', Auth::user()->name)[1] ?? '', 0, 1)) }}
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="open = ! open" class="sm:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" @click.away="open = false" class="sm:hidden border-t border-gray-100 bg-white">
            <div class="px-4 py-3 space-y-1">
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">Tableau de bord</a>
                <a href="{{ route('candidatures.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">Mes candidatures</a>
                <a href="#" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">Archives</a>
                <div class="pt-3 border-t border-gray-100">
                    <a href="{{ route('candidatures.create') }}" class="flex items-center justify-center gap-2 w-full px-4 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-500 text-white text-sm font-semibold rounded-full">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Nouvelle candidature
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <main class="min-h-screen">
        {{ $slot }}
    </main>

    @stack('scripts')
</body>
</html>
