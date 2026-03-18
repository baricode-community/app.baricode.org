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
                    class="text-5xl md:text-7xl font-extrabold mb-8 bg-gradient-to-r from-purple-400 via-violet-400 to-indigo-400 bg-clip-text text-transparent drop-shadow-lg">
                    Komunitas IT Keren di Indonesia<br />
                    <span
                        class="block text-3xl md:text-5xl font-bold mt-2 bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text text-transparent animate-gradient-x">
                        Bersama Bertumbuh, Belajar, dan Berbagi
                    </span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-200 mb-8 max-w-3xl mx-auto font-medium drop-shadow">
                    Bangun proyek bareng, ikut tantangan harian, dan berkembang bersama komunitas developer yang
                    positif.
                </p>
                <p class="text-lg text-gray-400 mb-10 max-w-2xl mx-auto italic">
                    Kami berbasis komunitas, jadi ada banyak fitur menarik yang tersedia khusus untuk kamu.<br>
                    <span class="font-semibold text-purple-300">Yuk, eksplorasi dan manfaatkan semua fiturnya!</span>
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-20">
                    <a href="{{ route('dashboard') }}" wire:navigate
                        class="px-10 py-4 bg-gradient-to-r from-purple-600 via-violet-600 to-indigo-600 rounded-full font-bold text-lg shadow-lg hover:shadow-purple-500/40 transition-all transform hover:scale-105 flex items-center justify-center ring-2 ring-purple-400/30 hover:ring-4 hover:ring-indigo-400/40">
                        🚀 Gabung Gratis
                    </a>
                    <a href="{{ route('lms.all-courses') }}" wire:navigate
                        class="px-10 py-4 bg-white/10 backdrop-blur-lg rounded-full font-semibold text-lg border border-white/20 hover:bg-white/20 transition-all flex items-center justify-center ring-1 ring-white/10 hover:ring-2 hover:ring-purple-300/30">
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
                                class="text-4xl md:text-5xl font-extrabold mb-6 bg-gradient-to-r from-pink-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">
                                Ikuti Baricode di TikTok!</h2>
                            <p class="text-xl md:text-2xl text-gray-100 font-semibold mb-4">
                                Konten Coding yang Seru dan Menghibur
                            </p>
                            <p class="text-lg text-gray-300 max-w-3xl mx-auto">
                                Tutorial coding dengan gaya yang fun dan engaging. Dari tips & trik programming, project
                                walkthroughs, hingga meme tentang developer. Semua ada di TikTok Baricode!
                            </p>
                        </div>

                        <div class="mb-10">
                            <div class="flex justify-center">
                                <blockquote class="tiktok-embed"
                                    cite="https://www.tiktok.com/@baricode_org/video/7615595451449904404"
                                    data-video-id="7615595451449904404" style="max-width: 605px;min-width: 325px;">
                                    <section> <a target="_blank" title="@baricode_org"
                                            href="https://www.tiktok.com/@baricode_org?refer=embed">@baricode_org</a>
                                        Mau belajar coding, tapi suka bingung karena GK ada pembingbing? Mari bergabung
                                        dan belajar bareng dengan BARICODE <a title="fypdong" target="_blank"
                                            href="https://www.tiktok.com/tag/fypdong?refer=embed">#fypdong</a> <a
                                            title="coding" target="_blank"
                                            href="https://www.tiktok.com/tag/coding?refer=embed">#coding</a> <a
                                            title="viralvideotiktok" target="_blank"
                                            href="https://www.tiktok.com/tag/viralvideotiktok?refer=embed">#viralvideotiktok</a>
                                        <a title="codingtips" target="_blank"
                                            href="https://www.tiktok.com/tag/codingtips?refer=embed">#codingtips</a> <a
                                            target="_blank" title="♬ suara asli  - Baricode Community"
                                            href="https://www.tiktok.com/music/suara-asli-Baricode-Community-7615595509167688469?refer=embed">♬
                                            suara asli - Baricode Community</a> </section>
                                </blockquote>
                                <script async src="https://www.tiktok.com/embed.js"></script>
                            </div>
                        </div>

                        <div class="text-center">
                            <a href="https://www.tiktok.com/@baricode_org" target="_blank" rel="noopener noreferrer"
                                class="inline-block px-10 py-4 bg-gradient-to-r from-pink-600 via-purple-600 to-pink-600 rounded-full font-bold text-lg shadow-lg hover:shadow-pink-500/40 transition-all transform hover:scale-105 ring-2 ring-pink-400/30 hover:ring-4 hover:ring-purple-400/40">
                                🎵 Follow Baricode di TikTok
                            </a>
                            <p class="text-sm text-gray-400 mt-4">Konten baru setiap hari • Jangan ketinggalan updates
                                terbaru!</p>
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
                        class="inline-block px-6 py-2 bg-gradient-to-r from-purple-500 to-indigo-500 text-white font-semibold rounded-full text-lg shadow">
                        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold mb-8">Jangan Biarkan Waktumu Tanpa Berkomunitas</h2>
                <p class="text-xl text-gray-200 mb-6 font-medium">
                    Karena ibarat lidi pada sapu, jika sendiri maka rapuh namun jika bersama maka sangat kuat.
                </p>
                <p class="text-lg text-purple-300 font-semibold mb-10">
                    Mari gabung ke komunitas terkece, keren, dan terbesar (secara bertahap) se-Indonesia!
                </p>
                <a href="{{ route('dashboard') }}"
                    class="px-10 py-4 bg-gradient-to-r from-purple-600 via-violet-600 to-indigo-600 rounded-full font-bold text-lg shadow-lg hover:shadow-purple-500/40 transition-all transform hover:scale-105 flex items-center justify-center ring-2 ring-purple-400/30 hover:ring-4 hover:ring-indigo-400/40">
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
                        <h2 class="text-4xl md:text-5xl font-extrabold mb-6">Kami Berkomitmen</h2>
                        <p class="text-xl md:text-2xl text-gray-100 font-semibold mb-4">
                            Mengembangkan Komunitas dengan Mewujudkan Transparansi Progress Komunitas
                        </p>
                        <p class="text-lg text-purple-200 italic">
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
                                <h3 class="text-2xl font-bold">Dalam Proses</h3>
                            </div>
                            <p class="text-gray-300 mb-6">Proyek dan fitur yang sedang dikerjakan oleh tim dan komunitas
                            </p>
                            <div class="bg-blue-500/20 rounded-lg p-4">
                                <p class="text-blue-200 font-semibold">{{ $timelines['ongoing'] }} Proyek Aktif</p>
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
                                <h3 class="text-2xl font-bold">Ditunda</h3>
                            </div>
                            <p class="text-gray-300 mb-6">Fitur atau proyek yang sementara dihentikan dengan alasan
                                tertentu</p>
                            <div class="bg-yellow-500/20 rounded-lg p-4">
                                <p class="text-yellow-200 font-semibold">{{ $timelines['planned'] }} Item Ditunda</p>
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
                                <h3 class="text-2xl font-bold">Selesai</h3>
                            </div>
                            <p class="text-gray-300 mb-6">Fitur dan proyek yang telah berhasil dikerjakan dan
                                diluncurkan</p>
                            <div class="bg-green-500/20 rounded-lg p-4">
                                <p class="text-green-200 font-semibold">{{ $timelines['completed'] }} Selesai</p>
                                <p class="text-sm text-green-300 mt-2">Terus berkembang dan berinovasi untuk komunitas
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 text-center">
                        <p class="text-gray-200 mb-6">
                            Dengan transparansi ini, kami membuktikan bahwa <span
                                class="text-purple-300 font-bold">Kami Aktif!</span> dan terus bergerak maju untuk
                            memberikan yang terbaik bagi komunitas.
                        </p>
                        <a href="{{ route('timelines.index') }}" wire:navigate
                            class="inline-block px-8 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-full font-bold text-lg shadow-lg hover:shadow-purple-500/40 transition-all transform hover:scale-105 ring-2 ring-purple-400/30 hover:ring-4 hover:ring-indigo-400/40">
                            📊 Lihat Transparansi Lengkap
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Value Section -->
        <section class="py-20 px-4 relative">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-4xl md:text-5xl font-bold text-center mb-16">Kenapa Harus Baricode?</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Card 1 -->
                    <div
                        class="bg-gradient-to-br from-purple-500/10 to-transparent backdrop-blur-lg rounded-3xl p-8 border border-purple-500/20 hover:border-purple-500/50 transition-all hover:shadow-xl hover:shadow-purple-500/20">
                        <div class="text-5xl mb-4">💯</div>
                        <h3 class="text-2xl font-bold mb-3">Gratis 100%</h3>
                        <p class="text-gray-300">Tidak ada biaya tersembunyi. Semua fitur gratis selamanya untuk semua
                            member.</p>
                    </div>

                    <!-- Card 2 -->
                    {{-- <div
                        class="bg-gradient-to-br from-indigo-500/10 to-transparent backdrop-blur-lg rounded-3xl p-8 border border-indigo-500/20 hover:border-indigo-500/50 transition-all hover:shadow-xl hover:shadow-indigo-500/20">
                        <div class="text-5xl mb-4">📊</div>
                        <h3 class="text-2xl font-bold mb-3">Daily Commit Tracker</h3>
                        <p class="text-gray-300">Pantau progress belajarmu setiap hari. Bangun kebiasaan coding yang
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
                        <h3 class="text-2xl font-bold mb-3">Proyek Kolaborasi</h3>
                        <p class="text-gray-300">Kerja bareng dalam tim, belajar Git workflow, dan bangun portfolio
                            bersama.</p>
                    </div>

                    <!-- Card 4 -->
                    {{-- <div
                        class="bg-gradient-to-br from-purple-500/10 to-transparent backdrop-blur-lg rounded-3xl p-8 border border-purple-500/20 hover:border-purple-500/50 transition-all hover:shadow-xl hover:shadow-purple-500/20">
                        <div class="text-5xl mb-4">😂</div>
                        <h3 class="text-2xl font-bold mb-3">Meme Zone</h3>
                        <p class="text-gray-300 mb-4">Belajar sambil ketawa. Share meme favoritmu dengan
                            komunitas.</p>
                        <a href="{{ route('memes.index') }}"
                            class="inline-block px-6 py-2 bg-purple-600/80 text-white rounded-full font-semibold hover:bg-purple-700 transition-all">
                            Lihat Meme
                        </a>
                    </div> --}}

                    <!-- Card 5 -->
                    <div
                        class="bg-gradient-to-br from-indigo-500/10 to-transparent backdrop-blur-lg rounded-3xl p-8 border border-indigo-500/20 hover:border-indigo-500/50 transition-all hover:shadow-xl hover:shadow-indigo-500/20">
                        <div class="text-5xl mb-4">🗺️</div>
                        <h3 class="text-2xl font-bold mb-3">Roadmap Belajar</h3>
                        <p class="text-gray-300">Path yang jelas dari pemula sampai mahir. Tinggal ikuti langkah demi
                            langkah.</p>
                    </div>

                    <!-- Card 6 -->
                    <div
                        class="bg-gradient-to-br from-violet-500/10 to-transparent backdrop-blur-lg rounded-3xl p-8 border border-violet-500/20 hover:border-violet-500/50 transition-all hover:shadow-xl hover:shadow-violet-500/20">
                        <div class="text-5xl mb-4">💬</div>
                        <h3 class="text-2xl font-bold mb-3">Komunitas Aktif</h3>
                        <p class="text-gray-300">Tanya jawab kapan aja. Ada yang siap bantu kamu saat waktu luang.</p>
                    </div>

                    <!-- Card 7 -->
                    <div
                        class="bg-gradient-to-br from-pink-500/10 to-transparent backdrop-blur-lg rounded-3xl p-8 border border-pink-500/20 hover:border-pink-500/50 transition-all hover:shadow-xl hover:shadow-pink-500/20">
                        <div class="text-5xl mb-4">📅</div>
                        <h3 class="text-2xl font-bold mb-3">Timeline Komunitas</h3>
                        <p class="text-gray-300 mb-4">Track milestone dan perjalanan komunitas Baricode dari awal
                            hingga sekarang.</p>
                        <a href="{{ route('timelines.index') }}"
                            class="inline-block px-6 py-2 bg-pink-600/80 text-white rounded-full font-semibold hover:bg-pink-700 transition-all">
                            Lihat Timeline
                        </a>
                    </div>

                    <!-- Card RepoHub -->
                    <div
                        class="bg-gradient-to-br from-emerald-500/10 to-transparent backdrop-blur-lg rounded-3xl p-8 border border-emerald-500/20 hover:border-emerald-500/50 transition-all hover:shadow-xl hover:shadow-emerald-500/20">
                        <div class="text-5xl mb-4">🔥</div>
                        <h3 class="text-2xl font-bold mb-3">RepoHub</h3>
                        <p class="text-gray-300 mb-4">Koleksi repositori GitHub pilihan yang kami rekomendasikan khusus untuk developer Indonesia.</p>
                        <a href="{{ route('repohub.index') }}"
                            class="inline-block px-6 py-2 bg-emerald-600/80 text-white rounded-full font-semibold hover:bg-emerald-700 transition-all">
                            Lihat RepoHub
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Project Showcase -->
        {{-- <section class="py-20 px-4 relative">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-4xl md:text-5xl font-bold text-center mb-16">Proyek dari Komunitas</h2>

                <div class="flex justify-center mb-8">
                    <span
                        class="inline-block px-6 py-2 bg-yellow-400/20 text-yellow-300 font-semibold rounded-full text-lg border border-yellow-400/30 shadow">
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
                <h2 class="text-4xl md:text-5xl font-bold text-center mb-16">Kata Mereka</h2>

                <div class="flex justify-center mb-8">
                    <span
                        class="inline-block px-6 py-2 bg-yellow-400/20 text-yellow-300 font-semibold rounded-full text-lg border border-yellow-400/30 shadow">
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
                            <p class="text-gray-300">"Baricode ngubah cara gue belajar coding. Dari yang males-malesan
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
                            <p class="text-gray-300">"Komunitas yang paling supportive! Gue dari nol banget, sekarang
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
                            <p class="text-gray-300">"Hackathon mini-nya seru banget! Jadi ajang buat praktik skill
                                baru sambil dapet feedback dari senior."</p>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        <!-- Telegram Channel Section -->
        <section class="py-20 px-4 relative">
            <div class="max-w-6xl mx-auto">
                <div
                    class="bg-gradient-to-r from-cyan-600/40 via-sky-600/40 to-blue-600/40 backdrop-blur-xl rounded-3xl p-12 border border-cyan-500/30 overflow-hidden relative">
                    <!-- Animated background elements -->
                    <div
                        class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-bl from-cyan-500/20 to-transparent rounded-full blur-3xl -mr-48 -mt-48">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-tr from-blue-500/20 to-transparent rounded-full blur-3xl -ml-48 -mb-48">
                    </div>

                    <div class="relative z-10">
                        <div class="text-center mb-12">
                            <div class="inline-block mb-6">
                                <div class="text-7xl animate-bounce">📱</div>
                            </div>
                            <h2 class="text-4xl md:text-5xl font-extrabold mb-6">Jangan Ketinggalan Update Terbaru!
                            </h2>
                            <p class="text-xl md:text-2xl text-gray-100 font-semibold mb-4">
                                Bergabunglah dengan Telegram Channel Baricode
                            </p>
                            <p class="text-lg text-cyan-200 max-w-3xl mx-auto">
                                Dapatkan update terbaru tentang fitur baru, challenge menarik, event komunitas, dan tips
                                & trik coding langsung ke Telegram kamu. Jadilah yang pertama tahu setiap perkembangan!
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                            <!-- Benefit 1 -->
                            <div
                                class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-cyan-500/20 text-center hover:bg-white/10 transition-all">
                                <div class="text-4xl mb-3">⚡</div>
                                <h3 class="font-bold mb-2">Update Real-time</h3>
                                <p class="text-sm text-gray-300">Notifikasi langsung untuk fitur baru dan event penting
                                </p>
                            </div>

                            <!-- Benefit 2 -->
                            <div
                                class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-cyan-500/20 text-center hover:bg-white/10 transition-all">
                                <div class="text-4xl mb-3">💡</div>
                                <h3 class="font-bold mb-2">Tips & Tricks</h3>
                                <p class="text-sm text-gray-300">Pelajari cara maksimalkan semua fitur Baricode</p>
                            </div>
                        </div>

                        <div class="text-center">
                            <a href="https://t.me/baricode_org" target="_blank" rel="noopener noreferrer"
                                class="inline-block px-10 py-4 bg-gradient-to-r from-cyan-500 via-sky-500 to-blue-500 rounded-full font-bold text-lg shadow-lg hover:shadow-cyan-500/40 transition-all transform hover:scale-105 ring-2 ring-cyan-400/30 hover:ring-4 hover:ring-blue-400/40">
                                🚀 Bergabung di Telegram Sekarang
                            </a>
                            <p class="text-sm text-gray-400 mt-4">Gratis • Tanpa biaya tersembunyi • Bisa keluar kapan
                                saja</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-layouts.base>
