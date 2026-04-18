<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body>
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-pink-500 via-yellow-400 to-green-400 border-b border-white/10 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between h-16">
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="text-lg font-bold text-white drop-shadow-lg hover:text-yellow-200 transition">
                    Baricode
                </a>
                <span class="text-white/60 text-sm hidden sm:inline">/ Fun</span>
                <a href="{{ route('dashboard') }}" class="text-sm text-white/80 hover:text-white transition hidden sm:inline">Dashboard</a>
            </div>
            <div class="flex items-center gap-3">
                @auth
                    <span class="text-sm text-white/80">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-white/80 hover:text-white transition">Keluar</button>
                    </form>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="text-sm text-white/80 hover:text-white transition">Masuk</a>
                @endguest
            </div>
        </div>
    </nav>
    
    <div class="min-h-screen bg-gradient-to-br from-yellow-100 via-pink-100 to-green-100 dark:from-gray-900 dark:via-gray-800 dark:to-black transition-colors duration-500">
        {{ $slot }}
    </div>

    @fluxScripts
</body>

</html>
