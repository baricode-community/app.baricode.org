@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-gradient-to-br from-gray-900 via-purple-900 to-indigo-900 text-white">

    @guest
        <!-- Welcome Modal -->
        <div id="welcome-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
            x-data="{
                open: false,
                init() {
                    const dismissed = localStorage.getItem('baricode_welcome_dismissed_at');
                    const fiveMinutes = 5 * 60 * 1000;
                    this.open = !dismissed || (Date.now() - parseInt(dismissed)) > fiveMinutes;
                }
            }" x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @keydown.escape.window="open = false; localStorage.setItem('baricode_welcome_dismissed_at', Date.now())"
            style="display: none;">
            <div class="relative w-[90vw] h-[90vh] rounded-3xl overflow-hidden flex flex-col
                   bg-gradient-to-br from-gray-900 via-purple-900 to-indigo-900
                   border border-purple-800/40
                   shadow-2xl shadow-purple-500/20"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" @click.stop>
                <!-- Close Button -->
                <button @click="open = false; localStorage.setItem('baricode_welcome_dismissed_at', Date.now())"
                    class="absolute top-4 right-4 z-10 flex items-center justify-center w-10 h-10 rounded-full
                       bg-white/10 hover:bg-white/20
                       text-gray-300 hover:text-white
                       transition-all duration-200 shadow"
                    aria-label="Tutup modal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Decorative gradient header -->
                <div class="flex-shrink-0 h-2 bg-gradient-to-r from-purple-500 via-violet-500 to-indigo-500"></div>

                <!-- Scrollable content -->
                <div class="flex-1 overflow-y-auto px-8 py-10 md:px-16 md:py-14">

                    <!-- Badge -->
                    <div class="flex justify-center mb-6">
                        <span
                            class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold
                                 bg-purple-900/40 text-purple-300
                                 ring-1 ring-purple-700">
                            🎉 Selamat Datang di Baricode!
                        </span>
                    </div>

                    <!-- Headline -->
                    <h2
                        class="text-center text-3xl md:text-5xl font-extrabold mb-4 leading-tight
                            bg-gradient-to-r from-purple-500 via-violet-500 to-indigo-500 bg-clip-text text-transparent">
                        Komunitas IT Keren<br>untuk Developer Indonesia
                    </h2>

                    <p class="text-center text-base md:text-lg text-gray-400 max-w-2xl mx-auto mb-10">
                        Platform belajar, berbagi, dan berkembang bersama ribuan developer aktif dari seluruh Indonesia.
                        Gratis. Terbuka. Menyenangkan.
                    </p>

                    <!-- Feature cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-10">
                        <div
                            class="rounded-2xl p-6 flex flex-col gap-3
                                bg-purple-900/20
                                border border-purple-800/50">
                            <div class="text-3xl">📚</div>
                            <h3 class="font-bold text-white text-lg">Kursus Gratis</h3>
                            <p class="text-sm text-gray-400">
                                Akses ratusan materi belajar mulai dari pemula hingga tingkat lanjut — sepenuhnya gratis
                                untuk semua anggota.
                            </p>
                        </div>
                        <div
                            class="rounded-2xl p-6 flex flex-col gap-3
                                bg-indigo-900/20
                                border border-indigo-800/50">
                            <div class="text-3xl">🔥</div>
                            <h3 class="font-bold text-white text-lg">Daily Commit Tracker</h3>
                            <p class="text-sm text-gray-400">
                                Bangun kebiasaan coding harian. Catat progress-mu setiap hari dan tetap termotivasi bersama
                                komunitas.
                            </p>
                        </div>
                        <div
                            class="rounded-2xl p-6 flex flex-col gap-3
                                bg-violet-900/20
                                border border-violet-800/50">
                            <div class="text-3xl">🤝</div>
                            <h3 class="font-bold text-white text-lg">Kolaborasi Nyata</h3>
                            <p class="text-sm text-gray-400">
                                Temukan teman belajar, bangun proyek bersama, dan tumbuh lebih cepat lewat kolaborasi aktif
                                sesama developer.
                            </p>
                        </div>
                        <div
                            class="rounded-2xl p-6 flex flex-col gap-3
                                bg-pink-900/20
                                border border-pink-800/50">
                            <div class="text-3xl">😂</div>
                            <h3 class="font-bold text-white text-lg">Meme & Fun</h3>
                            <p class="text-sm text-gray-400">
                                Belajar nggak harus serius terus. Bagikan meme coding favoritmu dan nikmati vibe komunitas
                                yang positif dan fun.
                            </p>
                        </div>
                        <div
                            class="rounded-2xl p-6 flex flex-col gap-3
                                bg-green-900/20
                                border border-green-800/50">
                            <div class="text-3xl">🧩</div>
                            <h3 class="font-bold text-white text-lg">Quiz & Tantangan</h3>
                            <p class="text-sm text-gray-400">
                                Uji pemahamanmu lewat kuis interaktif. Tantang dirimu sendiri dan lihat sejauh mana
                                kemampuanmu berkembang.
                            </p>
                        </div>
                        <div
                            class="rounded-2xl p-6 flex flex-col gap-3
                                bg-yellow-900/20
                                border border-yellow-800/50">
                            <div class="text-3xl">🗂️</div>
                            <h3 class="font-bold text-white text-lg">RepoHub</h3>
                            <p class="text-sm text-gray-400">
                                Temukan dan bagikan repositori open-source keren dari anggota komunitas. Inspirasi proyek
                                berikutmu dimulai dari sini.
                            </p>
                        </div>
                    </div>

                    <!-- CTA -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('dashboard') }}" wire:navigate @click="open = false"
                            class="px-8 py-3.5 rounded-full font-bold text-white text-base
                               bg-gradient-to-r from-purple-600 via-violet-600 to-indigo-600
                               hover:shadow-lg hover:shadow-purple-500/30 hover:scale-105
                               transition-all duration-200 text-center">
                            🚀 Mulai Sekarang — Gratis!
                        </a>
                        <button @click="open = false; localStorage.setItem('baricode_welcome_dismissed_at', Date.now())"
                            class="px-8 py-3.5 rounded-full font-semibold text-base
                               bg-white/10 hover:bg-white/20
                               text-gray-300
                               transition-all duration-200 text-center">
                            Nanti Saja
                        </button>
                    </div>

                    <!-- Note -->
                    <p class="mt-6 text-center text-xs text-gray-400 dark:text-gray-600">
                        Pesan ini hanya muncul sekali. Kamu bisa kembali ke halaman ini kapan saja.
                    </p>
                </div>
            </div>
        </div>
        <!-- End Welcome Modal -->
    @endguest

    @if (isset($slot))
        {{ $slot }}
    @else
        @yield('content')
    @endif

    @fluxScripts
</body>

</html>
