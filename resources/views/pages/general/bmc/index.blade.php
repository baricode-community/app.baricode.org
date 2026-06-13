<x-layouts.base
    :title="__('Business Model Canvas — Baricode')"
    :description="__('Lihat bagaimana Baricode bekerja secara transparan — mitra, aktivitas, proposisi nilai, hingga model bisnis komunitas IT Indonesia.')"
>
    <div class="min-h-screen">

        {{-- Hero --}}
        <section class="relative flex items-center justify-center px-4 py-16">
            <div class="max-w-4xl mx-auto text-center z-10">
                <span class="inline-block px-4 py-2 bg-purple-500/20 border border-purple-400/40 rounded-full text-purple-300 font-semibold text-sm mb-6">
                    Transparansi Komunitas
                </span>
                <h1 class="text-5xl md:text-6xl font-extrabold mb-4 bg-gradient-to-r from-purple-400 via-violet-400 to-indigo-400 bg-clip-text text-transparent drop-shadow-lg">
                    Business Model Canvas
                </h1>
                <p class="text-lg text-gray-400 max-w-2xl mx-auto">
                    Bagaimana Baricode bekerja — secara transparan dan terbuka untuk komunitas.
                </p>
            </div>
        </section>

        {{-- BMC Canvas --}}
        <section class="py-4 px-4 pb-16">
            <div class="max-w-7xl mx-auto">

                {{-- Label row --}}
                <div class="hidden md:grid md:grid-cols-5 gap-3 mb-1 text-center text-xs font-bold uppercase tracking-widest text-gray-500">
                    <div>Mitra Utama</div>
                    <div>Aktivitas & Sumber Daya</div>
                    <div>Proposisi Nilai</div>
                    <div>Hubungan & Saluran</div>
                    <div>Segmen Pengguna</div>
                </div>

                {{-- Top 5-column × 2-row grid --}}
                <div class="grid grid-cols-1 md:grid-cols-5 md:grid-rows-2 gap-3 mb-3">

                    {{-- 1. Key Partners — spans 2 rows --}}
                    <div class="md:row-span-2 bg-white/5 backdrop-blur-lg rounded-2xl p-5 border border-purple-500/40 flex flex-col">
                        <div class="text-2xl mb-2">🤝</div>
                        <h3 class="text-sm font-bold text-purple-300 mb-3 uppercase tracking-wide md:hidden">Mitra Utama</h3>
                        <ul class="space-y-2 text-sm text-gray-300 flex-1">
                            <li class="flex gap-2"><span class="text-purple-400 shrink-0 mt-0.5">•</span><span>Mentor & praktisi industri IT</span></li>
                            <li class="flex gap-2"><span class="text-purple-400 shrink-0 mt-0.5">•</span><span>Perusahaan teknologi lokal</span></li>
                            <li class="flex gap-2"><span class="text-purple-400 shrink-0 mt-0.5">•</span><span>Komunitas & organisasi IT di Indonesia</span></li>
                            <li class="flex gap-2"><span class="text-purple-400 shrink-0 mt-0.5">•</span><span>Institusi pendidikan & pelatihan IT</span></li>
                        </ul>
                    </div>

                    {{-- 2. Key Activities — row 1 --}}
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-5 border border-violet-500/40 flex flex-col">
                        <div class="text-2xl mb-2">⚙️</div>
                        <h3 class="text-sm font-bold text-violet-300 mb-3 uppercase tracking-wide">Aktivitas Utama</h3>
                        <ul class="space-y-2 text-sm text-gray-300 flex-1">
                            <li class="flex gap-2"><span class="text-violet-400 shrink-0 mt-0.5">•</span><span>Produksi & kurasi konten kursus</span></li>
                            <li class="flex gap-2"><span class="text-violet-400 shrink-0 mt-0.5">•</span><span>Pengelolaan komunitas aktif</span></li>
                            <li class="flex gap-2"><span class="text-violet-400 shrink-0 mt-0.5">•</span><span>Penyelenggaraan akademi per batch</span></li>
                            <li class="flex gap-2"><span class="text-violet-400 shrink-0 mt-0.5">•</span><span>Platform development & maintenance</span></li>
                        </ul>
                    </div>

                    {{-- 3. Value Proposition — spans 2 rows --}}
                    <div class="md:row-span-2 bg-gradient-to-br from-purple-600/25 via-violet-600/20 to-indigo-600/25 backdrop-blur-lg rounded-2xl p-5 border border-violet-400/50 flex flex-col">
                        <div class="text-2xl mb-2">💎</div>
                        <h3 class="text-sm font-bold text-violet-200 mb-3 uppercase tracking-wide">Proposisi Nilai</h3>
                        <ul class="space-y-2 text-sm text-gray-200 flex-1">
                            <li class="flex gap-2"><span class="text-yellow-400 shrink-0 mt-0.5">★</span><span>Komunitas IT Indonesia yang inklusif & biaya murah</span></li>
                            <li class="flex gap-2"><span class="text-yellow-400 shrink-0 mt-0.5">★</span><span>Kursus terstruktur gratis untuk semua member</span></li>
                            <li class="flex gap-2"><span class="text-yellow-400 shrink-0 mt-0.5">★</span><span>Mentoring personal dari praktisi nyata</span></li>
                            <li class="flex gap-2"><span class="text-yellow-400 shrink-0 mt-0.5">★</span><span>Akademi intensif bersertifikat</span></li>
                            <li class="flex gap-2"><span class="text-yellow-400 shrink-0 mt-0.5">★</span><span>Transparansi penuh — open untuk komunitas</span></li>
                            <li class="flex gap-2"><span class="text-yellow-400 shrink-0 mt-0.5">★</span><span>Ekosistem belajar all-in-one (LMS, tracker, quiz, cheatsheet)</span></li>
                            <li class="flex gap-2"><span class="text-yellow-400 shrink-0 mt-0.5">★</span><span>Ruang aman untuk bertanya & salah</span></li>
                        </ul>
                    </div>

                    {{-- 4. Customer Relationships — row 1 --}}
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-5 border border-cyan-500/40 flex flex-col">
                        <div class="text-2xl mb-2">💬</div>
                        <h3 class="text-sm font-bold text-cyan-300 mb-3 uppercase tracking-wide">Hubungan Pelanggan</h3>
                        <ul class="space-y-2 text-sm text-gray-300 flex-1">
                            <li class="flex gap-2"><span class="text-cyan-400 shrink-0 mt-0.5">•</span><span>Self-service (kursus mandiri)</span></li>
                            <li class="flex gap-2"><span class="text-cyan-400 shrink-0 mt-0.5">•</span><span>Group mentoring (belajar bersama)</span></li>
                            <li class="flex gap-2"><span class="text-cyan-400 shrink-0 mt-0.5">•</span><span>Komunitas (diskusi, saling bantu)</span></li>
                            <li class="flex gap-2"><span class="text-cyan-400 shrink-0 mt-0.5">•</span><span>Automated (tracker, quiz, notifikasi)</span></li>
                        </ul>
                    </div>

                    {{-- 5. Customer Segments — spans 2 rows --}}
                    <div class="md:row-span-2 bg-white/5 backdrop-blur-lg rounded-2xl p-5 border border-indigo-500/40 flex flex-col">
                        <div class="text-2xl mb-2">👥</div>
                        <h3 class="text-sm font-bold text-indigo-300 mb-3 uppercase tracking-wide md:hidden">Segmen Pengguna</h3>
                        <ul class="space-y-2 text-sm text-gray-300 flex-1">
                            <li class="flex gap-2"><span class="text-indigo-400 shrink-0 mt-0.5">•</span><span>Developer & pelajar IT pemula Indonesia</span></li>
                            <li class="flex gap-2"><span class="text-indigo-400 shrink-0 mt-0.5">•</span><span>Developer menengah yang ingin naik level</span></li>
                            <li class="flex gap-2"><span class="text-indigo-400 shrink-0 mt-0.5">•</span><span>Senior developer / mentor yang ingin berbagi</span></li>
                            <li class="flex gap-2"><span class="text-indigo-400 shrink-0 mt-0.5">•</span><span>Mahasiswa jurusan IT seluruh Indonesia</span></li>
                            <li class="flex gap-2"><span class="text-indigo-400 shrink-0 mt-0.5">•</span><span>Career switcher menuju dunia teknologi</span></li>
                        </ul>
                    </div>

                    {{-- 6. Key Resources — row 2, col 2 --}}
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-5 border border-violet-500/40 flex flex-col">
                        <div class="text-2xl mb-2">🏗️</div>
                        <h3 class="text-sm font-bold text-violet-300 mb-3 uppercase tracking-wide">Sumber Daya Utama</h3>
                        <ul class="space-y-2 text-sm text-gray-300 flex-1">
                            <li class="flex gap-2"><span class="text-violet-400 shrink-0 mt-0.5">•</span><span>Platform teknologi (Laravel, Livewire)</span></li>
                            <li class="flex gap-2"><span class="text-violet-400 shrink-0 mt-0.5">•</span><span>Tim pengajar & mentor</span></li>
                            <li class="flex gap-2"><span class="text-violet-400 shrink-0 mt-0.5">•</span><span>Konten kursus & materi belajar</span></li>
                            <li class="flex gap-2"><span class="text-violet-400 shrink-0 mt-0.5">•</span><span>Brand & reputasi Baricode</span></li>
                            <li class="flex gap-2"><span class="text-violet-400 shrink-0 mt-0.5">•</span><span>Komunitas aktif & loyal</span></li>
                        </ul>
                    </div>

                    {{-- 7. Channels — row 2, col 4 --}}
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-5 border border-cyan-500/40 flex flex-col">
                        <div class="text-2xl mb-2">📡</div>
                        <h3 class="text-sm font-bold text-cyan-300 mb-3 uppercase tracking-wide">Saluran</h3>
                        <ul class="space-y-2 text-sm text-gray-300 flex-1">
                            <li class="flex gap-2"><span class="text-cyan-400 shrink-0 mt-0.5">•</span><span>Platform web app.baricode.org</span></li>
                            <li class="flex gap-2"><span class="text-cyan-400 shrink-0 mt-0.5">•</span><span>Artikel web baricode.org</span></li>
                            <li class="flex gap-2"><span class="text-cyan-400 shrink-0 mt-0.5">•</span><span>Instagram, TikTok, Facebook (pemasaran)</span></li>
                            <li class="flex gap-2"><span class="text-cyan-400 shrink-0 mt-0.5">•</span><span>YouTube (dokumentasi)</span></li>
                            <li class="flex gap-2"><span class="text-cyan-400 shrink-0 mt-0.5">•</span><span>Grup komunitas WhatsApp</span></li>
                            <li class="flex gap-2"><span class="text-cyan-400 shrink-0 mt-0.5">•</span><span>Saluran Telegram (dokumentasi)</span></li>
                        </ul>
                    </div>

                </div>

                {{-- Bottom 2-column row --}}
                <div class="hidden md:grid md:grid-cols-2 gap-3 mb-1 text-center text-xs font-bold uppercase tracking-widest text-gray-500">
                    <div>Struktur Biaya</div>
                    <div>Aliran Pendapatan</div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                    {{-- Cost Structure --}}
                    <div class="bg-gradient-to-br from-rose-600/15 to-transparent backdrop-blur-lg rounded-2xl p-5 border border-rose-500/40 flex flex-col">
                        <div class="text-2xl mb-2">💸</div>
                        <h3 class="text-sm font-bold text-rose-300 mb-3 uppercase tracking-wide md:hidden">Struktur Biaya</h3>
                        <div class="grid grid-cols-2 gap-x-6 gap-y-2">
                            <div class="flex gap-2 text-sm text-gray-300"><span class="text-rose-400 shrink-0 mt-0.5">•</span><span>Infrastruktur server & cloud storage</span></div>
                            <div class="flex gap-2 text-sm text-gray-300"><span class="text-rose-400 shrink-0 mt-0.5">•</span><span>Pengembangan & maintenance platform</span></div>
                            <div class="flex gap-2 text-sm text-gray-300"><span class="text-rose-400 shrink-0 mt-0.5">•</span><span>Produksi konten kursus & materi</span></div>
                            <div class="flex gap-2 text-sm text-gray-300"><span class="text-rose-400 shrink-0 mt-0.5">•</span><span>Honorarium mentor / pengajar</span></div>
                            <div class="flex gap-2 text-sm text-gray-300"><span class="text-rose-400 shrink-0 mt-0.5">•</span><span>Marketing & pertumbuhan komunitas</span></div>
                        </div>
                    </div>

                    {{-- Revenue Streams --}}
                    <div class="bg-gradient-to-br from-emerald-600/15 to-transparent backdrop-blur-lg rounded-2xl p-5 border border-emerald-500/40 flex flex-col">
                        <div class="text-2xl mb-2">💰</div>
                        <h3 class="text-sm font-bold text-emerald-300 mb-3 uppercase tracking-wide md:hidden">Aliran Pendapatan</h3>
                        <div class="grid grid-cols-2 gap-x-6 gap-y-2">
                            <div class="flex gap-2 text-sm text-gray-300"><span class="text-emerald-400 shrink-0 mt-0.5">•</span><span>Akademi intensif berbayar (per batch)</span></div>
                            <div class="flex gap-2 text-sm text-gray-300"><span class="text-emerald-400 shrink-0 mt-0.5">•</span><span>Sponsorship & kemitraan perusahaan</span></div>
                            <div class="flex gap-2 text-sm text-gray-300"><span class="text-emerald-400 shrink-0 mt-0.5">•</span><span>Donasi & dukungan komunitas</span></div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- CTA --}}
        <section class="px-4 py-16">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4 bg-gradient-to-r from-purple-400 via-violet-400 to-indigo-400 bg-clip-text text-transparent">
                    Tertarik bergabung?
                </h2>
                <p class="text-gray-400 mb-8 text-lg">
                    Jadilah bagian dari komunitas IT Indonesia yang tumbuh bersama — gratis, inklusif, dan terbuka untuk semua.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center gap-2 px-8 py-3.5 bg-gradient-to-r from-purple-600 to-violet-600 hover:from-purple-500 hover:to-violet-500 text-white font-semibold rounded-xl transition-all shadow-lg shadow-purple-900/40">
                        Daftar Sekarang
                    </a>
                    <a href="{{ route('about') }}"
                        class="inline-flex items-center justify-center gap-2 px-8 py-3.5 bg-white/5 hover:bg-white/10 border border-white/10 text-gray-300 hover:text-white font-semibold rounded-xl transition-all">
                        Pelajari Tentang Kami
                    </a>
                </div>
            </div>
        </section>

    </div>
</x-layouts.base>
