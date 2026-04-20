<x-layouts.base :title="'Keluarga Baricode'">
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-12">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-2 bg-gradient-to-r from-purple-400 via-violet-400 to-indigo-400 bg-clip-text text-transparent">
                    Keluarga Baricode
                </h1>
                <p class="text-gray-300 text-lg">
                    Temui {{ $members->total() }} anggota komunitas kami yang luar biasa
                </p>
            </div>

            <!-- Search Section -->
            <div class="mb-8">
                <form method="GET" action="{{ route('family.index') }}" class="flex gap-2">
                    <input
                        type="text"
                        name="q"
                        placeholder="Cari nama atau username..."
                        value="{{ $search }}"
                        class="flex-1 px-4 py-3 rounded-lg bg-gray-800/50 border border-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    >
                    <button
                        type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg font-semibold hover:shadow-lg hover:shadow-purple-500/40 transition-all"
                    >
                        Cari
                    </button>
                </form>
            </div>

            <!-- Members Grid -->
            @if ($members->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    @foreach ($members as $member)
                        <a href="{{ route('family.show', $member->username) }}" class="group">
                            <div class="bg-gray-800/50 backdrop-blur-sm border border-gray-700 rounded-xl p-6 hover:border-indigo-500 hover:bg-gray-800/70 transition-all duration-300">
                                <!-- Avatar -->
                                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-purple-500 to-indigo-500 flex items-center justify-center mb-4 group-hover:shadow-lg group-hover:shadow-indigo-500/40 transition-all">
                                    <span class="text-2xl font-bold text-white">
                                        {{ $member->initials() }}
                                    </span>
                                </div>

                                <!-- Name & Username -->
                                <h3 class="text-lg font-bold text-white mb-1 group-hover:text-indigo-300 transition-colors">
                                    {{ $member->name }}
                                </h3>
                                <p class="text-gray-400 text-sm mb-3">
                                    @{{ '@' }}{{ $member->username }}
                                </p>

                                <!-- Bio -->
                                <p class="text-gray-300 text-sm line-clamp-2 mb-4">
                                    {{ $member->bio ?? 'Belum ada bio.' }}
                                </p>

                                <!-- Join Date -->
                                <p class="text-gray-500 text-xs">
                                    Bergabung {{ $member->created_at->format('M Y') }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($members->hasPages())
                    <div class="flex justify-center">
                        {{ $members->links() }}
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="text-6xl mb-4">🔍</div>
                    <h3 class="text-2xl font-bold text-white mb-2">
                        Tidak ada anggota ditemukan
                    </h3>
                    <p class="text-gray-400 mb-8">
                        @if ($search)
                            Coba cari dengan nama atau username yang berbeda
                        @else
                            Belum ada anggota komunitas.
                        @endif
                    </p>
                    @if ($search)
                        <a href="{{ route('family.index') }}" class="text-indigo-400 hover:text-indigo-300">
                            ← Kembali ke daftar
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-layouts.base>
