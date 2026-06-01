<x-layouts.base :title="__('Roadmap Belajar IT - Baricode')">
    <div class="min-h-screen">

        {{-- Hero --}}
        <section class="relative min-h-[480px] flex items-center justify-center px-4 py-24">
            <div class="hidden md:absolute md:block top-20 left-10 animate-bounce delay-100">
                <div class="bg-violet-500/20 backdrop-blur-lg rounded-3xl p-4 text-4xl">🗺️</div>
            </div>
            <div class="hidden md:absolute md:block top-40 right-16 animate-bounce delay-300">
                <div class="bg-cyan-500/20 backdrop-blur-lg rounded-3xl p-4 text-4xl">🚀</div>
            </div>
            <div class="hidden md:absolute md:block bottom-32 left-24 animate-bounce delay-500">
                <div class="bg-pink-500/20 backdrop-blur-lg rounded-3xl p-4 text-4xl">💡</div>
            </div>
            <div class="hidden md:absolute md:block bottom-16 right-10 animate-bounce delay-200">
                <div class="bg-amber-500/20 backdrop-blur-lg rounded-3xl p-4 text-4xl">🎯</div>
            </div>

            <div class="max-w-4xl mx-auto text-center z-10">
                <div class="inline-flex items-center gap-2 bg-violet-500/10 border border-violet-500/30 text-violet-300 text-sm px-4 py-2 rounded-full mb-6 font-medium">
                    <span>🗺️</span> Panduan Belajar IT
                </div>
                <h1 class="text-5xl md:text-6xl font-extrabold mb-6 bg-gradient-to-r from-violet-400 via-cyan-400 to-pink-400 bg-clip-text text-transparent drop-shadow-lg">
                    Roadmap Belajar IT
                </h1>
                <p class="text-xl md:text-2xl text-gray-200 mb-6 max-w-3xl mx-auto font-medium">
                    Panduan alur belajar yang kami rekomendasikan untuk berbagai jalur karir di dunia teknologi
                </p>
                <p class="text-lg text-gray-400 max-w-2xl mx-auto">
                    Pilih jalur yang sesuai dengan minat dan tujuan karirmu. Setiap roadmap dirancang dari nol hingga siap kerja.
                </p>
                <div class="flex flex-wrap justify-center gap-4 mt-8">
                    <div class="bg-white/5 border border-white/10 rounded-full px-5 py-2 text-sm text-gray-300">
                        🛤️ <strong class="text-violet-300">{{ 1 }}</strong> Roadmap tersedia
                    </div>
                    <div class="bg-white/5 border border-white/10 rounded-full px-5 py-2 text-sm text-gray-300">
                        📅 Terus <strong class="text-cyan-300">diperbarui</strong>
                    </div>
                    <div class="bg-white/5 border border-white/10 rounded-full px-5 py-2 text-sm text-gray-300">
                        🎯 Dari <strong class="text-pink-300">Pemula → Siap Kerja</strong>
                    </div>
                </div>
            </div>
        </section>

        {{-- Roadmap Cards --}}
        <section class="py-16 px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold mb-3">Pilih Jalur Karirmu</h2>
                    <p class="text-gray-400">Setiap roadmap berisi kurikulum lengkap, estimasi waktu, dan rekomendasi sumber belajar</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    {{-- Website Developer --}}
                    <a href="{{ route('roadmap.website-developer') }}" class="group block">
                        <div class="bg-gradient-to-br from-cyan-600/15 via-blue-600/10 to-indigo-600/15 backdrop-blur-xl rounded-3xl p-8 border border-cyan-500/30 hover:border-cyan-400/60 transition-all duration-300 hover:shadow-xl hover:shadow-cyan-500/10 hover:-translate-y-1 h-full flex flex-col">
                            <div class="flex items-start justify-between mb-6">
                                <div class="w-16 h-16 rounded-2xl bg-cyan-500/20 flex items-center justify-center text-3xl">🌐</div>
                                <div class="bg-cyan-500/10 border border-cyan-500/20 text-cyan-300 text-xs px-3 py-1 rounded-full font-medium">Tersedia</div>
                            </div>
                            <h3 class="text-xl font-bold mb-3 group-hover:text-cyan-300 transition-colors">Website Developer</h3>
                            <p class="text-gray-400 text-sm mb-6 flex-1">
                                Dari HTML, CSS, JavaScript hingga framework modern, backend, dan deployment. Panduan lengkap menjadi web developer profesional.
                            </p>
                            <div class="space-y-2 mb-6">
                                <div class="flex flex-wrap gap-2">
                                    <span class="bg-cyan-500/10 border border-cyan-500/20 text-cyan-300 text-xs px-2 py-0.5 rounded-full">HTML & CSS</span>
                                    <span class="bg-yellow-500/10 border border-yellow-500/20 text-yellow-300 text-xs px-2 py-0.5 rounded-full">JavaScript</span>
                                    <span class="bg-blue-500/10 border border-blue-500/20 text-blue-300 text-xs px-2 py-0.5 rounded-full">React</span>
                                    <span class="bg-green-500/10 border border-green-500/20 text-green-300 text-xs px-2 py-0.5 rounded-full">Backend</span>
                                    <span class="bg-purple-500/10 border border-purple-500/20 text-purple-300 text-xs px-2 py-0.5 rounded-full">Deployment</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 text-xs text-gray-400 border-t border-white/10 pt-4">
                                <span>⏱ 6–18 bulan</span>
                                <span>·</span>
                                <span>🗂 7 fase</span>
                                <span>·</span>
                                <span>🎯 Pemula → Pro</span>
                            </div>
                            <div class="mt-4 flex items-center gap-2 text-cyan-300 text-sm font-semibold group-hover:gap-3 transition-all">
                                Lihat Roadmap <span>→</span>
                            </div>
                        </div>
                    </a>

                    {{-- Coming Soon: Backend Developer --}}
                    <div class="opacity-60 cursor-not-allowed">
                        <div class="bg-white/3 backdrop-blur-xl rounded-3xl p-8 border border-white/10 h-full flex flex-col">
                            <div class="flex items-start justify-between mb-6">
                                <div class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center text-3xl">🖥️</div>
                                <div class="bg-white/5 border border-white/10 text-gray-400 text-xs px-3 py-1 rounded-full font-medium">Segera Hadir</div>
                            </div>
                            <h3 class="text-xl font-bold mb-3 text-gray-300">Backend Developer</h3>
                            <p class="text-gray-500 text-sm mb-6 flex-1">
                                Fokus pada server-side programming, database, API design, sistem terdistribusi, dan infrastruktur backend.
                            </p>
                            <div class="flex flex-wrap gap-2 mb-6">
                                <span class="bg-white/5 border border-white/10 text-gray-500 text-xs px-2 py-0.5 rounded-full">Laravel / Node.js</span>
                                <span class="bg-white/5 border border-white/10 text-gray-500 text-xs px-2 py-0.5 rounded-full">Database</span>
                                <span class="bg-white/5 border border-white/10 text-gray-500 text-xs px-2 py-0.5 rounded-full">API Design</span>
                                <span class="bg-white/5 border border-white/10 text-gray-500 text-xs px-2 py-0.5 rounded-full">Docker</span>
                            </div>
                            <div class="flex items-center gap-4 text-xs text-gray-500 border-t border-white/5 pt-4">
                                <span>⏱ 6–12 bulan</span>
                                <span>·</span>
                                <span>🎯 Pemula → Pro</span>
                            </div>
                        </div>
                    </div>

                    {{-- Coming Soon: Mobile Developer --}}
                    <div class="opacity-60 cursor-not-allowed">
                        <div class="bg-white/3 backdrop-blur-xl rounded-3xl p-8 border border-white/10 h-full flex flex-col">
                            <div class="flex items-start justify-between mb-6">
                                <div class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center text-3xl">📱</div>
                                <div class="bg-white/5 border border-white/10 text-gray-400 text-xs px-3 py-1 rounded-full font-medium">Segera Hadir</div>
                            </div>
                            <h3 class="text-xl font-bold mb-3 text-gray-300">Mobile Developer</h3>
                            <p class="text-gray-500 text-sm mb-6 flex-1">
                                Bangun aplikasi iOS dan Android dari nol. Pelajari React Native atau Flutter untuk cross-platform development.
                            </p>
                            <div class="flex flex-wrap gap-2 mb-6">
                                <span class="bg-white/5 border border-white/10 text-gray-500 text-xs px-2 py-0.5 rounded-full">React Native</span>
                                <span class="bg-white/5 border border-white/10 text-gray-500 text-xs px-2 py-0.5 rounded-full">Flutter</span>
                                <span class="bg-white/5 border border-white/10 text-gray-500 text-xs px-2 py-0.5 rounded-full">iOS & Android</span>
                            </div>
                            <div class="flex items-center gap-4 text-xs text-gray-500 border-t border-white/5 pt-4">
                                <span>⏱ 6–12 bulan</span>
                                <span>·</span>
                                <span>🎯 Pemula → Pro</span>
                            </div>
                        </div>
                    </div>

                    {{-- Coming Soon: DevOps --}}
                    <div class="opacity-60 cursor-not-allowed">
                        <div class="bg-white/3 backdrop-blur-xl rounded-3xl p-8 border border-white/10 h-full flex flex-col">
                            <div class="flex items-start justify-between mb-6">
                                <div class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center text-3xl">⚙️</div>
                                <div class="bg-white/5 border border-white/10 text-gray-400 text-xs px-3 py-1 rounded-full font-medium">Segera Hadir</div>
                            </div>
                            <h3 class="text-xl font-bold mb-3 text-gray-300">DevOps Engineer</h3>
                            <p class="text-gray-500 text-sm mb-6 flex-1">
                                CI/CD, containerization, cloud infrastructure, monitoring, dan otomasi deployment untuk tim engineering.
                            </p>
                            <div class="flex flex-wrap gap-2 mb-6">
                                <span class="bg-white/5 border border-white/10 text-gray-500 text-xs px-2 py-0.5 rounded-full">Docker & K8s</span>
                                <span class="bg-white/5 border border-white/10 text-gray-500 text-xs px-2 py-0.5 rounded-full">CI/CD</span>
                                <span class="bg-white/5 border border-white/10 text-gray-500 text-xs px-2 py-0.5 rounded-full">AWS / GCP</span>
                            </div>
                            <div class="flex items-center gap-4 text-xs text-gray-500 border-t border-white/5 pt-4">
                                <span>⏱ 6–12 bulan</span>
                                <span>·</span>
                                <span>🎯 Pemula → Pro</span>
                            </div>
                        </div>
                    </div>

                    {{-- Coming Soon: Data Science --}}
                    <div class="opacity-60 cursor-not-allowed">
                        <div class="bg-white/3 backdrop-blur-xl rounded-3xl p-8 border border-white/10 h-full flex flex-col">
                            <div class="flex items-start justify-between mb-6">
                                <div class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center text-3xl">📊</div>
                                <div class="bg-white/5 border border-white/10 text-gray-400 text-xs px-3 py-1 rounded-full font-medium">Segera Hadir</div>
                            </div>
                            <h3 class="text-xl font-bold mb-3 text-gray-300">Data Science & AI</h3>
                            <p class="text-gray-500 text-sm mb-6 flex-1">
                                Analisis data, machine learning, deep learning, dan AI engineering untuk era kecerdasan buatan.
                            </p>
                            <div class="flex flex-wrap gap-2 mb-6">
                                <span class="bg-white/5 border border-white/10 text-gray-500 text-xs px-2 py-0.5 rounded-full">Python</span>
                                <span class="bg-white/5 border border-white/10 text-gray-500 text-xs px-2 py-0.5 rounded-full">ML / DL</span>
                                <span class="bg-white/5 border border-white/10 text-gray-500 text-xs px-2 py-0.5 rounded-full">TensorFlow</span>
                            </div>
                            <div class="flex items-center gap-4 text-xs text-gray-500 border-t border-white/5 pt-4">
                                <span>⏱ 8–18 bulan</span>
                                <span>·</span>
                                <span>🎯 Pemula → Pro</span>
                            </div>
                        </div>
                    </div>

                    {{-- Coming Soon: UI/UX --}}
                    <div class="opacity-60 cursor-not-allowed">
                        <div class="bg-white/3 backdrop-blur-xl rounded-3xl p-8 border border-white/10 h-full flex flex-col">
                            <div class="flex items-start justify-between mb-6">
                                <div class="w-16 h-16 rounded-2xl bg-white/5 flex items-center justify-center text-3xl">🎨</div>
                                <div class="bg-white/5 border border-white/10 text-gray-400 text-xs px-3 py-1 rounded-full font-medium">Segera Hadir</div>
                            </div>
                            <h3 class="text-xl font-bold mb-3 text-gray-300">UI/UX Designer</h3>
                            <p class="text-gray-500 text-sm mb-6 flex-1">
                                Desain antarmuka yang intuitif dan pengalaman pengguna yang menyenangkan menggunakan Figma dan prinsip desain modern.
                            </p>
                            <div class="flex flex-wrap gap-2 mb-6">
                                <span class="bg-white/5 border border-white/10 text-gray-500 text-xs px-2 py-0.5 rounded-full">Figma</span>
                                <span class="bg-white/5 border border-white/10 text-gray-500 text-xs px-2 py-0.5 rounded-full">Design System</span>
                                <span class="bg-white/5 border border-white/10 text-gray-500 text-xs px-2 py-0.5 rounded-full">Prototyping</span>
                            </div>
                            <div class="flex items-center gap-4 text-xs text-gray-500 border-t border-white/5 pt-4">
                                <span>⏱ 4–10 bulan</span>
                                <span>·</span>
                                <span>🎯 Pemula → Pro</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- How to Use Section --}}
        <section class="py-16 px-4">
            <div class="max-w-5xl mx-auto">
                <div class="bg-gradient-to-r from-violet-600/20 via-purple-600/20 to-pink-600/20 backdrop-blur-xl rounded-3xl p-10 border border-violet-500/30">
                    <h2 class="text-2xl font-bold mb-8 text-center">Cara Menggunakan Roadmap Ini</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="w-14 h-14 rounded-2xl bg-violet-500/20 flex items-center justify-center text-2xl mx-auto mb-4">1️⃣</div>
                            <h3 class="font-semibold text-violet-300 mb-2">Pilih Jalur</h3>
                            <p class="text-gray-400 text-sm">Pilih roadmap yang sesuai dengan minat dan tujuan karirmu. Tidak perlu ikuti semua — fokus pada satu jalur dulu.</p>
                        </div>
                        <div class="text-center">
                            <div class="w-14 h-14 rounded-2xl bg-purple-500/20 flex items-center justify-center text-2xl mx-auto mb-4">2️⃣</div>
                            <h3 class="font-semibold text-purple-300 mb-2">Ikuti Berurutan</h3>
                            <p class="text-gray-400 text-sm">Setiap fase membangun fondasi untuk fase berikutnya. Jangan skip langkah kecuali kamu sudah benar-benar menguasainya.</p>
                        </div>
                        <div class="text-center">
                            <div class="w-14 h-14 rounded-2xl bg-pink-500/20 flex items-center justify-center text-2xl mx-auto mb-4">3️⃣</div>
                            <h3 class="font-semibold text-pink-300 mb-2">Bangun & Deploy</h3>
                            <p class="text-gray-400 text-sm">Setiap fase punya project nyata. Bangun, deploy, dan share ke komunitas — ini yang akan membuat CV-mu berbeda.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Community CTA --}}
        <section class="py-16 px-4">
            <div class="max-w-4xl mx-auto">
                <div class="bg-gradient-to-r from-cyan-600/30 via-violet-600/30 to-pink-600/30 backdrop-blur-xl rounded-3xl p-12 border border-violet-500/30 text-center">
                    <h2 class="text-3xl font-bold mb-4">Belajar Lebih Seru Bersama Komunitas</h2>
                    <p class="text-lg text-gray-300 mb-8 max-w-xl mx-auto">
                        Bergabung dengan ribuan developer Indonesia yang sedang belajar dan bertumbuh bersama di Baricode.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        @auth
                        <a href="{{ route('lms.courses') }}" class="px-8 py-4 bg-gradient-to-r from-violet-600 to-cyan-600 rounded-full font-bold text-lg hover:shadow-lg hover:shadow-violet-500/30 transition-all transform hover:scale-105">
                            📚 Mulai Belajar
                        </a>
                        @else
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-gradient-to-r from-violet-600 to-cyan-600 rounded-full font-bold text-lg hover:shadow-lg hover:shadow-violet-500/30 transition-all transform hover:scale-105">
                            ✨ Gabung Gratis
                        </a>
                        @endauth
                        <a href="{{ route('how-to-learn') }}" class="px-8 py-4 bg-white/10 border border-white/20 rounded-full font-bold text-lg hover:bg-white/20 transition-all">
                            📖 Cara Belajar di Baricode
                        </a>
                    </div>
                    @guest
                    <p class="text-gray-400 mt-6 text-sm">
                        Sudah punya akun? <a href="{{ route('login') }}" class="text-cyan-300 hover:underline">Login sekarang</a>
                    </p>
                    @endguest
                </div>
            </div>
        </section>

    </div>
</x-layouts.base>
