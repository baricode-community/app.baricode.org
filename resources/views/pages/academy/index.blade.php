<x-layouts.base :title="'Baricode Academy — Belajar Bareng, Tumbuh Bersama'">
    <div>

        {{-- ─────────────────── HERO ─────────────────── --}}
        <section class="relative min-h-[88vh] flex items-center justify-center px-4 py-24 overflow-hidden">
            {{-- Ambient blobs --}}
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-amber-500/10 rounded-full blur-[120px]"></div>
                <div class="absolute bottom-0 right-1/4 w-[400px] h-[400px] bg-orange-500/10 rounded-full blur-[100px]"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] bg-yellow-400/5 rounded-full blur-[80px]"></div>
            </div>

            <div class="max-w-5xl mx-auto text-center relative z-10">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-amber-500/10 border border-amber-400/30 rounded-full text-amber-300 text-sm font-semibold mb-8">
                    <span class="w-2 h-2 bg-amber-400 rounded-full animate-pulse"></span>
                    Program Baru dari Baricode
                </div>

                <h1 class="text-5xl md:text-7xl font-extrabold mb-6 leading-tight">
                    <span class="bg-gradient-to-r from-amber-300 via-orange-300 to-yellow-300 bg-clip-text text-transparent">
                        Baricode Academy
                    </span>
                </h1>

                <p class="text-xl md:text-2xl text-gray-200 font-medium mb-4 max-w-3xl mx-auto">
                    Belajar lebih dalam, bersama kelompok kecil, dipandu instruktur secara langsung.
                </p>
                <p class="text-base text-gray-400 mb-10 max-w-2xl mx-auto">
                    Bukan kursus video biasa. Di sini kamu belajar lewat <span class="text-amber-300">sesi online live private</span> bareng-bareng — tanya jawab langsung, feedback langsung, tumbuh bareng.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#programs"
                        class="px-8 py-4 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 rounded-full font-bold text-base shadow-xl shadow-amber-500/30 transition-all transform hover:scale-105">
                        Lihat Program Tersedia
                    </a>
                    @auth
                        <a href="{{ route('academy.dashboard') }}"
                            class="px-8 py-4 bg-white/10 border border-white/20 hover:bg-white/20 rounded-full font-semibold text-base transition-all">
                            Academy Saya →
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                            class="px-8 py-4 bg-white/10 border border-white/20 hover:bg-white/20 rounded-full font-semibold text-base transition-all">
                            Daftar Akun Gratis
                        </a>
                    @endauth
                </div>

                {{-- Floating badges --}}
                <div class="hidden md:flex justify-center gap-6 mt-16 flex-wrap">
                    @foreach(['👥 Kelompok Kecil', '🎯 Live Session', '▶️ Rekaman YouTube', '🗓️ Jadwal Terstruktur', '🏅 Sertifikat'] as $badge)
                        <span class="px-4 py-2 bg-white/5 border border-white/10 rounded-full text-sm text-gray-300">
                            {{ $badge }}
                        </span>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ─────────────────── BEDANYA APA ─────────────────── --}}
        <section class="py-20 px-4">
            <div class="max-w-5xl mx-auto">
                <div class="text-center mb-14">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-3">Bedanya dari Kursus Biasa?</h2>
                    <p class="text-gray-400">LMS & Bimbingan di Baricode sudah gratis. Academy beda lagi.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-6 text-center opacity-70">
                        <div class="text-4xl mb-3">📚</div>
                        <h3 class="font-bold text-white mb-2">Kursus (LMS)</h3>
                        <p class="text-sm text-gray-400">Belajar mandiri, kapan saja, materi video + teks. Cocok untuk eksplorasi topik.</p>
                        <p class="text-xs text-green-400 mt-3 font-semibold">✓ Gratis</p>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-2xl p-6 text-center opacity-70">
                        <div class="text-4xl mb-3">🤝</div>
                        <h3 class="font-bold text-white mb-2">Bimbingan</h3>
                        <p class="text-sm text-gray-400">Mentoring personal dari anggota komunitas berpengalaman. Fleksibel dan personal.</p>
                        <p class="text-xs text-green-400 mt-3 font-semibold">✓ Gratis</p>
                    </div>

                    <div class="relative bg-gradient-to-br from-amber-950/60 to-orange-950/40 border-2 border-amber-400/60 rounded-2xl p-6 text-center shadow-xl shadow-amber-500/20">
                        <div class="absolute -top-3 left-1/2 -translate-x-1/2 px-3 py-1 bg-gradient-to-r from-amber-500 to-orange-500 rounded-full text-xs font-bold shadow">
                            ⭐ Academy
                        </div>
                        <div class="text-4xl mb-3 mt-2">🎓</div>
                        <h3 class="font-bold text-amber-300 mb-2">Academy</h3>
                        <p class="text-sm text-gray-300">Sesi live online private bersama kelompok kecil + instruktur. Intensif dan terstruktur per batch.</p>
                        <p class="text-xs text-amber-400 mt-3 font-semibold">⚡ Berbayar · Kuota Terbatas</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ─────────────────── HOW IT WORKS ─────────────────── --}}
        <section class="py-20 px-4 relative">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-14">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-3">Gimana Cara Kerjanya?</h2>
                    <p class="text-gray-400">Simple. Daftar, bayar, join sesi, berkembang.</p>
                </div>

                <div class="space-y-4">
                    @foreach([
                        ['01', 'Pilih Program & Batch', 'Lihat program yang tersedia dan pilih batch yang cocok dengan jadwalmu. Setiap batch punya kuota terbatas.', 'from-amber-500 to-orange-500'],
                        ['02', 'Daftar & Selesaikan Pembayaran', 'Bayar via Midtrans — support VA, QRIS, kartu kredit, dan lebih. Proses cepat, aman, dan terkonfirmasi otomatis.', 'from-orange-500 to-red-500'],
                        ['03', 'Ikuti Sesi Live Online', 'Setiap sesi ada link meeting yang akan dibagikan. Join tepat waktu, tanya bebas, interaksi langsung dengan instruktur dan peserta lain.', 'from-amber-400 to-yellow-500'],
                        ['04', 'Akses Rekaman YouTube', 'Ketinggalan sesi? Tenang. Rekaman tersedia eksklusif di YouTube untuk peserta terdaftar, bisa diulang kapan saja.', 'from-yellow-500 to-amber-400'],
                    ] as [$num, $title, $desc, $gradient])
                        <div class="flex gap-5 items-start bg-white/5 border border-white/10 rounded-2xl p-5 hover:border-amber-500/30 transition-colors">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br {{ $gradient }} flex items-center justify-center text-base font-extrabold shrink-0">
                                {{ $num }}
                            </div>
                            <div>
                                <h3 class="font-bold text-white mb-1">{{ $title }}</h3>
                                <p class="text-sm text-gray-400">{{ $desc }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ─────────────────── PROGRAMS ─────────────────── --}}
        <section id="programs" class="py-20 px-4">
            <div class="max-w-5xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-3">Program Tersedia</h2>
                    <p class="text-gray-400">Pilih program yang sesuai dengan tujuan belajarmu.</p>
                </div>

                @if($programs->isEmpty())
                    <div class="text-center py-20 bg-white/5 border border-white/10 rounded-3xl">
                        <div class="text-6xl mb-4">🚀</div>
                        <p class="text-gray-300 font-semibold text-lg mb-2">Program segera hadir!</p>
                        <p class="text-gray-500 text-sm">Kami sedang mempersiapkan program perdana. Pantau terus updatenya.</p>
                        @auth
                            <p class="text-amber-400 text-sm mt-4">Kamu akan notifikasi saat program pertama dibuka.</p>
                        @else
                            <a href="{{ route('register') }}"
                                class="inline-block mt-6 px-6 py-2.5 bg-amber-600 hover:bg-amber-500 rounded-full text-sm font-semibold transition-colors">
                                Daftar untuk dapat update pertama
                            </a>
                        @endauth
                    </div>
                @else
                    <div class="grid gap-6 md:grid-cols-2">
                        @foreach($programs as $program)
                            <a href="{{ route('academy.show', $program->uuid) }}"
                                class="group block bg-white/5 border border-white/10 rounded-2xl overflow-hidden hover:border-amber-500/50 hover:shadow-xl hover:shadow-amber-500/10 transition-all">

                                @if($program->thumbnail)
                                    <div class="h-44 overflow-hidden">
                                        <img src="{{ $program->thumbnail }}" alt="{{ $program->title }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                @else
                                    <div class="h-44 bg-gradient-to-br from-amber-900/50 to-orange-900/30 flex items-center justify-center">
                                        <span class="text-6xl">🎓</span>
                                    </div>
                                @endif

                                <div class="p-6">
                                    <h3 class="text-lg font-bold text-white mb-2 group-hover:text-amber-300 transition-colors">
                                        {{ $program->title }}
                                    </h3>
                                    @if($program->description)
                                        <p class="text-gray-400 text-sm line-clamp-2 mb-4">{{ $program->description }}</p>
                                    @endif
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500">
                                            {{ $program->activeBatches->count() }} batch tersedia
                                        </span>
                                        <span class="text-amber-400 font-semibold group-hover:translate-x-1 transition-transform inline-block">
                                            Lihat detail →
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif

                @auth
                    <div class="mt-8 text-center">
                        <a href="{{ route('academy.dashboard') }}"
                            class="text-amber-400 hover:text-amber-300 text-sm underline underline-offset-4 transition-colors">
                            Lihat Academy yang sudah kamu ikuti →
                        </a>
                    </div>
                @endauth
            </div>
        </section>

        {{-- ─────────────────── FAQ ─────────────────── --}}
        <section class="py-20 px-4">
            <div class="max-w-3xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-extrabold text-white mb-3">Pertanyaan Umum</h2>
                </div>

                <div class="space-y-3" x-data="{ open: null }">
                    @foreach([
                        ['1', 'Apakah ini berbeda dari LMS & Bimbingan yang sudah gratis?', 'Ya, berbeda. LMS dan Bimbingan tetap gratis seperti biasa. Academy adalah program berbayar dengan format live session kelompok kecil — lebih intensif, ada jadwal tetap, dan interaksi langsung dengan instruktur.'],
                        ['2', 'Kenapa berbayar?', 'Karena instruktur menyiapkan materi, hadir langsung di setiap sesi, dan memberikan feedback personal. Biaya ini untuk menghargai waktu dan tenaga instruktur agar kualitas tetap terjaga.'],
                        ['3', 'Bagaimana jika saya tidak bisa hadir di salah satu sesi?', 'Rekaman setiap sesi akan diunggah ke YouTube dan bisa diakses kapan saja oleh peserta yang terdaftar. Tapi disarankan untuk hadir langsung agar bisa tanya jawab.'],
                        ['4', 'Berapa kuota per batch?', 'Setiap batch punya kuota terbatas yang ditentukan per program. Ini sengaja agar sesi lebih kondusif dan instruktur bisa fokus ke setiap peserta.'],
                        ['5', 'Metode pembayaran apa yang tersedia?', 'Kami menggunakan Midtrans — tersedia Virtual Account semua bank, QRIS, kartu kredit/debit, dan berbagai e-wallet. Konfirmasi otomatis setelah pembayaran berhasil.'],
                    ] as [$id, $q, $a])
                        <div class="bg-white/5 border border-white/10 hover:border-amber-500/30 rounded-2xl overflow-hidden transition-colors">
                            <button @click="open = open === {{ $id }} ? null : {{ $id }}"
                                class="w-full flex items-center justify-between p-5 text-left font-semibold text-sm">
                                <span>{{ $q }}</span>
                                <span class="text-amber-400 transition-transform duration-300 shrink-0 ml-3" :class="open === {{ $id }} ? 'rotate-45' : ''">+</span>
                            </button>
                            <div x-show="open === {{ $id }}" x-transition class="px-5 pb-5 text-gray-400 text-sm leading-relaxed">
                                {{ $a }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ─────────────────── CTA BOTTOM ─────────────────── --}}
        <section class="py-20 px-4">
            <div class="max-w-3xl mx-auto text-center">
                <div class="relative bg-gradient-to-br from-amber-950/60 to-orange-950/40 border border-amber-500/30 rounded-3xl p-10 md:p-14 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-amber-500/5 via-transparent to-orange-500/5 pointer-events-none"></div>
                    <div class="relative z-10">
                        <div class="text-5xl mb-6">🎓</div>
                        <h2 class="text-3xl font-extrabold text-white mb-4">Siap Belajar Lebih Serius?</h2>
                        <p class="text-gray-300 mb-8 text-base">
                            Bergabunglah dengan Baricode Academy dan rasakan perbedaan belajar bareng komunitas yang terstruktur dan dipandu langsung.
                        </p>
                        <a href="#programs"
                            class="inline-block px-10 py-4 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 rounded-full font-bold text-base shadow-lg shadow-amber-500/30 transition-all transform hover:scale-105">
                            Daftar Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </div>
</x-layouts.base>
