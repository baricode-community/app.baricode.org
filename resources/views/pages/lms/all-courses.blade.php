<x-layouts.dashboard :title="__('Semua Kursus - Baricode LMS')">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-purple-800 to-indigo-800 text-white py-12 border-b border-purple-600">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-4xl font-bold mb-2">Jelajahi Semua Kursus 🚀</h1>
            <p class="text-purple-200 text-lg mb-6">Temukan kursus yang tepat untuk mengembangkan skill coding kamu</p>

            <!-- Self-Paced Learning Info -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 flex-wrap">
                <div class="flex items-center gap-3 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-lg border border-white/20">
                    <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1V3a1 1 0 011-1h5a1 1 0 011 1v1h1V3a1 1 0 011 1v2h2a2 2 0 012 2v2h1a1 1 0 110 2h-1v6h1a1 1 0 110 2h-1v2a2 2 0 01-2 2h-2v1a1 1 0 11-2 0v-1H9v1a1 1 0 11-2 0v-1H5a2 2 0 01-2-2v-2H2a1 1 0 110-2h1V9H2a1 1 0 010-2h1V5a2 2 0 012-2h2V3a1 1 0 010-2h5a1 1 0 011 1v1h1V3a1 1 0 011-1H5zm12 5a1 1 0 01-1 1H4a1 1 0 01-1-1V5h14v2z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm font-medium">Belajar Mandiri - Kapan Saja, Dimana Saja 📚</span>
                </div>

                <a href="https://chat.whatsapp.com/Fb2ZFMIKDz7JJZyBVpzXws" target="_blank" class="flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-semibold transition transform hover:scale-105 shadow-lg">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-5.031 1.378c-3.055 2.169-3.865 6.15-1.728 9.244 1.592 2.238 4.165 2.728 5.55 2.468h.004c.3-.038.573-.125.855-.236l3.686 1.237-.96-3.02c.2-.537.34-1.115.34-1.727C14.596 11.366 11.172 7.979 6.951 7.979z"></path>
                    </svg>
                    Bergabung WhatsApp Group
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        <!-- Search Section -->
        <div class="mb-12">
            <form action="{{ route('lms.courses') }}" method="GET" class="max-w-2xl">
                <div class="relative group">
                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Cari kursus berdasarkan judul atau deskripsi..."
                        class="w-full px-6 py-4 bg-white/5 backdrop-blur-lg border-2 border-purple-500/30 rounded-lg text-white placeholder-purple-400 focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-500/50 transition"
                    >
                    <button
                        type="submit"
                        class="absolute right-3 top-1/2 -translate-y-1/2 bg-purple-600 hover:bg-purple-500 text-white px-6 py-2 rounded-lg transition"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>

                @if($search)
                    <div class="mt-4 p-4 bg-purple-500/10 border border-purple-500/30 rounded-lg flex items-center justify-between">
                        <p class="text-purple-300">Hasil pencarian untuk: <span class="font-bold text-white">{{ $search }}</span></p>
                        <a href="{{ route('lms.courses') }}" class="text-purple-400 hover:text-purple-300 text-sm">Bersihkan</a>
                    </div>
                @endif
            </form>
        </div>

        <!-- Courses Grid -->
        @if($courses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @foreach($courses as $course)
                    <a
                        href="{{ route('lms.course', $course->slug) }}"
                        class="group bg-white/5 backdrop-blur-lg border border-purple-500/20 rounded-xl overflow-hidden hover:border-purple-500/60 hover:shadow-2xl hover:shadow-purple-500/20 transition duration-300 transform hover:scale-105 hover:-translate-y-1"
                    >
                        <!-- Course Header Image -->
                        <div class="relative h-48 bg-gradient-to-br from-purple-600 to-indigo-600 flex items-center justify-center overflow-hidden">
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-300">
                                <div class="absolute inset-0 bg-gradient-to-r from-purple-500 via-violet-500 to-indigo-500 animate-pulse"></div>
                            </div>
                            <div class="relative z-10 text-center">
                                <svg class="w-20 h-20 text-white mx-auto mb-2 group-hover:scale-110 transition duration-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Course Info -->
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-white group-hover:text-purple-300 transition mb-2 line-clamp-2">
                                {{ $course->title }}
                            </h3>
                            <p class="text-purple-300 text-sm mb-4 line-clamp-2">
                                {{ $course->description }}
                            </p>

                            <!-- Stats -->
                            <div class="flex items-center justify-between mb-4 text-xs text-purple-400">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zm2 1a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2h-1zM4 8a1 1 0 001 1h6a1 1 0 100-2H5a1 1 0 00-1 1zm6 3a1 1 0 110 2h1a1 1 0 110-2h-1z"></path>
                                    </svg>
                                    {{ $course->categories->count() }} Modul
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8.5 2a1 1 0 00-1 1v.341L6.854 2.854a1 1 0 10-1.415 1.415L6.172 5H2a1 1 0 000 2h.341L1.146 7.854a1 1 0 001.415 1.415L4.828 8H6a1 1 0 100-2H5.828L7.854 4.146a1 1 0 00-1.415-1.415L8.5 4.172V3a1 1 0 00-1-1h1zm5 2a1 1 0 00-1 1v.341l-1.854-1.854a1 1 0 10-1.415 1.415L11.172 5H7a1 1 0 000 2h.341l-1.146 1.854a1 1 0 001.415 1.415L9.828 8H11a1 1 0 100-2h-.172l2.026-2.026a1 1 0 00-1.415-1.415L13.5 4.172V3a1 1 0 00-1-1h1zm5 0a1 1 0 00-1 1v.341l-1.854-1.854a1 1 0 10-1.415 1.415L16.172 5H12a1 1 0 000 2h.341l-1.146 1.854a1 1 0 001.415 1.415L14.828 8H16a1 1 0 100-2h-.172l2.026-2.026a1 1 0 00-1.415-1.415L18.5 4.172V3a1 1 0 00-1-1h1z"></path>
                                    </svg>
                                    {{ $course->categories->sum(fn($cat) => $cat->lessons->count()) }} Lessons
                                </span>
                            </div>

                            <!-- Badge -->
                            <div class="inline-block px-3 py-1 bg-green-500/10 border border-green-500/30 rounded-full text-green-400 text-xs font-semibold mb-4">
                                ✓ Gratis
                            </div>

                            <!-- Footer -->
                            <div class="pt-4 border-t border-purple-500/20 flex items-center justify-between">
                                <span class="text-xs text-purple-400">Klik untuk membuka →</span>
                                <div class="group-hover:translate-x-1 transition">
                                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                <div class="flex flex-col items-center gap-6">
                    <div class="flex flex-wrap gap-2 justify-center">
                        @if ($courses->onFirstPage())
                            <button disabled class="px-4 py-2 bg-white/5 text-purple-500 rounded-lg cursor-not-allowed opacity-50">
                                ← Sebelumnya
                            </button>
                        @else
                            <a href="{{ $courses->previousPageUrl() }}&search={{ urlencode($search) }}" class="px-4 py-2 bg-white/5 border border-purple-500/20 hover:bg-purple-600 text-white rounded-lg transition">
                                ← Sebelumnya
                            </a>
                        @endif

                        @foreach ($courses->getUrlRange(1, $courses->lastPage()) as $page => $url)
                            @if ($page == $courses->currentPage())
                                <button disabled class="px-4 py-2 bg-purple-600 text-white rounded-lg font-semibold">
                                    {{ $page }}
                                </button>
                            @else
                                <a href="{{ $url }}&search={{ urlencode($search) }}" class="px-4 py-2 bg-white/5 border border-purple-500/20 hover:bg-purple-600 text-white rounded-lg transition">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach

                        @if ($courses->hasMorePages())
                            <a href="{{ $courses->nextPageUrl() }}&search={{ urlencode($search) }}" class="px-4 py-2 bg-white/5 border border-purple-500/20 hover:bg-purple-600 text-white rounded-lg transition">
                                Selanjutnya →
                            </a>
                        @else
                            <button disabled class="px-4 py-2 bg-white/5 text-purple-500 rounded-lg cursor-not-allowed opacity-50">
                                Selanjutnya →
                            </button>
                        @endif
                    </div>

                    <p class="text-purple-400 text-sm">
                        Menampilkan <span class="text-white font-semibold">{{ $courses->firstItem() . ' - ' . $courses->lastItem() }}</span> dari <span class="text-white font-semibold">{{ $courses->total() }}</span> kursus
                    </p>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <svg class="w-24 h-24 mx-auto text-purple-700 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-2xl font-bold text-white mb-2">Tidak Ada Kursus Ditemukan</h3>
                <p class="text-purple-300 mb-6">Maaf, tidak ada kursus yang sesuai dengan pencarian "<span class="font-semibold text-white">{{ $search }}</span>"</p>
                <a href="{{ route('lms.courses') }}" class="inline-block px-6 py-3 bg-purple-600 hover:bg-purple-500 text-white rounded-lg transition">
                    Lihat Semua Kursus
                </a>
            </div>
        @endif
    </div>

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</x-layouts.dashboard>