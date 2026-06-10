<nav class="bg-purple-900 dark:bg-gray-900 border-b border-purple-700 dark:border-white/10 sticky top-0 z-50" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 flex items-center justify-between h-16">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="text-xl font-bold text-white">Baricode</a>

        {{-- Desktop Nav --}}
        <div class="hidden md:flex items-center gap-1">

            {{-- Belajar --}}
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @click.outside="open = false"
                    class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm transition-colors {{ request()->routeIs('lms.*', 'mentoring.*', 'academy.*', 'how-to-learn', 'roadmap*', 'cheatsheet.*') ? 'text-white bg-white/10 font-medium' : 'text-purple-200 hover:text-white hover:bg-white/5' }}">
                    <span>Belajar</span>
                    <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-1"
                    class="absolute left-0 mt-2 w-64 bg-gray-900 border border-white/10 rounded-2xl shadow-2xl overflow-hidden z-50">
                    <div class="p-2">
                        <p class="text-xs text-purple-400 font-bold uppercase tracking-widest px-3 py-2">Program</p>
                        <a href="{{ route('lms.index') }}" class="flex items-start gap-3 px-3 py-2.5 rounded-xl hover:bg-white/5 transition-colors group {{ request()->routeIs('lms.*') ? 'bg-white/5' : '' }}">
                            <span class="text-xl mt-0.5">📚</span>
                            <div>
                                <p class="text-sm font-medium text-white">Kursus</p>
                                <p class="text-xs text-gray-400">Materi belajar terstruktur & gratis</p>
                            </div>
                        </a>
                        <a href="{{ route('mentoring.index') }}" class="flex items-start gap-3 px-3 py-2.5 rounded-xl hover:bg-white/5 transition-colors {{ request()->routeIs('mentoring.*') ? 'bg-white/5' : '' }}">
                            <span class="text-xl mt-0.5">🧑‍🏫</span>
                            <div>
                                <p class="text-sm font-medium text-white">Bimbingan</p>
                                <p class="text-xs text-gray-400">Mentoring 1-on-1 dari praktisi</p>
                            </div>
                        </a>
                        <a href="{{ route('academy.index') }}" class="flex items-start gap-3 px-3 py-2.5 rounded-xl hover:bg-white/5 transition-colors {{ request()->routeIs('academy.*') ? 'bg-white/5' : '' }}">
                            <span class="text-xl mt-0.5">🏫</span>
                            <div>
                                <p class="text-sm font-medium text-amber-300">Akademi</p>
                                <p class="text-xs text-gray-400">Program intensif bersertifikat</p>
                            </div>
                        </a>
                        <div class="border-t border-white/10 my-1.5"></div>
                        <p class="text-xs text-purple-400 font-bold uppercase tracking-widest px-3 py-2">Referensi</p>
                        <a href="{{ route('cheatsheet.index') }}" class="flex items-start gap-3 px-3 py-2.5 rounded-xl hover:bg-white/5 transition-colors {{ request()->routeIs('cheatsheet.*') ? 'bg-white/5' : '' }}">
                            <span class="text-xl mt-0.5">📋</span>
                            <div>
                                <p class="text-sm font-medium text-white">Cheatsheet</p>
                                <p class="text-xs text-gray-400">Referensi cepat dari komunitas</p>
                            </div>
                        </a>
                        <a href="{{ route('roadmap') }}" class="flex items-start gap-3 px-3 py-2.5 rounded-xl hover:bg-white/5 transition-colors {{ request()->routeIs('roadmap*') ? 'bg-white/5' : '' }}">
                            <span class="text-xl mt-0.5">🗺️</span>
                            <div>
                                <p class="text-sm font-medium text-white">Roadmap</p>
                                <p class="text-xs text-gray-400">Jalur belajar developer Indonesia</p>
                            </div>
                        </a>
                        <a href="{{ route('how-to-learn') }}" class="flex items-start gap-3 px-3 py-2.5 rounded-xl hover:bg-white/5 transition-colors {{ request()->routeIs('how-to-learn') ? 'bg-white/5' : '' }}">
                            <span class="text-xl mt-0.5">📖</span>
                            <div>
                                <p class="text-sm font-medium text-cyan-300">Cara Belajar</p>
                                <p class="text-xs text-gray-400">Panduan memulai di Baricode</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Komunitas --}}
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @click.outside="open = false"
                    class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm transition-colors {{ request()->routeIs('family.*', 'daily-commit-tracker.*', 'repohub.*', 'timeline.*', 'meme.*', 'jobboard.*') ? 'text-white bg-white/10 font-medium' : 'text-purple-200 hover:text-white hover:bg-white/5' }}">
                    <span>Komunitas</span>
                    <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-1"
                    class="absolute left-0 mt-2 w-64 bg-gray-900 border border-white/10 rounded-2xl shadow-2xl overflow-hidden z-50">
                    <div class="p-2">
                        <p class="text-xs text-purple-400 font-bold uppercase tracking-widest px-3 py-2">Anggota</p>
                        <a href="{{ route('family.index') }}" class="flex items-start gap-3 px-3 py-2.5 rounded-xl hover:bg-white/5 transition-colors {{ request()->routeIs('family.*') ? 'bg-white/5' : '' }}">
                            <span class="text-xl mt-0.5">👥</span>
                            <div>
                                <p class="text-sm font-medium text-white">Direktori Keluarga</p>
                                <p class="text-xs text-gray-400">Temukan & kenali sesama member</p>
                            </div>
                        </a>
                        <a href="{{ route('daily-commit-tracker.index') }}" class="flex items-start gap-3 px-3 py-2.5 rounded-xl hover:bg-white/5 transition-colors {{ request()->routeIs('daily-commit-tracker.*') ? 'bg-white/5' : '' }}">
                            <span class="text-xl mt-0.5">🔥</span>
                            <div>
                                <p class="text-sm font-medium text-white">Daily Tracker</p>
                                <p class="text-xs text-gray-400">Lacak konsistensi belajar harian</p>
                            </div>
                        </a>
                        <a href="{{ route('timeline.index') }}" class="flex items-start gap-3 px-3 py-2.5 rounded-xl hover:bg-white/5 transition-colors {{ request()->routeIs('timeline.*') ? 'bg-white/5' : '' }}">
                            <span class="text-xl mt-0.5">📅</span>
                            <div>
                                <p class="text-sm font-medium text-white">Timeline</p>
                                <p class="text-xs text-gray-400">Perjalanan & momen komunitas</p>
                            </div>
                        </a>
                        <div class="border-t border-white/10 my-1.5"></div>
                        <p class="text-xs text-purple-400 font-bold uppercase tracking-widest px-3 py-2">Sumber Daya</p>
                        <a href="{{ route('repohub.index') }}" class="flex items-start gap-3 px-3 py-2.5 rounded-xl hover:bg-white/5 transition-colors {{ request()->routeIs('repohub.*') ? 'bg-white/5' : '' }}">
                            <span class="text-xl mt-0.5">🔗</span>
                            <div>
                                <p class="text-sm font-medium text-white">RepoHub</p>
                                <p class="text-xs text-gray-400">Koleksi repositori pilihan komunitas</p>
                            </div>
                        </a>
                        <a href="{{ route('jobboard.index') }}" class="flex items-start gap-3 px-3 py-2.5 rounded-xl hover:bg-white/5 transition-colors {{ request()->routeIs('jobboard.*') ? 'bg-white/5' : '' }}">
                            <span class="text-xl mt-0.5">💼</span>
                            <div>
                                <p class="text-sm font-medium text-white">Job Board</p>
                                <p class="text-xs text-gray-400">Lowongan kerja di bidang IT</p>
                            </div>
                        </a>
                        <a href="{{ route('meme.index') }}" class="flex items-start gap-3 px-3 py-2.5 rounded-xl hover:bg-white/5 transition-colors {{ request()->routeIs('meme.*') ? 'bg-white/5' : '' }}">
                            <span class="text-xl mt-0.5">😂</span>
                            <div>
                                <p class="text-sm font-medium text-white">Meme</p>
                                <p class="text-xs text-gray-400">Hiburan ringan dari komunitas</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Tentang --}}
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @click.outside="open = false"
                    class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm transition-colors {{ request()->routeIs('about', 'bmc') ? 'text-white bg-white/10 font-medium' : 'text-purple-200 hover:text-white hover:bg-white/5' }}">
                    <span>Tentang</span>
                    <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-1"
                    class="absolute left-0 mt-2 w-64 bg-gray-900 border border-white/10 rounded-2xl shadow-2xl overflow-hidden z-50">
                    <div class="p-2">
                        <a href="{{ route('about') }}" class="flex items-start gap-3 px-3 py-2.5 rounded-xl hover:bg-white/5 transition-colors {{ request()->routeIs('about') ? 'bg-white/5' : '' }}">
                            <span class="text-xl mt-0.5">ℹ️</span>
                            <div>
                                <p class="text-sm font-medium text-white">Tentang Baricode</p>
                                <p class="text-xs text-gray-400">Misi, visi, dan nilai komunitas</p>
                            </div>
                        </a>
                        <a href="{{ route('bmc') }}" class="flex items-start gap-3 px-3 py-2.5 rounded-xl hover:bg-white/5 transition-colors {{ request()->routeIs('bmc') ? 'bg-white/5' : '' }}">
                            <span class="text-xl mt-0.5">📊</span>
                            <div>
                                <p class="text-sm font-medium text-white">Business Model Canvas</p>
                                <p class="text-xs text-gray-400">Transparansi model bisnis komunitas</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        {{-- Auth Area (Desktop) --}}
        <div class="hidden md:flex items-center gap-3">
            @guest
                <a href="{{ route('login') }}" class="text-sm text-purple-200 hover:text-white transition-colors">Masuk</a>
                <a href="{{ route('register') }}" class="text-sm px-4 py-2 bg-purple-600 rounded-full hover:bg-purple-700 transition-colors font-medium">Daftar Gratis</a>
            @endguest
            @auth
                <a href="{{ route('dashboard') }}" class="text-sm px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('dashboard*') ? 'text-white bg-white/10 font-medium' : 'text-purple-200 hover:text-white hover:bg-white/5' }}">Dashboard</a>
                <div class="relative" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen" @click.outside="dropdownOpen = false"
                        class="flex items-center gap-2 text-sm text-purple-200 hover:text-white transition-colors px-3 py-2 rounded-lg hover:bg-white/5">
                        <span>{{ auth()->user()->name }}</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="dropdownOpen" @click.outside="dropdownOpen = false" x-transition
                        class="absolute right-0 mt-2 w-48 bg-gray-900 border border-white/10 rounded-xl shadow-xl py-1 z-50">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-white/10 transition-colors">Pengaturan</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-300 hover:text-white hover:bg-white/10 transition-colors">Keluar</button>
                        </form>
                    </div>
                </div>
            @endauth
        </div>

        {{-- Mobile Hamburger --}}
        <button @click="open = !open" class="md:hidden text-purple-200 hover:text-white transition-colors p-1">
            <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" x-transition class="md:hidden border-t border-purple-700 dark:border-white/10 bg-purple-900 dark:bg-gray-900 px-4 py-3">

        <p class="text-xs text-purple-400 font-bold uppercase tracking-widest py-2">Belajar</p>
        <a href="{{ route('lms.index') }}" class="flex items-center gap-3 py-2.5 text-sm transition-colors {{ request()->routeIs('lms.*') ? 'text-white font-medium' : 'text-purple-200 hover:text-white' }}">
            <span>📚</span><span>Kursus</span>
        </a>
        <a href="{{ route('mentoring.index') }}" class="flex items-center gap-3 py-2.5 text-sm transition-colors {{ request()->routeIs('mentoring.*') ? 'text-white font-medium' : 'text-purple-200 hover:text-white' }}">
            <span>🧑‍🏫</span><span>Bimbingan</span>
        </a>
        <a href="{{ route('academy.index') }}" class="flex items-center gap-3 py-2.5 text-sm transition-colors {{ request()->routeIs('academy.*') ? 'text-amber-300 font-medium' : 'text-purple-200 hover:text-white' }}">
            <span>🏫</span><span>Akademi</span>
        </a>
        <a href="{{ route('cheatsheet.index') }}" class="flex items-center gap-3 py-2.5 text-sm transition-colors {{ request()->routeIs('cheatsheet.*') ? 'text-white font-medium' : 'text-purple-200 hover:text-white' }}">
            <span>📋</span><span>Cheatsheet</span>
        </a>
        <a href="{{ route('roadmap') }}" class="flex items-center gap-3 py-2.5 text-sm transition-colors {{ request()->routeIs('roadmap*') ? 'text-white font-medium' : 'text-purple-200 hover:text-white' }}">
            <span>🗺️</span><span>Roadmap</span>
        </a>
        <a href="{{ route('how-to-learn') }}" class="flex items-center gap-3 py-2.5 text-sm transition-colors {{ request()->routeIs('how-to-learn') ? 'text-cyan-300 font-medium' : 'text-cyan-400 hover:text-cyan-300' }}">
            <span>📖</span><span>Cara Belajar</span>
        </a>

        <div class="border-t border-purple-700 dark:border-white/10 mt-2 pt-2">
            <p class="text-xs text-purple-400 font-bold uppercase tracking-widest py-2">Komunitas</p>
            <a href="{{ route('family.index') }}" class="flex items-center gap-3 py-2.5 text-sm transition-colors {{ request()->routeIs('family.*') ? 'text-white font-medium' : 'text-purple-200 hover:text-white' }}">
                <span>👥</span><span>Direktori Keluarga</span>
            </a>
            <a href="{{ route('daily-commit-tracker.index') }}" class="flex items-center gap-3 py-2.5 text-sm transition-colors {{ request()->routeIs('daily-commit-tracker.*') ? 'text-white font-medium' : 'text-purple-200 hover:text-white' }}">
                <span>🔥</span><span>Daily Tracker</span>
            </a>
            <a href="{{ route('timeline.index') }}" class="flex items-center gap-3 py-2.5 text-sm transition-colors {{ request()->routeIs('timeline.*') ? 'text-white font-medium' : 'text-purple-200 hover:text-white' }}">
                <span>📅</span><span>Timeline</span>
            </a>
            <a href="{{ route('repohub.index') }}" class="flex items-center gap-3 py-2.5 text-sm transition-colors {{ request()->routeIs('repohub.*') ? 'text-white font-medium' : 'text-purple-200 hover:text-white' }}">
                <span>🔗</span><span>RepoHub</span>
            </a>
            <a href="{{ route('jobboard.index') }}" class="flex items-center gap-3 py-2.5 text-sm transition-colors {{ request()->routeIs('jobboard.*') ? 'text-white font-medium' : 'text-purple-200 hover:text-white' }}">
                <span>💼</span><span>Job Board</span>
            </a>
            <a href="{{ route('meme.index') }}" class="flex items-center gap-3 py-2.5 text-sm transition-colors {{ request()->routeIs('meme.*') ? 'text-white font-medium' : 'text-purple-200 hover:text-white' }}">
                <span>😂</span><span>Meme</span>
            </a>
        </div>

        <div class="border-t border-purple-700 dark:border-white/10 mt-2 pt-2">
            <p class="text-xs text-purple-400 font-bold uppercase tracking-widest py-2">Tentang</p>
            <a href="{{ route('about') }}" class="flex items-center gap-3 py-2.5 text-sm transition-colors {{ request()->routeIs('about') ? 'text-white font-medium' : 'text-purple-200 hover:text-white' }}">
                <span>ℹ️</span><span>Tentang Baricode</span>
            </a>
            <a href="{{ route('bmc') }}" class="flex items-center gap-3 py-2.5 text-sm transition-colors {{ request()->routeIs('bmc') ? 'text-white font-medium' : 'text-purple-200 hover:text-white' }}">
                <span>📊</span><span>Business Model Canvas</span>
            </a>
        </div>

        <div class="border-t border-purple-700 dark:border-white/10 mt-2 pt-2 space-y-1">
            @guest
                <a href="{{ route('login') }}" class="block text-sm text-purple-200 hover:text-white transition-colors py-2">Masuk</a>
                <a href="{{ route('register') }}" class="block text-sm text-purple-200 hover:text-white transition-colors py-2">Daftar Gratis</a>
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
