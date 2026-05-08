<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body>
    <!-- Navbar -->
    <nav class="bg-purple-900 dark:bg-gray-900 border-b border-purple-700 dark:border-white/10">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between h-16">
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}" class="text-xl font-bold text-white dark:text-white">Baricode</a>
                <div class="hidden md:flex items-center gap-4">
                    <a href="{{ route('timeline.index') }}" class="text-sm text-purple-200 dark:text-gray-300 hover:text-white transition-colors {{ request()->routeIs('timeline.*') ? 'text-white font-medium' : '' }}">Progres Komunitas</a>
                    <a href="{{ route('family.index') }}" class="text-sm text-purple-200 dark:text-gray-300 hover:text-white transition-colors">Keluarga</a>
                </div>
            </div>
            <div class="flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="text-sm text-purple-200 dark:text-gray-300 hover:text-white transition-colors">Masuk</a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm text-purple-200 dark:text-gray-300 hover:text-white transition-colors">Dashboard</a>
                    <span class="text-sm text-purple-200 dark:text-gray-400">{{ auth()->user()->name }}</span>
                @endauth
            </div>
        </div>
    </nav>

    <div
        class="min-h-screen bg-gradient-to-br from-purple-900 via-violet-900 to-indigo-900 dark:from-gray-900 dark:via-purple-900 dark:to-indigo-900 text-white dark:text-white">
        <div class="max-w-5xl px-4 py-8 md:px-8">
            @if (isset($slot))
                {{ $slot }}
            @else
                @yield('content')
            @endif
        </div>
    </div>

    @fluxScripts
</body>

</html>
