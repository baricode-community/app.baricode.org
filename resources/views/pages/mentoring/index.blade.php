<x-layouts.base :title="'Baricode Mentoring — Bimbingan Personal dari Komunitas'">
    <div>

        {{-- ─────────────────── HERO ─────────────────── --}}
        <section class="relative min-h-[88vh] flex items-center justify-center px-4 py-24 overflow-hidden">
            {{-- Ambient blobs --}}
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-purple-500/10 rounded-full blur-[120px]"></div>
                <div class="absolute bottom-0 right-1/4 w-[400px] h-[400px] bg-violet-500/10 rounded-full blur-[100px]"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] bg-indigo-400/5 rounded-full blur-[80px]"></div>
            </div>

            <div class="max-w-5xl mx-auto text-center relative z-10">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-purple-500/10 border border-purple-400/30 rounded-full text-purple-300 text-sm font-semibold mb-8">
                    <span class="w-2 h-2 bg-purple-400 rounded-full animate-pulse"></span>
                    Gratis dari Komunitas Baricode
                </div>

                <h1 class="text-5xl md:text-7xl font-extrabold mb-6 leading-tight">
                    <span class="bg-gradient-to-r from-purple-300 via-violet-300 to-indigo-300 bg-clip-text text-transparent">
                        Baricode Mentoring
                    </span>
                </h1>

                <p class="text-xl md:text-2xl text-gray-200 font-medium mb-4 max-w-3xl mx-auto">
                    Belajar bareng di grup WhatsApp, dipantau langsung oleh mentor kami.
                </p>
                <p class="text-base text-gray-400 mb-10 max-w-2xl mx-auto">
                    Bukan kelas, bukan kursus. Di sini kamu masuk ke <span class="text-purple-300">grup WhatsApp bimbingan</span>, dan mentor kami aktif <span class="text-purple-300">memantau serta mencatat progres belajarmu</span> — supaya kamu nggak belajar sendirian dan tetap di jalur yang benar. Semuanya <span class="text-green-400 font-semibold">gratis</span>.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#programs"
                        class="px-8 py-4 bg-gradient-to-r from-purple-500 to-violet-500 hover:from-purple-400 hover:to-violet-400 rounded-full font-bold text-base shadow-xl shadow-purple-500/30 transition-all transform hover:scale-105">
                        Lihat Program Tersedia
                    </a>
                    @auth
                        <a href="{{ route('mentoring.dashboard') }}"
                            class="px-8 py-4 bg-white/10 border border-white/20 hover:bg-white/20 rounded-full font-semibold text-base transition-all">
                            Bimbingan Saya →
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
                    @foreach(['🆓 Sepenuhnya Gratis', '💬 Grup WhatsApp', '📊 Progres Dipantau', '🎯 Terarah & Terstruktur', '👥 Belajar Bareng', '🚀 Nggak Belajar Sendirian'] as $badge)
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
                    <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-3">Bedanya dari Kursus & Academy?</h2>
                    <p class="text-gray-400">Tiga cara belajar di Baricode — masing-masing punya peran berbeda.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-6 text-center opacity-70">
                        <div class="text-4xl mb-3">📚</div>
                        <h3 class="font-bold text-white mb-2">Kursus (LMS)</h3>
                        <p class="text-sm text-gray-400">Belajar mandiri, kapan saja, lewat materi video + teks. Cocok untuk eksplorasi topik baru.</p>
                        <p class="text-xs text-green-400 mt-3 font-semibold">✓ Gratis</p>
                    </div>

                    <div class="relative bg-gradient-to-br from-purple-950/60 to-violet-950/40 border-2 border-purple-400/60 rounded-2xl p-6 text-center shadow-xl shadow-purple-500/20">
                        <div class="absolute -top-3 left-1/2 -translate-x-1/2 px-3 py-1 bg-gradient-to-r from-purple-500 to-violet-500 rounded-full text-xs font-bold shadow">
                            ⭐ Mentoring
                        </div>
                        <div class="text-4xl mb-3 mt-2">🤝</div>
                        <h3 class="font-bold text-purple-300 mb-2">Bimbingan</h3>
                        <p class="text-sm text-gray-300">Belajar di grup WhatsApp bersama peserta lain, dipantau mentor yang aktif mencatat dan memantau progres belajarmu.</p>
                        <p class="text-xs text-green-400 mt-3 font-semibold">✓ Sepenuhnya Gratis</p>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-2xl p-6 text-center opacity-70">
                        <div class="text-4xl mb-3">🎓</div>
                        <h3 class="font-bold text-white mb-2">Academy</h3>
                        <p class="text-sm text-gray-400">Sesi live online bersama kelompok kecil + instruktur. Intensif dan terstruktur per batch.</p>
                        <div class="flex justify-center gap-2 mt-3 flex-wrap">
                            <span class="text-xs text-green-400 font-semibold">✓ Ada yang Gratis</span>
                            <span class="text-gray-600">·</span>
                            <span class="text-xs text-amber-400 font-semibold">⚡ Ada yang Berbayar</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ─────────────────── HOW IT WORKS ─────────────────── --}}
        <section class="py-20 px-4 relative">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-14">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-3">Gimana Cara Kerjanya?</h2>
                    <p class="text-gray-400">Empat langkah sederhana untuk mulai dibimbing.</p>
                </div>

                <div class="space-y-4">
                    @foreach([
                        ['01', 'Pilih Program Bimbingan', 'Lihat program yang tersedia, baca deskripsi dan tujuannya. Pilih yang paling sesuai dengan kondisi dan target belajarmu saat ini.', 'from-purple-500 to-violet-500'],
                        ['02', 'Daftar Program', 'Klik tombol daftar — langsung terdaftar, tanpa biaya, tanpa proses rumit. Cukup akun Baricode yang sudah terverifikasi.', 'from-violet-500 to-indigo-500'],
                        ['03', 'Masuk Grup WhatsApp', 'Setelah mendaftar, kamu akan dimasukkan ke grup WhatsApp khusus program tersebut bersama peserta lain dan mentor yang bertugas.', 'from-indigo-500 to-purple-400'],
                        ['04', 'Belajar & Dipantau Mentormu', 'Mentor aktif memantau perkembangan belajarmu, mencatat progres, dan memastikan kamu tetap di jalur yang benar. Tanya, diskusi, dan berkembang bersama.', 'from-purple-400 to-violet-400'],
                    ] as [$num, $title, $desc, $gradient])
                        <div class="flex gap-5 items-start bg-white/5 border border-white/10 rounded-2xl p-5 hover:border-purple-500/30 transition-colors">
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
                    <p class="text-gray-400">Pilih program yang sesuai dengan tujuan dan kondisimu.</p>
                </div>

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-900/40 border border-red-700 rounded-xl text-red-300 text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                @if($programs->isEmpty())
                    <div class="text-center py-20 bg-white/5 border border-white/10 rounded-3xl">
                        <div class="text-6xl mb-4">🤝</div>
                        <p class="text-gray-300 font-semibold text-lg mb-2">Program segera hadir!</p>
                        <p class="text-gray-500 text-sm">Kami sedang mempersiapkan program bimbingan perdana. Pantau terus updatenya.</p>
                        @guest
                            <a href="{{ route('register') }}"
                                class="inline-block mt-6 px-6 py-2.5 bg-purple-600 hover:bg-purple-500 rounded-full text-sm font-semibold transition-colors">
                                Daftar untuk dapat update pertama
                            </a>
                        @endguest
                    </div>
                @else
                    <div class="grid gap-6 md:grid-cols-2">
                        @foreach($programs as $program)
                            <div class="bg-white/5 border border-white/10 rounded-2xl p-6 hover:border-purple-500/40 hover:shadow-xl hover:shadow-purple-500/10 transition-all">
                                <div class="flex items-start gap-4 mb-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500/20 to-violet-500/20 border border-purple-500/20 flex items-center justify-center text-2xl shrink-0">
                                        🤝
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 flex-wrap mb-1">
                                            <h3 class="text-lg font-bold text-white">{{ $program->title }}</h3>
                                            @if($program->is_open)
                                                <span class="px-2 py-0.5 bg-green-500/15 text-green-400 text-xs font-semibold rounded-full border border-green-500/30">Buka</span>
                                            @else
                                                <span class="px-2 py-0.5 bg-gray-500/15 text-gray-400 text-xs font-semibold rounded-full border border-gray-500/30">Tutup</span>
                                            @endif
                                        </div>
                                        <span class="text-xs text-green-400 font-semibold">✓ Gratis</span>
                                    </div>
                                </div>

                                @if($program->description)
                                    <p class="text-gray-400 text-sm mb-3 leading-relaxed">{{ $program->description }}</p>
                                @endif

                                @if($program->goals)
                                    <div class="flex items-start gap-2 mb-4 p-3 bg-purple-500/5 border border-purple-500/15 rounded-xl">
                                        <span class="text-purple-400 text-xs font-bold mt-0.5 shrink-0">TARGET</span>
                                        <p class="text-gray-300 text-sm">{{ $program->goals }}</p>
                                    </div>
                                @endif

                                @auth
                                    @if($program->is_open)
                                        <form action="{{ route('mentoring.apply') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="mentoring_program_id" value="{{ $program->id }}">
                                            <button type="submit"
                                                class="w-full px-5 py-2.5 bg-gradient-to-r from-purple-600 to-violet-600 hover:from-purple-500 hover:to-violet-500 rounded-xl font-semibold text-sm shadow-lg shadow-purple-500/20 transition-all">
                                                Daftar Bimbingan
                                            </button>
                                        </form>
                                    @else
                                        <button disabled
                                            class="w-full px-5 py-2.5 bg-gray-700/50 rounded-xl font-semibold text-sm text-gray-500 cursor-not-allowed">
                                            Pendaftaran Ditutup
                                        </button>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}"
                                        class="block w-full text-center px-5 py-2.5 bg-white/10 border border-white/20 hover:bg-white/20 rounded-xl font-semibold text-sm transition-all">
                                        Login untuk Daftar
                                    </a>
                                @endauth
                            </div>
                        @endforeach
                    </div>
                @endif

                @auth
                    <div class="mt-8 text-center">
                        <a href="{{ route('mentoring.dashboard') }}"
                            class="text-purple-400 hover:text-purple-300 text-sm underline underline-offset-4 transition-colors">
                            Lihat bimbingan yang sudah kamu ikuti →
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
                        ['1', 'Apakah bimbingan ini benar-benar gratis?', 'Ya, sepenuhnya gratis. Tidak ada biaya pendaftaran maupun biaya selama program berlangsung.'],
                        ['2', 'Bimbingan dilakukan di mana?', 'Bimbingan dilakukan via grup WhatsApp. Setelah mendaftar, kamu akan dimasukkan ke grup bersama peserta lain dan mentor yang bertugas di program tersebut.'],
                        ['3', 'Apa yang dilakukan mentor di grup?', 'Mentor aktif memantau aktivitas belajarmu, mencatat progres setiap peserta, dan memastikan kamu tidak tertinggal atau keluar jalur. Kamu bisa tanya, diskusi, dan lapor perkembangan langsung di grup.'],
                        ['4', 'Berapa lama program bimbingan berlangsung?', 'Durasi bervariasi tergantung program. Baca deskripsi dan target setiap program untuk gambaran lebih jelasnya.'],
                        ['5', 'Apakah saya bisa ikut lebih dari satu program?', 'Bisa, selama program yang kamu tuju masih buka. Pastikan kamu punya cukup waktu dan komitmen untuk aktif di semua program yang kamu ikuti.'],
                    ] as [$id, $q, $a])
                        <div class="bg-white/5 border border-white/10 hover:border-purple-500/30 rounded-2xl overflow-hidden transition-colors">
                            <button @click="open = open === {{ $id }} ? null : {{ $id }}"
                                class="w-full flex items-center justify-between p-5 text-left font-semibold text-sm">
                                <span>{{ $q }}</span>
                                <span class="text-purple-400 transition-transform duration-300 shrink-0 ml-3" :class="open === {{ $id }} ? 'rotate-45' : ''">+</span>
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
                <div class="relative bg-gradient-to-br from-purple-950/60 to-violet-950/40 border border-purple-500/30 rounded-3xl p-10 md:p-14 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-500/5 via-transparent to-violet-500/5 pointer-events-none"></div>
                    <div class="relative z-10">
                        <div class="text-5xl mb-6">🤝</div>
                        <h2 class="text-3xl font-extrabold text-white mb-4">Siap Belajar dengan Bimbingan?</h2>
                        <p class="text-gray-300 mb-8 text-base">
                            Bergabunglah ke grup WhatsApp bimbingan kami. Belajar terarah, progres dipantau, dan kamu nggak sendirian. Semua gratis.
                        </p>
                        <a href="#programs"
                            class="inline-block px-10 py-4 bg-gradient-to-r from-purple-500 to-violet-500 hover:from-purple-400 hover:to-violet-400 rounded-full font-bold text-base shadow-lg shadow-purple-500/30 transition-all transform hover:scale-105">
                            Lihat Program Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </div>
</x-layouts.base>
