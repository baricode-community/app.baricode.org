<nav class="bg-purple-900 dark:bg-gray-900 border-b border-purple-700 dark:border-white/10 sticky top-0 z-50" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 flex items-center justify-between h-16">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="text-xl font-bold text-white">Baricode</a>

        <!-- Nav Links (Desktop) -->
        <div class="hidden md:flex items-center gap-6">
            <a href="{{ route('about') }}" class="text-sm transition-colors {{ request()->routeIs('about') ? 'text-white font-medium' : 'text-purple-200 hover:text-white' }}">Tentang</a>
            <div class="relative" x-data="{ belajarOpen: false }">
                <button @click="belajarOpen = !belajarOpen" @click.outside="belajarOpen = false"
                    class="flex items-center gap-1 text-sm transition-colors {{ request()->routeIs('lms.*', 'academy.*', 'mentoring.*', 'how-to-learn') ? 'text-white font-medium' : 'text-purple-200 hover:text-white' }}">
                    Belajar
                    <svg class="w-3 h-3 transition-transform duration-200" :class="belajarOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="belajarOpen" x-transition class="absolute left-0 mt-2 w-52 bg-gray-800 border border-white/10 rounded-xl shadow-xl py-1 z-50">
                    <a href="{{ route('lms.index') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm hover:bg-white/10 transition-colors {{ request()->routeIs('lms.*') ? 'text-white font-semibold' : 'text-gray-300 hover:text-white' }}">
                        <span>📚</span> Kursus
                    </a>
                    <a href="{{ route('mentoring.index') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm hover:bg-white/10 transition-colors {{ request()->routeIs('mentoring.*') ? 'text-white font-semibold' : 'text-gray-300 hover:text-white' }}">
                        <span>🧑‍🏫</span> Bimbingan
                    </a>
                    <a href="{{ route('academy.index') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm hover:bg-white/10 transition-colors {{ request()->routeIs('academy.*') ? 'text-amber-300 font-semibold' : 'text-gray-300 hover:text-white' }}">
                        <span>🏫</span> Akademi
                    </a>
                    <div class="border-t border-white/10 my-1"></div>
                    <a href="{{ route('how-to-learn') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm hover:bg-white/10 transition-colors {{ request()->routeIs('how-to-learn') ? 'text-cyan-300 font-semibold' : 'text-cyan-400 hover:text-cyan-300' }}">
                        <span>📖</span> Cara Belajar
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
        <a href="{{ route('about') }}" class="block text-sm transition-colors py-2 {{ request()->routeIs('about') ? 'text-white font-medium' : 'text-purple-200 hover:text-white' }}">Tentang</a>
        <div class="border-t border-purple-700 dark:border-white/10 my-1"></div>
        <p class="text-xs text-purple-400 font-semibold uppercase tracking-wider pt-1 pb-1">Belajar</p>
        <a href="{{ route('lms.index') }}" class="flex items-center gap-2 text-sm transition-colors py-2 {{ request()->routeIs('lms.*') ? 'text-white font-medium' : 'text-purple-200 hover:text-white' }}"><span>📚</span> Kursus</a>
        <a href="{{ route('mentoring.index') }}" class="flex items-center gap-2 text-sm transition-colors py-2 {{ request()->routeIs('mentoring.*') ? 'text-white font-medium' : 'text-purple-200 hover:text-white' }}"><span>🧑‍🏫</span> Bimbingan</a>
        <a href="{{ route('academy.index') }}" class="flex items-center gap-2 text-sm transition-colors py-2 {{ request()->routeIs('academy.*') ? 'text-amber-300 font-medium' : 'text-purple-200 hover:text-white' }}"><span>🏫</span> Akademi</a>
        <a href="{{ route('how-to-learn') }}" class="flex items-center gap-2 text-sm transition-colors py-2 {{ request()->routeIs('how-to-learn') ? 'text-cyan-300 font-medium' : 'text-cyan-400 hover:text-cyan-300' }}"><span>📖</span> Cara Belajar</a>
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
