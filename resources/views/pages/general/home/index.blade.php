<x-layouts.base :title="__('Komunitas IT Keren di Indonesia')">
    <div class="">
        <!-- Hero Section -->
        <section class="relative min-h-screen flex items-center justify-center px-4 py-20">
            <!-- Floating Memes -->
            <div class="hidden md:absolute md:block top-20 left-10 animate-bounce delay-100">
                <div class="bg-purple-500/20 backdrop-blur-lg rounded-3xl p-4 text-4xl">😎</div>
            </div>
            <div class="hidden md:absolute md:block top-40 right-20 animate-bounce delay-300">
                <div class="bg-indigo-500/20 backdrop-blur-lg rounded-3xl p-4 text-4xl">🚀</div>
            </div>
            <div class="hidden md:absolute md:block bottom-40 left-20 animate-bounce delay-500">
                <div class="bg-violet-500/20 backdrop-blur-lg rounded-3xl p-4 text-4xl">💻</div>
            </div>

            <div class="max-w-7xl mx-auto text-center z-10">
                <h1
                    class="text-4xl md:text-6xl font-extrabold mb-8 bg-gradient-to-r from-purple-400 via-violet-400 to-indigo-400 bg-clip-text text-transparent drop-shadow-lg">
                    Komunitas IT Keren di Indonesia<br />
                    <span
                        class="block text-2xl md:text-4xl font-bold mt-2 bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text text-transparent animate-gradient-x">
                        Bersama Bertumbuh, Belajar, dan Berbagi
                    </span>
                </h1>
                <p class="text-lg md:text-xl text-gray-200 mb-8 max-w-3xl mx-auto font-medium drop-shadow">
                    Bangun proyek bareng, ikut tantangan harian, dan berkembang bersama komunitas developer yang
                    positif.
                </p>
                <p class="text-base text-gray-400 mb-8 max-w-2xl mx-auto italic">
                    Kami berbasis komunitas, jadi ada banyak fitur menarik yang tersedia khusus untuk kamu.<br>
                    <span class="font-semibold text-purple-300">Yuk, eksplorasi dan manfaatkan semua fiturnya!</span>
                </p>

                <!-- Two Learning Approach Cards -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-10 max-w-2xl mx-auto">
                    <div class="flex-1 bg-gradient-to-br from-purple-500/20 to-indigo-500/10 backdrop-blur-lg rounded-2xl p-5 border border-purple-500/30 text-left hover:border-purple-400/60 transition-all">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-500 to-indigo-500 flex items-center justify-center text-xl shrink-0">📚</div>
                            <h3 class="font-bold text-base text-white">Kursus</h3>
                        </div>
                        <p class="text-sm text-gray-300">Belajar mandiri dengan materi terstruktur, dari pemula hingga mahir. Gratis untuk semua member.</p>
                    </div>
                    <div class="flex-1 bg-gradient-to-br from-violet-500/20 to-purple-500/10 backdrop-blur-lg rounded-2xl p-5 border border-violet-500/30 text-left hover:border-violet-400/60 transition-all">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-purple-500 flex items-center justify-center text-xl shrink-0">🤝</div>
                            <h3 class="font-bold text-base text-white">Bimbingan</h3>
                        </div>
                        <p class="text-sm text-gray-300">Mentoring personal dari anggota komunitas berpengalaman. Belajar lebih cepat dengan pendampingan langsung.</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-20">
                    <a href="{{ route('dashboard') }}" wire:navigate
                        class="px-10 py-4 bg-gradient-to-r from-purple-600 via-violet-600 to-indigo-600 rounded-full font-bold text-base shadow-lg hover:shadow-purple-500/40 transition-all transform hover:scale-105 flex items-center justify-center ring-2 ring-purple-400/30 hover:ring-4 hover:ring-indigo-400/40">
                        🚀 Gabung Gratis
                    </a>
                    <a href="{{ route('lms.courses') }}" wire:navigate
                        class="px-10 py-4 bg-white/10 backdrop-blur-lg rounded-full font-semibold text-base border border-white/20 hover:bg-white/20 transition-all flex items-center justify-center ring-1 ring-white/10 hover:ring-2 hover:ring-purple-300/30">
                        👀 Dapatkan Kursus Gratis
                    </a>
                </div>
            </div>
        </section>


        <!-- TikTok Section -->
        <section class="py-20 px-4 relative">
            <div class="max-w-6xl mx-auto">
                <div
                    class="bg-gradient-to-r from-black/40 via-slate-900/40 to-black/40 backdrop-blur-xl rounded-3xl p-12 border border-slate-700/30 overflow-hidden relative">
                    <!-- Animated background elements -->
                    <div
                        class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-bl from-pink-500/20 to-transparent rounded-full blur-3xl -mr-48 -mt-48">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-tr from-purple-500/20 to-transparent rounded-full blur-3xl -ml-48 -mb-48">
                    </div>

                    <div class="relative z-10">
                        <div class="text-center mb-12">
                            <div class="inline-block mb-6">
                                <div class="text-7xl animate-bounce">🎵</div>
                            </div>
                            <h2
                                class="text-3xl md:text-4xl font-extrabold mb-6 bg-gradient-to-r from-pink-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">
                                Ikuti Baricode di TikTok!</h2>
                            <p class="text-lg md:text-xl text-gray-100 font-semibold mb-4">
                                Konten Coding yang Seru dan Menghibur
                            </p>
                            <p class="text-base text-gray-300 max-w-3xl mx-auto">
                                Tutorial coding dengan gaya yang fun dan engaging. Dari tips & trik programming, project
                                walkthroughs, hingga meme tentang developer. Semua ada di TikTok Baricode!
                            </p>
                        </div>

                        <div class="text-center">
                            <a href="https://www.tiktok.com/@baricode_org" target="_blank" rel="noopener noreferrer"
                                class="inline-block px-10 py-4 bg-gradient-to-r from-pink-600 via-purple-600 to-pink-600 rounded-full font-bold text-base shadow-lg hover:shadow-pink-500/40 transition-all transform hover:scale-105 ring-2 ring-pink-400/30 hover:ring-4 hover:ring-purple-400/40">
                                🎵 Follow Baricode di TikTok
                            </a>
                            <p class="text-sm text-gray-400 mt-4">Konten baru secara rutin • Jangan ketinggalan updates
                                terbaru!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Family Section -->
        <section class="py-20 px-4 relative">
            <div class="max-w-6xl mx-auto">
                <div class="bg-gradient-to-br from-indigo-600/30 via-purple-600/30 to-violet-600/30 backdrop-blur-xl rounded-3xl p-8 md:p-16 border border-indigo-500/30">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                        <!-- Left: Content -->
                        <div>
                            <div class="mb-6">
                                <span class="inline-block px-4 py-2 bg-indigo-500/30 border border-indigo-400/50 rounded-full text-indigo-300 font-semibold text-sm">
                                    👨‍👩‍👧‍👦 Keluarga Baricode
                                </span>
                            </div>
                            <h2 class="text-3xl md:text-4xl font-extrabold mb-6 bg-gradient-to-r from-indigo-400 via-purple-400 to-violet-400 bg-clip-text text-transparent">
                                Bergabunglah dengan Keluarga Kami
                            </h2>
                            <p class="text-lg text-gray-200 mb-6 leading-relaxed">
                                Setiap anggota yang terdaftar secara otomatis menjadi bagian dari <span class="font-semibold text-indigo-300">Keluarga Baricode</span>. Profil kamu akan ditampilkan di direktori komunitas dan dapat dilihat oleh semua member.
                            </p>
                            <p class="text-base text-gray-300 mb-8">
                                Temui ratusan developer lainnya, lihat progress mereka, dan jalin koneksi yang bermakna dalam komunitas yang positif dan saling mendukung.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="{{ route('family.index') }}" class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl font-semibold text-base hover:shadow-2xl hover:shadow-indigo-500/40 transition-all transform hover:scale-105 text-center">
                                    👥 Lihat Keluarga
                                </a>
                                <a href="{{ route('register') }}" class="px-8 py-4 bg-white/10 border border-white/20 rounded-xl font-semibold text-base hover:bg-white/20 transition-all transform hover:scale-105 text-center">
                                    ✨ Daftar Sekarang
                                </a>
                            </div>
                        </div>

                        <!-- Right: Stats -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white/5 backdrop-blur-sm border border-indigo-500/30 rounded-xl p-6 text-center hover:bg-white/10 transition-all">
                                <div class="text-3xl font-extrabold text-indigo-400 mb-2">
                                    {{ \App\Models\User::count() }}
                                </div>
                                <p class="text-gray-300 font-semibold text-sm">
                                    Anggota Terdaftar
                                </p>
                            </div>
                            <div class="bg-white/5 backdrop-blur-sm border border-purple-500/30 rounded-xl p-6 text-center hover:bg-white/10 transition-all">
                                <div class="text-3xl font-extrabold text-purple-400 mb-2">
                                    100%
                                </div>
                                <p class="text-gray-300 font-semibold text-sm">
                                    Transparan
                                </p>
                            </div>
                            <div class="bg-white/5 backdrop-blur-sm border border-violet-500/30 rounded-xl p-6 text-center hover:bg-white/10 transition-all">
                                <div class="text-3xl font-extrabold text-violet-400 mb-2">
                                    🌍
                                </div>
                                <p class="text-gray-300 font-semibold text-sm">
                                    Indonesia
                                </p>
                            </div>
                            <div class="bg-white/5 backdrop-blur-sm border border-pink-500/30 rounded-xl p-6 text-center hover:bg-white/10 transition-all">
                                <div class="text-3xl font-extrabold text-pink-400 mb-2">
                                    ❤️
                                </div>
                                <p class="text-gray-300 font-semibold text-sm">
                                    Community-Driven
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Feature Highlight Section -->
        <section class="py-10 px-4 relative">
            <div class="max-w-3xl mx-auto text-center">
                <div class="mb-8">
                    <span
                        class="inline-block px-6 py-2 bg-gradient-to-r from-purple-500 to-indigo-500 text-white font-semibold rounded-full text-base shadow">
                        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold mb-8">Jangan Biarkan Waktumu Tanpa Berkomunitas</h2>
                <p class="text-lg text-gray-200 mb-6 font-medium">
                    Karena ibarat lidi pada sapu, jika sendiri maka rapuh namun jika bersama maka sangat kuat.
                </p>
                <p class="text-base text-purple-300 font-semibold mb-10">
                    Mari gabung ke komunitas terkece, keren, dan terbesar (secara bertahap) se-Indonesia!
                </p>
                <a href="{{ route('dashboard') }}"
                    class="px-10 py-4 bg-gradient-to-r from-purple-600 via-violet-600 to-indigo-600 rounded-full font-bold text-base shadow-lg hover:shadow-purple-500/40 transition-all transform hover:scale-105 flex items-center justify-center ring-2 ring-purple-400/30 hover:ring-4 hover:ring-indigo-400/40">
                    🚀 Gabung Sekarang
                </a>
            </div>
        </section>

        <!-- Community Commitment Section -->
        <section class="py-10 px-4 relative">
            <div class="max-w-6xl mx-auto">
                <div
                    class="bg-gradient-to-r from-purple-600/30 via-violet-600/30 to-indigo-600/30 backdrop-blur-xl rounded-3xl p-12 border border-purple-500/30">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl md:text-4xl font-extrabold mb-6">Kami Berkomitmen</h2>
                        <p class="text-lg md:text-xl text-gray-100 font-semibold mb-4">
                            Mengembangkan Komunitas dengan Mewujudkan Transparansi Progress Komunitas
                        </p>
                        <p class="text-base text-purple-200 italic">
                            Kami menampilkan dengan jelas status setiap proyek dan inisiatif komunitas
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Dalam Proses -->
                        <div
                            class="bg-white/5 backdrop-blur-lg rounded-2xl p-8 border border-blue-500/30 hover:border-blue-500/60 transition-all hover:shadow-xl hover:shadow-blue-500/20">
                            <div class="flex items-center gap-3 mb-4">
                                <div
                                    class="w-12 h-12 rounded-full bg-gradient-to-r from-blue-500 to-cyan-500 flex items-center justify-center text-2xl">
                                    ⚙️</div>
                                <h3 class="text-xl font-bold">Dalam Proses</h3>
                            </div>
                            <p class="text-gray-300 text-sm mb-6">Proyek dan fitur yang sedang dikerjakan oleh tim dan komunitas
                            </p>
                            <div class="bg-blue-500/20 rounded-lg p-4">
                                <p class="text-blue-200 font-semibold text-sm">{{ $timelines['ongoing'] }} Proyek Aktif</p>
                                <p class="text-sm text-blue-300 mt-2">Platform terus berkembang sesuai kebutuhan
                                    komunitas</p>
                            </div>
                        </div>

                        <!-- Ditunda -->
                        <div
                            class="bg-white/5 backdrop-blur-lg rounded-2xl p-8 border border-yellow-500/30 hover:border-yellow-500/60 transition-all hover:shadow-xl hover:shadow-yellow-500/20">
                            <div class="flex items-center gap-3 mb-4">
                                <div
                                    class="w-12 h-12 rounded-full bg-gradient-to-r from-yellow-500 to-orange-500 flex items-center justify-center text-2xl">
                                    ⏸️</div>
                                <h3 class="text-xl font-bold">Ditunda</h3>
                            </div>
                            <p class="text-gray-300 text-sm mb-6">Fitur atau proyek yang sementara dihentikan dengan alasan
                                tertentu</p>
                            <div class="bg-yellow-500/20 rounded-lg p-4">
                                <p class="text-yellow-200 font-semibold text-sm">{{ $timelines['planned'] }} Item Ditunda</p>
                                <p class="text-sm text-yellow-300 mt-2">Akan dilanjutkan ketika kondisi memungkinkan</p>
                            </div>
                        </div>

                        <!-- Selesai -->
                        <div
                            class="bg-white/5 backdrop-blur-lg rounded-2xl p-8 border border-green-500/30 hover:border-green-500/60 transition-all hover:shadow-xl hover:shadow-green-500/20">
                            <div class="flex items-center gap-3 mb-4">
                                <div
                                    class="w-12 h-12 rounded-full bg-gradient-to-r from-green-500 to-emerald-500 flex items-center justify-center text-2xl">
                                    ✅</div>
                                <h3 class="text-xl font-bold">Selesai</h3>
                            </div>
                            <p class="text-gray-300 text-sm mb-6">Fitur dan proyek yang telah berhasil dikerjakan dan
                                diluncurkan</p>
                            <div class="bg-green-500/20 rounded-lg p-4">
                                <p class="text-green-200 font-semibold text-sm">{{ $timelines['completed'] }} Selesai</p>
                                <p class="text-sm text-green-300 mt-2">Terus berkembang dan berinovasi untuk komunitas
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 text-center">
                        <p class="text-gray-200 text-sm mb-6">
                            Dengan transparansi ini, kami membuktikan bahwa <span
                                class="text-purple-300 font-bold">Kami Aktif!</span> dan terus bergerak maju untuk
                            memberikan yang terbaik bagi komunitas.
                        </p>
                        <a href="{{ route('timeline.index') }}" wire:navigate
                            class="inline-block px-8 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-full font-bold text-base shadow-lg hover:shadow-purple-500/40 transition-all transform hover:scale-105 ring-2 ring-purple-400/30 hover:ring-4 hover:ring-indigo-400/40">
                            📊 Lihat Transparansi Lengkap
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- How to Learn Guide CTA -->
        <section class="py-16 px-4 relative">
            <div class="max-w-6xl mx-auto">
                <div class="bg-gradient-to-r from-cyan-600/30 via-sky-600/30 to-blue-600/30 backdrop-blur-xl rounded-3xl p-8 md:p-12 border border-cyan-500/30">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                        <div>
                            <h2 class="text-2xl md:text-3xl font-bold mb-4">📚 Baru di Baricode?</h2>
                            <p class="text-base text-gray-200 mb-6">
                                Pelajari cara optimal untuk belajar di platform kami. Panduan lengkap dari daftar akun hingga membangun portfolio yang impressive.
                            </p>
                            <ul class="space-y-2 text-gray-300 text-sm mb-6">
                                <li class="flex gap-2">
                                    <span class="text-cyan-400">✓</span>
                                    <span>6 langkah pembelajaran yang terstruktur</span>
                                </li>
                                <li class="flex gap-2">
                                    <span class="text-cyan-400">✓</span>
                                    <span>Tips & best practices dari komunitas</span>
                                </li>
                                <li class="flex gap-2">
                                    <span class="text-cyan-400">✓</span>
                                    <span>FAQ & resources yang helpful</span>
                                </li>
                            </ul>
                            <a href="{{ route('how-to-learn') }}" wire:navigate
                                class="inline-block px-8 py-3 bg-gradient-to-r from-cyan-600 to-sky-600 rounded-full font-semibold text-base hover:shadow-lg hover:shadow-cyan-500/40 transition-all transform hover:scale-105">
                                📖 Baca Panduan Lengkap
                            </a>
                        </div>
                        <div class="hidden md:block">
                            <div class="grid grid-cols-2 gap-3">
                                <div class="bg-white/5 rounded-lg p-4 text-center border border-cyan-500/20">
                                    <div class="text-3xl mb-2">📝</div>
                                    <p class="text-sm font-semibold">Setup Profil</p>
                                </div>
                                <div class="bg-white/5 rounded-lg p-4 text-center border border-sky-500/20">
                                    <div class="text-3xl mb-2">🗺️</div>
                                    <p class="text-sm font-semibold">Pilih Path</p>
                                </div>
                                <div class="bg-white/5 rounded-lg p-4 text-center border border-blue-500/20">
                                    <div class="text-3xl mb-2">📚</div>
                                    <p class="text-sm font-semibold">Ikuti Kursus</p>
                                </div>
                                <div class="bg-white/5 rounded-lg p-4 text-center border border-cyan-500/20">
                                    <div class="text-3xl mb-2">⚡</div>
                                    <p class="text-sm font-semibold">Latihan Harian</p>
                                </div>
                                <div class="bg-white/5 rounded-lg p-4 text-center border border-sky-500/20 md:col-span-2">
                                    <div class="text-3xl mb-2">🤝</div>
                                    <p class="text-sm font-semibold">Berkolaborasi & Portfolio</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Value Section -->
        <section class="py-20 px-4 relative">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-16">Kenapa Harus Baricode?</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Card 1 -->
                    <div
                        class="bg-gradient-to-br from-purple-500/10 to-transparent backdrop-blur-lg rounded-3xl p-8 border border-purple-500/20 hover:border-purple-500/50 transition-all hover:shadow-xl hover:shadow-purple-500/20">
                        <div class="text-5xl mb-4">💯</div>
                        <h3 class="text-xl font-bold mb-3">Gratis 100%</h3>
                        <p class="text-gray-300 text-sm">Tidak ada biaya tersembunyi. Semua fitur gratis selamanya untuk semua
                            member.</p>
                    </div>

                    <!-- Card 2 -->
                    {{-- <div
                        class="bg-gradient-to-br from-indigo-500/10 to-transparent backdrop-blur-lg rounded-3xl p-8 border border-indigo-500/20 hover:border-indigo-500/50 transition-all hover:shadow-xl hover:shadow-indigo-500/20">
                        <div class="text-5xl mb-4">📊</div>
                        <h3 class="text-xl font-bold mb-3">Daily Commit Tracker</h3>
                        <p class="text-gray-300 text-sm">Pantau progress belajarmu secara rutin. Bangun kebiasaan coding yang
                            konsisten.</p>
                        <a href="{{ route('daily-commit-tracker.history') }}"
                            class="inline-block px-6 py-2 bg-indigo-600/80 text-white rounded-full font-semibold hover:bg-indigo-700 transition-all">
                            Lihat Tracker
                        </a>
                    </div> --}}

                    <!-- Card 3 -->
                    <div
                        class="bg-gradient-to-br from-violet-500/10 to-transparent backdrop-blur-lg rounded-3xl p-8 border border-violet-500/20 hover:border-violet-500/50 transition-all hover:shadow-xl hover:shadow-violet-500/20">
                        <div class="text-5xl mb-4">🤝</div>
                        <h3 class="text-xl font-bold mb-3">Proyek Kolaborasi</h3>
                        <p class="text-gray-300 text-sm">Kerja bareng dalam tim, belajar Git workflow, dan bangun portfolio
                            bersama.</p>
                    </div>

                    <!-- Card 4 -->
                    {{-- <div
                        class="bg-gradient-to-br from-purple-500/10 to-transparent backdrop-blur-lg rounded-3xl p-8 border border-purple-500/20 hover:border-purple-500/50 transition-all hover:shadow-xl hover:shadow-purple-500/20">
                        <div class="text-5xl mb-4">😂</div>
                        <h3 class="text-xl font-bold mb-3">Meme Zone</h3>
                        <p class="text-gray-300 text-sm mb-4">Belajar sambil ketawa. Share meme favoritmu dengan
                            komunitas.</p>
                        <a href="{{ route('meme.index') }}"
                            class="inline-block px-6 py-2 bg-purple-600/80 text-white rounded-full font-semibold hover:bg-purple-700 transition-all">
                            Lihat Meme
                        </a>
                    </div> --}}

                    <!-- Card 5 -->
                    <div
                        class="bg-gradient-to-br from-indigo-500/10 to-transparent backdrop-blur-lg rounded-3xl p-8 border border-indigo-500/20 hover:border-indigo-500/50 transition-all hover:shadow-xl hover:shadow-indigo-500/20">
                        <div class="text-5xl mb-4">🗺️</div>
                        <h3 class="text-xl font-bold mb-3">Roadmap Belajar</h3>
                        <p class="text-gray-300 text-sm">Path yang jelas dari pemula sampai mahir. Tinggal ikuti langkah demi
                            langkah.</p>
                    </div>

                    <!-- Card 6 -->
                    <div
                        class="bg-gradient-to-br from-violet-500/10 to-transparent backdrop-blur-lg rounded-3xl p-8 border border-violet-500/20 hover:border-violet-500/50 transition-all hover:shadow-xl hover:shadow-violet-500/20">
                        <div class="text-5xl mb-4">💬</div>
                        <h3 class="text-xl font-bold mb-3">Komunitas Aktif</h3>
                        <p class="text-gray-300 text-sm">Tanya jawab kapan aja. Ada yang siap bantu kamu saat waktu luang.</p>
                    </div>

                    <!-- Card 7 -->
                    <div
                        class="bg-gradient-to-br from-pink-500/10 to-transparent backdrop-blur-lg rounded-3xl p-8 border border-pink-500/20 hover:border-pink-500/50 transition-all hover:shadow-xl hover:shadow-pink-500/20">
                        <div class="text-5xl mb-4">📅</div>
                        <h3 class="text-xl font-bold mb-3">Timeline Komunitas</h3>
                        <p class="text-gray-300 text-sm mb-4">Track milestone dan perjalanan komunitas Baricode dari awal
                            hingga sekarang.</p>
                        <a href="{{ route('timeline.index') }}"
                            class="inline-block px-6 py-2 bg-pink-600/80 text-white rounded-full font-semibold hover:bg-pink-700 transition-all text-sm">
                            Lihat Timeline
                        </a>
                    </div>

                    <!-- Card RepoHub -->
                    <div
                        class="bg-gradient-to-br from-emerald-500/10 to-transparent backdrop-blur-lg rounded-3xl p-8 border border-emerald-500/20 hover:border-emerald-500/50 transition-all hover:shadow-xl hover:shadow-emerald-500/20">
                        <div class="text-5xl mb-4">🔥</div>
                        <h3 class="text-xl font-bold mb-3">RepoHub</h3>
                        <p class="text-gray-300 text-sm mb-4">Koleksi repositori GitHub pilihan yang kami rekomendasikan khusus untuk developer Indonesia.</p>
                        <a href="{{ route('repohub.index') }}"
                            class="inline-block px-6 py-2 bg-emerald-600/80 text-white rounded-full font-semibold hover:bg-emerald-700 transition-all text-sm">
                            Lihat RepoHub
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Project Showcase -->
        {{-- <section class="py-20 px-4 relative">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-16">Proyek dari Komunitas</h2>

                <div class="flex justify-center mb-8">
                    <span
                        class="inline-block px-6 py-2 bg-yellow-400/20 text-yellow-300 font-semibold rounded-full text-base border border-yellow-400/30 shadow">
                        Segera Hadir
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Project 1 -->
                    <div
                        class="bg-gradient-to-br from-purple-500/10 to-transparent backdrop-blur-lg rounded-3xl p-6 border border-purple-500/20 hover:border-purple-500/50 transition-all">
                        <div
                            class="bg-gradient-to-br from-purple-600 to-indigo-600 rounded-2xl h-40 mb-4 flex items-center justify-center text-6xl">
                            ✅
                        </div>
                        <h3 class="text-xl font-bold mb-2">Todo App</h3>
                        <p class="text-gray-400 text-sm mb-4">Aplikasi todo list dengan fitur drag & drop dan dark mode
                        </p>
                        <div class="flex gap-2">
                            <span class="px-3 py-1 bg-purple-500/20 rounded-full text-xs">React</span>
                            <span class="px-3 py-1 bg-indigo-500/20 rounded-full text-xs">Tailwind</span>
                        </div>
                    </div>

                    <!-- Project 2 -->
                    <div
                        class="bg-gradient-to-br from-indigo-500/10 to-transparent backdrop-blur-lg rounded-3xl p-6 border border-indigo-500/20 hover:border-indigo-500/50 transition-all">
                        <div
                            class="bg-gradient-to-br from-indigo-600 to-blue-600 rounded-2xl h-40 mb-4 flex items-center justify-center text-6xl">
                            🔗
                        </div>
                        <h3 class="text-xl font-bold mb-2">Shortlink App</h3>
                        <p class="text-gray-400 text-sm mb-4">URL shortener dengan analytics dan custom slug</p>
                        <div class="flex gap-2">
                            <span class="px-3 py-1 bg-indigo-500/20 rounded-full text-xs">Node.js</span>
                            <span class="px-3 py-1 bg-blue-500/20 rounded-full text-xs">MongoDB</span>
                        </div>
                    </div>

                    <!-- Project 3 -->
                    <div
                        class="bg-gradient-to-br from-violet-500/10 to-transparent backdrop-blur-lg rounded-3xl p-6 border border-violet-500/20 hover:border-violet-500/50 transition-all">
                        <div
                            class="bg-gradient-to-br from-violet-600 to-purple-600 rounded-2xl h-40 mb-4 flex items-center justify-center text-6xl">
                            💬
                        </div>
                        <h3 class="text-xl font-bold mb-2">Bot WhatsApp</h3>
                        <p class="text-gray-400 text-sm mb-4">Bot WA multifungsi untuk otomasi grup dan reminder</p>
                        <div class="flex gap-2">
                            <span class="px-3 py-1 bg-violet-500/20 rounded-full text-xs">Python</span>
                            <span class="px-3 py-1 bg-purple-500/20 rounded-full text-xs">Selenium</span>
                        </div>
                    </div>

                    <!-- Project 4 -->
                    <div
                        class="bg-gradient-to-br from-purple-500/10 to-transparent backdrop-blur-lg rounded-3xl p-6 border border-purple-500/20 hover:border-purple-500/50 transition-all">
                        <div
                            class="bg-gradient-to-br from-purple-600 to-pink-600 rounded-2xl h-40 mb-4 flex items-center justify-center text-6xl">
                            🎨
                        </div>
                        <h3 class="text-xl font-bold mb-2">Portfolio Generator</h3>
                        <p class="text-gray-400 text-sm mb-4">Generate portfolio website dari template siap pakai</p>
                        <div class="flex gap-2">
                            <span class="px-3 py-1 bg-purple-500/20 rounded-full text-xs">Next.js</span>
                            <span class="px-3 py-1 bg-pink-500/20 rounded-full text-xs">TypeScript</span>
                        </div>
                    </div>

                    <!-- Project 5 -->
                    <div
                        class="bg-gradient-to-br from-indigo-500/10 to-transparent backdrop-blur-lg rounded-3xl p-6 border border-indigo-500/20 hover:border-indigo-500/50 transition-all">
                        <div
                            class="bg-gradient-to-br from-indigo-600 to-cyan-600 rounded-2xl h-40 mb-4 flex items-center justify-center text-6xl">
                            📊
                        </div>
                        <h3 class="text-xl font-bold mb-2">Dashboard Analytics</h3>
                        <p class="text-gray-400 text-sm mb-4">Real-time analytics dashboard dengan chart interaktif</p>
                        <div class="flex gap-2">
                            <span class="px-3 py-1 bg-indigo-500/20 rounded-full text-xs">Vue</span>
                            <span class="px-3 py-1 bg-cyan-500/20 rounded-full text-xs">Chart.js</span>
                        </div>
                    </div>

                    <!-- Project 6 -->
                    <div
                        class="bg-gradient-to-br from-violet-500/10 to-transparent backdrop-blur-lg rounded-3xl p-6 border border-violet-500/20 hover:border-violet-500/50 transition-all">
                        <div
                            class="bg-gradient-to-br from-violet-600 to-fuchsia-600 rounded-2xl h-40 mb-4 flex items-center justify-center text-6xl">
                            🎮
                        </div>
                        <h3 class="text-xl font-bold mb-2">Mini Games Hub</h3>
                        <p class="text-gray-400 text-sm mb-4">Kumpulan mini games browser-based yang seru</p>
                        <div class="flex gap-2">
                            <span class="px-3 py-1 bg-violet-500/20 rounded-full text-xs">JavaScript</span>
                            <span class="px-3 py-1 bg-fuchsia-500/20 rounded-full text-xs">Canvas</span>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        <!-- Testimonials -->
        {{-- <section class="py-20 px-4 relative">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-16">Kata Mereka</h2>

                <div class="flex justify-center mb-8">
                    <span
                        class="inline-block px-6 py-2 bg-yellow-400/20 text-yellow-300 font-semibold rounded-full text-base border border-yellow-400/30 shadow">
                        Segera Hadir
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Testimonial 1 -->
                    <div class="relative">
                        <div
                            class="bg-gradient-to-br from-purple-500/20 to-transparent backdrop-blur-lg rounded-3xl p-6 border border-purple-500/30">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-14 h-14 rounded-full bg-gradient-to-r from-purple-500 to-pink-500"></div>
                                <div>
                                    <h4 class="font-bold">Rani Putri</h4>
                                    <p class="text-sm text-gray-400">Frontend Dev</p>
                                </div>
                            </div>
                            <p class="text-gray-300 text-sm">"Baricode ngubah cara gue belajar coding. Dari yang males-malesan
                                jadi konsisten tiap hari. Daily commit tracker-nya bikin gue ketagihan!"</p>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="relative">
                        <div
                            class="bg-gradient-to-br from-indigo-500/20 to-transparent backdrop-blur-lg rounded-3xl p-6 border border-indigo-500/30">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-14 h-14 rounded-full bg-gradient-to-r from-indigo-500 to-blue-500"></div>
                                <div>
                                    <h4 class="font-bold">Dimas Aji</h4>
                                    <p class="text-sm text-gray-400">Backend Dev</p>
                                </div>
                            </div>
                            <p class="text-gray-300 text-sm">"Komunitas yang paling supportive! Gue dari nol banget, sekarang
                                udah bisa bikin full-stack app. Thanks Baricode!"</p>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="relative">
                        <div
                            class="bg-gradient-to-br from-violet-500/20 to-transparent backdrop-blur-lg rounded-3xl p-6 border border-violet-500/30">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-14 h-14 rounded-full bg-gradient-to-r from-violet-500 to-purple-500">
                                </div>
                                <div>
                                    <h4 class="font-bold">Lina Safitri</h4>
                                    <p class="text-sm text-gray-400">Mobile Dev</p>
                                </div>
                            </div>
                            <p class="text-gray-300 text-sm">"Hackathon mini-nya seru banget! Jadi ajang buat praktik skill
                                baru sambil dapet feedback dari senior."</p>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        <!-- Astraloka Community Section -->
        <section class="py-20 px-4 relative">
            <div class="max-w-6xl mx-auto">
                <div class="bg-gradient-to-br from-green-600/20 via-emerald-600/20 to-teal-600/20 backdrop-blur-xl rounded-3xl p-8 md:p-16 border border-green-500/30 overflow-hidden relative">
                    <!-- Background decorations -->
                    <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-bl from-green-500/10 to-transparent rounded-full blur-3xl -mr-48 -mt-48"></div>
                    <div class="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-tr from-emerald-500/10 to-transparent rounded-full blur-3xl -ml-48 -mb-48"></div>

                    <div class="relative z-10">
                        <!-- Header -->
                        <div class="text-center mb-12">
                            <span class="inline-block px-4 py-2 bg-green-500/20 border border-green-400/40 rounded-full text-green-300 font-semibold text-sm mb-6">
                                🌱 Komunitas Saudara
                            </span>
                            <h2 class="text-3xl md:text-4xl font-extrabold mb-4 bg-gradient-to-r from-green-400 via-emerald-400 to-teal-400 bg-clip-text text-transparent">
                                Astraloka
                            </h2>
                            <p class="text-xl font-bold text-gray-100 mb-2">Membangun Kesadaran Lingkungan Bersama</p>
                            <p class="text-base text-gray-300 max-w-2xl mx-auto">
                                Mendorong Perubahan untuk Lingkungan yang Lebih Baik
                            </p>
                        </div>

                        <!-- Feature Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                            <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-green-500/20 hover:bg-white/10 transition-all">
                                <div class="text-4xl mb-4">🎓</div>
                                <h3 class="font-bold text-base mb-2">Edukasi Lingkungan</h3>
                                <p class="text-sm text-gray-300">Program edukasi yang mengajarkan masyarakat tentang dampak limbah dan cara-cara efektif untuk mengelolanya melalui konten digital.</p>
                            </div>
                            <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-green-500/20 hover:bg-white/10 transition-all">
                                <div class="text-4xl mb-4">🚀</div>
                                <h3 class="font-bold text-base mb-2">Bergabunglah Dengan Kami</h3>
                                <p class="text-sm text-gray-300">Komunitas baru yang bersemangat membangun kesadaran lingkungan. Mari berkontribusi bersama dalam perjalanan menuju masa depan yang lebih hijau.</p>
                            </div>
                            <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-green-500/20 hover:bg-white/10 transition-all">
                                <div class="text-4xl mb-4">🌱</div>
                                <h3 class="font-bold text-base mb-2">Inisiatif Pribadi</h3>
                                <p class="text-sm text-gray-300">Tindakan nyata dari tim kami untuk memulai gerakan lingkungan dan memberikan contoh nyata kepada masyarakat.</p>
                            </div>
                        </div>

                        <!-- Why Choose Us -->
                        <div class="mb-12">
                            <h3 class="text-xl font-bold text-center mb-8 text-gray-100">Mengapa Memilih Kami?</h3>
                            <p class="text-center text-gray-300 text-sm mb-8">Komitmen kami untuk pendidikan dan masyarakat adalah landasan dari setiap program yang kami jalankan.</p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-emerald-500/20 text-center hover:bg-white/10 transition-all">
                                    <div class="text-4xl mb-3">🔥</div>
                                    <h4 class="font-bold mb-2 text-sm">Inisiatif Pribadi</h4>
                                    <p class="text-sm text-gray-300">Semangat tinggi dari setiap anggota tim untuk menciptakan perubahan nyata dan menginspirasi masyarakat luas.</p>
                                </div>
                                <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-emerald-500/20 text-center hover:bg-white/10 transition-all">
                                    <div class="text-4xl mb-3">💡</div>
                                    <h4 class="font-bold mb-2 text-sm">Program Inovatif</h4>
                                    <p class="text-sm text-gray-300">Solusi kreatif dan berbasis riset untuk tantangan lingkungan yang kompleks.</p>
                                </div>
                                <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-emerald-500/20 text-center hover:bg-white/10 transition-all">
                                    <div class="text-4xl mb-3">🌍</div>
                                    <h4 class="font-bold mb-2 text-sm">Dampak Nyata</h4>
                                    <p class="text-sm text-gray-300">Hasil nyata walau sedikit yang memberikan perubahan positif bagi lingkungan dan masyarakat.</p>
                                </div>
                            </div>
                        </div>

                        <!-- About + Stats -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-12">
                            <div>
                                <h3 class="text-xl font-bold mb-4 text-gray-100">Tentang Kami</h3>
                                <p class="text-gray-300 text-sm mb-4">Astraloka adalah komunitas yang berdedikasi untuk meningkatkan kesadaran lingkungan dan mendorong tindakan nyata dalam pengelolaan lingkungan yang berkelanjutan.</p>
                                <p class="text-gray-300 text-sm mb-6">Kami percaya bahwa perubahan dimulai dari kesadaran individu. Melalui program edukasi dan inisiatif komunitas, kami bekerja untuk menciptakan dampak positif bagi lingkungan.</p>
                                <ul class="space-y-2 text-sm">
                                    <li class="flex items-center gap-2 text-green-300"><span class="text-green-400 font-bold">✓</span> Program edukasi berbasis digital</li>
                                    <li class="flex items-center gap-2 text-green-300"><span class="text-green-400 font-bold">✓</span> Komunitas aktif dan peduli lingkungan</li>
                                    <li class="flex items-center gap-2 text-green-300"><span class="text-green-400 font-bold">✓</span> Inisiatif nyata dengan transparansi penuh</li>
                                </ul>
                            </div>
                            <div class="grid grid-cols-2 gap-6">
                                <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-green-500/20 text-center">
                                    <div class="text-2xl font-extrabold text-green-400 mb-2">100%</div>
                                    <p class="text-sm text-gray-300">Komitmen terhadap Lingkungan</p>
                                </div>
                                <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-green-500/20 text-center">
                                    <div class="text-2xl font-extrabold text-emerald-400 mb-2">∞</div>
                                    <p class="text-sm text-gray-300">Potensi Dampak Positif</p>
                                </div>
                                <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-green-500/20 text-center">
                                    <div class="text-2xl font-extrabold text-teal-400 mb-2">1</div>
                                    <p class="text-sm text-gray-300">Misi Bersama: Bumi yang Lebih Hijau</p>
                                </div>
                                <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-green-500/20 text-center">
                                    <div class="text-2xl font-extrabold text-green-300 mb-2">Anda</div>
                                    <p class="text-sm text-gray-300">Bagian Penting dari Gerakan Kami</p>
                                </div>
                            </div>
                        </div>

                        <!-- CTA -->
                        <div class="text-center">
                            <a href="https://astraloka.my.id" target="_blank" rel="noopener noreferrer"
                                class="inline-block px-10 py-4 bg-gradient-to-r from-green-600 via-emerald-600 to-teal-600 rounded-full font-bold text-base shadow-lg hover:shadow-green-500/40 transition-all transform hover:scale-105 ring-2 ring-green-400/30 hover:ring-4 hover:ring-emerald-400/40">
                                🌍 Kunjungi Astraloka
                            </a>
                            <p class="text-sm text-gray-400 mt-4">Bersama Barizaloka, kami membangun ekosistem komunitas yang lebih baik</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- FAQ Section -->
        <section class="py-20 px-4 relative">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-16">
                    <span class="inline-block px-4 py-2 bg-purple-500/20 border border-purple-400/40 rounded-full text-purple-300 font-semibold text-sm mb-6">
                        ❓ FAQ
                    </span>
                    <h2 class="text-3xl md:text-4xl font-extrabold mb-4 bg-gradient-to-r from-purple-400 via-violet-400 to-indigo-400 bg-clip-text text-transparent">
                        Pertanyaan yang Sering Ditanyakan
                    </h2>
                    <p class="text-base text-gray-300">Ada pertanyaan? Kami sudah siapkan jawabannya di sini.</p>
                </div>

                <div class="space-y-4" x-data="{ open: null }">
                    <!-- FAQ 1 -->
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-purple-500/40 transition-all overflow-hidden">
                        <button @click="open = open === 1 ? null : 1"
                            class="w-full flex items-center justify-between p-6 text-left font-semibold text-base">
                            <span>Apa itu Baricode?</span>
                            <span class="text-purple-400 transition-transform duration-300" :class="open === 1 ? 'rotate-45' : ''">+</span>
                        </button>
                        <div x-show="open === 1" x-transition class="px-6 pb-6 text-gray-300 text-sm leading-relaxed">
                            Baricode adalah komunitas IT Indonesia yang berfokus pada belajar, berbagi, dan berkolaborasi bersama. Platform kami menyediakan kursus gratis, forum diskusi, tantangan harian, dan berbagai fitur untuk membantu developer berkembang bersama-sama.
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-purple-500/40 transition-all overflow-hidden">
                        <button @click="open = open === 2 ? null : 2"
                            class="w-full flex items-center justify-between p-6 text-left font-semibold text-base">
                            <span>Apakah Baricode gratis?</span>
                            <span class="text-purple-400 transition-transform duration-300" :class="open === 2 ? 'rotate-45' : ''">+</span>
                        </button>
                        <div x-show="open === 2" x-transition class="px-6 pb-6 text-gray-300 text-sm leading-relaxed">
                            Ya, 100% gratis! Semua fitur di Baricode tidak berbayar dan tidak ada biaya tersembunyi. Kami percaya bahwa belajar dan berkembang bersama komunitas seharusnya dapat diakses oleh siapa saja tanpa hambatan finansial.
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-purple-500/40 transition-all overflow-hidden">
                        <button @click="open = open === 3 ? null : 3"
                            class="w-full flex items-center justify-between p-6 text-left font-semibold text-base">
                            <span>Bagaimana cara bergabung dengan Baricode?</span>
                            <span class="text-purple-400 transition-transform duration-300" :class="open === 3 ? 'rotate-45' : ''">+</span>
                        </button>
                        <div x-show="open === 3" x-transition class="px-6 pb-6 text-gray-300 text-sm leading-relaxed">
                            Cukup klik tombol <strong class="text-purple-300">Gabung Gratis</strong> dan daftarkan akunmu. Kamu bisa mendaftar menggunakan email atau akun Google. Setelah terdaftar, kamu langsung menjadi bagian dari Keluarga Baricode dan bisa menikmati semua fitur yang tersedia.
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-purple-500/40 transition-all overflow-hidden">
                        <button @click="open = open === 4 ? null : 4"
                            class="w-full flex items-center justify-between p-6 text-left font-semibold text-base">
                            <span>Apa saja fitur yang tersedia di platform ini?</span>
                            <span class="text-purple-400 transition-transform duration-300" :class="open === 4 ? 'rotate-45' : ''">+</span>
                        </button>
                        <div x-show="open === 4" x-transition class="px-6 pb-6 text-gray-300 text-sm leading-relaxed">
                            Baricode menyediakan berbagai fitur menarik, antara lain:
                            <ul class="mt-3 space-y-2">
                                <li class="flex gap-2"><span class="text-purple-400">•</span> <strong>LMS (Learning Management System)</strong> — Kursus dan materi belajar terstruktur</li>
                                <li class="flex gap-2"><span class="text-purple-400">•</span> <strong>Daily Commit Tracker</strong> — Pantau konsistensi belajar harianmu</li>
                                <li class="flex gap-2"><span class="text-purple-400">•</span> <strong>RepoHub</strong> — Koleksi repositori GitHub pilihan untuk developer Indonesia</li>
                                <li class="flex gap-2"><span class="text-purple-400">•</span> <strong>Quiz</strong> — Uji pemahamanmu dengan kuis interaktif</li>
                                <li class="flex gap-2"><span class="text-purple-400">•</span> <strong>Keluarga Baricode</strong> — Direktori komunitas dan jaringan sesama developer</li>
                                <li class="flex gap-2"><span class="text-purple-400">•</span> <strong>Blog & Meme</strong> — Konten edukatif dan hiburan dari komunitas</li>
                            </ul>
                        </div>
                    </div>

                    <!-- FAQ 5 -->
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-purple-500/40 transition-all overflow-hidden">
                        <button @click="open = open === 5 ? null : 5"
                            class="w-full flex items-center justify-between p-6 text-left font-semibold text-base">
                            <span>Siapa saja yang bisa bergabung?</span>
                            <span class="text-purple-400 transition-transform duration-300" :class="open === 5 ? 'rotate-45' : ''">+</span>
                        </button>
                        <div x-show="open === 5" x-transition class="px-6 pb-6 text-gray-300 text-sm leading-relaxed">
                            Semua orang yang tertarik dengan dunia IT dan teknologi! Baik kamu yang masih pemula dan baru mulai belajar coding, maupun yang sudah berpengalaman dan ingin berbagi ilmu. Baricode terbuka untuk semua kalangan, dari pelajar, mahasiswa, hingga profesional.
                        </div>
                    </div>

                    <!-- FAQ 6 -->
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-purple-500/40 transition-all overflow-hidden">
                        <button @click="open = open === 6 ? null : 6"
                            class="w-full flex items-center justify-between p-6 text-left font-semibold text-base">
                            <span>Bagaimana cara mulai belajar di Baricode?</span>
                            <span class="text-purple-400 transition-transform duration-300" :class="open === 6 ? 'rotate-45' : ''">+</span>
                        </button>
                        <div x-show="open === 6" x-transition class="px-6 pb-6 text-gray-300 text-sm leading-relaxed">
                            Setelah mendaftar, kamu bisa langsung mengakses halaman <strong class="text-purple-300">LMS</strong> untuk menemukan kursus yang sesuai dengan levelmu. Kami juga menyediakan panduan lengkap di halaman <a href="{{ route('how-to-learn') }}" class="text-cyan-400 hover:underline">Cara Belajar di Baricode</a> yang menjelaskan langkah-langkah optimal dari awal hingga membangun portfolio.
                        </div>
                    </div>
                </div>

                <div class="text-center mt-12">
                    <p class="text-gray-400 text-sm mb-4">Masih ada pertanyaan lain?</p>
                    <a href="https://chat.whatsapp.com/Fb2ZFMIKDz7JJZyBVpzXws" target="_blank" rel="noopener noreferrer"
                        class="inline-block px-8 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-full font-semibold text-base hover:shadow-lg hover:shadow-purple-500/40 transition-all transform hover:scale-105">
                        Hubungi Kami di WhatsApp
                    </a>
                </div>
            </div>
        </section>
    </div>
</x-layouts.base>
