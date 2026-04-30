@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-indigo-900 text-white">

    <!-- Navbar -->
    <nav class="bg-gray-900/95 backdrop-blur-sm border-b border-white/10 sticky top-0 z-50" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="text-xl font-bold text-white">Baricode</a>

            <!-- Nav Links (Desktop) -->
            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('lms.index') }}" class="text-sm text-gray-300 hover:text-white transition-colors {{ request()->routeIs('lms.*') ? 'text-white font-medium' : '' }}">LMS</a>
                <a href="{{ route('family.index') }}" class="text-sm text-gray-300 hover:text-white transition-colors {{ request()->routeIs('family.*') ? 'text-white font-medium' : '' }}">Keluarga</a>
                <a href="{{ route('repohub.index') }}" class="text-sm text-gray-300 hover:text-white transition-colors {{ request()->routeIs('repohub.*') ? 'text-white font-medium' : '' }}">RepoHub</a>
            </div>

            <!-- Auth Area (Desktop) -->
            <div class="hidden md:flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="text-sm px-4 py-2 bg-purple-600 rounded-full hover:bg-purple-700 transition-colors">Daftar</a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm text-gray-300 hover:text-white transition-colors">Dashboard</a>
                    <div class="relative" x-data="{ dropdownOpen: false }">
                        <button @click="dropdownOpen = !dropdownOpen" class="flex items-center gap-2 text-sm text-gray-300 hover:text-white transition-colors">
                            <span>{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="dropdownOpen" @click.outside="dropdownOpen = false" x-transition class="absolute right-0 mt-2 w-48 bg-gray-800 border border-white/10 rounded-lg shadow-lg py-1">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-white/10 transition-colors">Pengaturan</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-white/10 transition-colors">Keluar</button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>

            <!-- Mobile Hamburger -->
            <button @click="open = !open" class="md:hidden text-gray-300 hover:text-white transition-colors">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" x-transition class="md:hidden border-t border-white/10 bg-gray-900/95 px-4 py-3 space-y-1">
            <a href="{{ route('lms.index') }}" class="block text-sm text-gray-300 hover:text-white transition-colors py-2">LMS</a>
            <a href="{{ route('family.index') }}" class="block text-sm text-gray-300 hover:text-white transition-colors py-2">Keluarga</a>
            <a href="{{ route('repohub.index') }}" class="block text-sm text-gray-300 hover:text-white transition-colors py-2">RepoHub</a>
            <div class="border-t border-white/10 pt-2 mt-2 space-y-1">
                @guest
                    <a href="{{ route('login') }}" class="block text-sm text-gray-300 hover:text-white transition-colors py-2">Masuk</a>
                    <a href="{{ route('register') }}" class="block text-sm text-gray-300 hover:text-white transition-colors py-2">Daftar</a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}" class="block text-sm text-gray-300 hover:text-white transition-colors py-2">Dashboard</a>
                    <a href="{{ route('profile.edit') }}" class="block text-sm text-gray-300 hover:text-white transition-colors py-2">Pengaturan</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left text-sm text-gray-300 hover:text-white transition-colors py-2">Keluar</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    @if (isset($slot))
        {{ $slot }}
    @else
        @yield('content')
    @endif

    @fluxScripts
</body>

</html>
