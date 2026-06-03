@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-gradient-to-br from-purple-900 via-violet-900 to-indigo-900 dark:from-gray-900 dark:via-purple-900 dark:to-indigo-900 text-white">

    <!-- Navbar -->
    <nav class="bg-purple-900 dark:bg-gray-900 border-b border-purple-700 dark:border-white/10 sticky top-0 z-50" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="text-xl font-bold text-white">Baricode</a>

            <!-- Nav Links (Desktop) -->
            <div class="hidden md:flex items-center gap-6">
                <div class="relative" x-data="{ belajarOpen: false }">
                    <button @click="belajarOpen = !belajarOpen" @click.outside="belajarOpen = false"
                        class="flex items-center gap-1 text-sm transition-colors {{ request()->routeIs('lms.*', 'mentoring.*', 'academy.*') ? 'text-white font-medium' : 'text-purple-200 hover:text-white' }}">
                        Belajar
                        <svg class="w-3.5 h-3.5 transition-transform duration-200" :class="belajarOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="belajarOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1"
                        class="absolute left-0 mt-2 w-52 bg-gray-900 border border-white/10 rounded-xl shadow-xl py-1.5 z-50">
                        <a href="{{ route('lms.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm hover:bg-white/10 transition-colors {{ request()->routeIs('lms.*') ? 'text-white font-medium' : 'text-gray-300' }}">
                            <span class="text-base">📚</span>
                            <div>
                                <p class="font-medium leading-none mb-0.5">LMS</p>
                                <p class="text-xs text-gray-500 leading-none">Kursus mandiri, gratis</p>
                            </div>
                        </a>
                        <a href="{{ route('mentoring.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm hover:bg-white/10 transition-colors {{ request()->routeIs('mentoring.*') ? 'text-white font-medium' : 'text-gray-300' }}">
                            <span class="text-base">🤝</span>
                            <div>
                                <p class="font-medium leading-none mb-0.5">Bimbingan</p>
                                <p class="text-xs text-gray-500 leading-none">Mentoring personal, gratis</p>
                            </div>
                        </a>
                        <div class="mx-3 my-1 border-t border-white/10"></div>
                        <a href="{{ route('academy.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm hover:bg-amber-500/10 transition-colors {{ request()->routeIs('academy.*') ? 'text-amber-300 font-medium' : 'text-amber-400/80' }}">
                            <span class="text-base">🎓</span>
                            <div>
                                <div class="flex items-center gap-1.5 mb-0.5">
                                    <p class="font-medium leading-none">Academy</p>
                                    <span class="px-1 py-0.5 bg-amber-500/20 border border-amber-400/40 rounded text-amber-300 text-[9px] font-bold leading-none">BARU</span>
                                </div>
                                <p class="text-xs text-gray-500 leading-none">Live session, berbayar</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Auth Area (Desktop) -->
            <div class="hidden md:flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="text-sm text-purple-200 dark:text-gray-300 hover:text-white transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="text-sm px-4 py-2 bg-purple-600 rounded-full hover:bg-purple-700 transition-colors">Daftar</a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm text-purple-200 dark:text-gray-300 hover:text-white transition-colors {{ request()->routeIs('dashboard') ? 'text-white font-medium' : '' }}">Dashboard</a>
                    <div class="relative" x-data="{ dropdownOpen: false }">
                        <button @click="dropdownOpen = !dropdownOpen" class="flex items-center gap-2 text-sm text-purple-200 dark:text-gray-300 hover:text-white transition-colors">
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
            <button @click="open = !open" class="md:hidden text-purple-200 hover:text-white transition-colors">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" x-transition class="md:hidden border-t border-purple-700 dark:border-white/10 bg-purple-900 dark:bg-gray-900 px-4 py-3 space-y-1">
            <p class="text-xs text-purple-400 font-semibold uppercase tracking-wide px-1 pt-1">Belajar</p>
            <a href="{{ route('lms.index') }}" class="block text-sm text-purple-200 hover:text-white transition-colors py-2 pl-2">📚 LMS</a>
            <a href="{{ route('mentoring.index') }}" class="block text-sm text-purple-200 hover:text-white transition-colors py-2 pl-2">🤝 Bimbingan</a>
            <a href="{{ route('academy.index') }}" class="flex items-center gap-2 text-sm text-amber-400 hover:text-amber-300 transition-colors py-2 pl-2">
                🎓 Academy
                <span class="px-1.5 py-0.5 bg-amber-500/20 border border-amber-400/40 rounded text-amber-300 text-[10px] font-bold">BARU</span>
            </a>
            <div class="border-t border-purple-700 dark:border-white/10 pt-2 mt-2 space-y-1">
                @guest
                    <a href="{{ route('login') }}" class="block text-sm text-purple-200 hover:text-white transition-colors py-2">Masuk</a>
                    <a href="{{ route('register') }}" class="block text-sm text-purple-200 hover:text-white transition-colors py-2">Daftar</a>
                @endguest
                @auth
                    <a href="{{ route('dashboard') }}" class="block text-sm text-purple-200 hover:text-white transition-colors py-2">Dashboard</a>
                    <a href="{{ route('profile.edit') }}" class="block text-sm text-purple-200 hover:text-white transition-colors py-2">Pengaturan</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left text-sm text-purple-200 hover:text-white transition-colors py-2">Keluar</button>
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
