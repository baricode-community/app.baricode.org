<x-layouts.base :title="$user->name . ' — Anggota Baricode'">
    <div class="min-h-screen py-10 px-4">
        <div class="max-w-3xl mx-auto">

            <!-- Back -->
            <a href="{{ route('family.index') }}" class="inline-flex items-center gap-1 text-purple-300 hover:text-white mb-8 transition-colors text-sm">
                ← Kembali ke Keluarga Baricode
            </a>

            <!-- Hero Card -->
            <div class="relative bg-gradient-to-br from-purple-800/40 via-violet-800/30 to-indigo-800/40 backdrop-blur-sm border border-purple-500/30 rounded-2xl p-8 mb-6 overflow-hidden">
                <!-- Decorative blobs -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-purple-500/10 rounded-full blur-3xl -mr-32 -mt-32 pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-indigo-500/10 rounded-full blur-3xl -ml-24 -mb-24 pointer-events-none"></div>

                <div class="relative flex flex-col sm:flex-row items-center sm:items-start gap-6">
                    <!-- Avatar -->
                    <div class="flex-shrink-0">
                        <div class="w-24 h-24 md:w-28 md:h-28 rounded-2xl bg-gradient-to-br from-purple-500 to-indigo-500 flex items-center justify-center shadow-lg shadow-purple-500/30">
                            <span class="text-4xl md:text-5xl font-extrabold text-white">
                                {{ $user->initials() }}
                            </span>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="flex-1 text-center sm:text-left">
                        <h1 class="text-3xl md:text-4xl font-extrabold text-white leading-tight">
                            {{ $user->name }}
                        </h1>
                        <p class="text-purple-300 text-sm mt-1">@{{ $user->username }}</p>

                        <div class="flex flex-wrap gap-2 justify-center sm:justify-start mt-3">
                            <span class="px-3 py-1 bg-purple-500/20 border border-purple-500/40 text-purple-200 text-xs rounded-full">
                                🧑‍💻 Anggota Baricode
                            </span>
                            <span class="px-3 py-1 bg-indigo-500/20 border border-indigo-500/40 text-indigo-200 text-xs rounded-full">
                                📅 Bergabung {{ $user->created_at->format('F Y') }}
                            </span>
                            @if ($user->hasRole('admin'))
                                <span class="px-3 py-1 bg-yellow-500/20 border border-yellow-500/40 text-yellow-200 text-xs rounded-full">
                                    ⭐ Admin
                                </span>
                            @endif
                        </div>

                        @if ($user->bio)
                            <p class="text-gray-300 mt-4 leading-relaxed text-sm md:text-base">
                                {{ $user->bio }}
                            </p>
                        @else
                            <p class="text-gray-500 mt-4 italic text-sm">Belum ada bio — tapi orangnya pasti keren!</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Aktivitas -->
            <div class="grid grid-cols-3 gap-3 mb-6">
                <div class="bg-white/5 border border-white/10 rounded-xl p-4 text-center">
                    <div class="text-3xl font-extrabold text-purple-300 leading-none">
                        {{ $user->dailyCommitTrackers->count() }}
                    </div>
                    <p class="text-xs text-gray-400 mt-1 leading-snug">Hari<br>Aktif Belajar</p>
                    <p class="text-lg mt-1">🔥</p>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-xl p-4 text-center">
                    <div class="text-3xl font-extrabold text-violet-300 leading-none">
                        {{ $user->meets->count() }}
                    </div>
                    <p class="text-xs text-gray-400 mt-1 leading-snug">Event<br>Dihadiri</p>
                    <p class="text-lg mt-1">🎉</p>
                </div>
                <div class="bg-white/5 border border-white/10 rounded-xl p-4 text-center">
                    <div class="text-3xl font-extrabold text-indigo-300 leading-none">
                        {{ $user->certificates->count() }}
                    </div>
                    <p class="text-xs text-gray-400 mt-1 leading-snug">Sertifikat<br>Diraih</p>
                    <p class="text-lg mt-1">🏆</p>
                </div>
            </div>

            <!-- Sertifikat -->
            @if ($user->certificates->isNotEmpty())
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 mb-6">
                    <h2 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                        🏆 Sertifikat yang Diraih
                    </h2>
                    <div class="space-y-3">
                        @foreach ($user->certificates as $cert)
                            <div class="flex items-center gap-3 bg-yellow-500/10 border border-yellow-500/20 rounded-xl px-4 py-3">
                                <div class="text-2xl flex-shrink-0">🎓</div>
                                <div>
                                    <p class="text-sm font-semibold text-yellow-200">{{ $cert->name }}</p>
                                    @if ($cert->pivot->issued_at)
                                        <p class="text-xs text-gray-400">Diterima {{ \Carbon\Carbon::parse($cert->pivot->issued_at)->format('d F Y') }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Kursus yang Sedang Diambil -->
            @if ($user->activeEnrollments->isNotEmpty())
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 mb-6">
                    <h2 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                        📚 Sedang Belajar
                    </h2>
                    <div class="space-y-2">
                        @foreach ($user->activeEnrollments->take(5) as $enrollment)
                            @if ($enrollment->course)
                                <div class="flex items-center gap-3 bg-purple-500/10 border border-purple-500/20 rounded-xl px-4 py-3">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-purple-500 to-indigo-500 flex items-center justify-center text-sm flex-shrink-0">📖</div>
                                    <p class="text-sm text-gray-200 font-medium">{{ $enrollment->course->title }}</p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Meme -->
            @if ($user->meme)
                <div class="bg-white/5 border border-white/10 rounded-2xl p-6 mb-6">
                    <h2 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                        😂 Meme Andalan
                    </h2>
                    <div class="rounded-xl overflow-hidden bg-black/30">
                        @if ($user->meme->image)
                            <img src="{{ $user->meme->image }}" alt="Meme dari {{ $user->name }}" class="w-full max-h-80 object-contain">
                        @endif
                    </div>
                    @if ($user->meme->title)
                        <p class="text-gray-300 text-sm mt-3 text-center italic">"{{ $user->meme->title }}"</p>
                    @endif
                </div>
            @endif

            <!-- CTA untuk tamu -->
            @guest
                <div class="bg-gradient-to-br from-purple-600/20 to-indigo-600/20 border border-purple-500/30 rounded-2xl p-8 text-center mb-6">
                    <p class="text-2xl mb-3">👋</p>
                    <h3 class="text-lg font-bold text-white mb-2">Baru kenal Baricode?</h3>
                    <p class="text-gray-300 text-sm mb-5 max-w-sm mx-auto">
                        Baricode adalah komunitas IT Indonesia tempat belajar bareng, ngobrol soal coding, dan tumbuh bersama. Gabung gratis!
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                        <a href="{{ route('register') }}" class="px-6 py-2.5 bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold rounded-full transition-colors">
                            Gabung Sekarang — Gratis!
                        </a>
                        <a href="{{ route('family.index') }}" class="px-6 py-2.5 bg-white/10 hover:bg-white/20 text-white text-sm font-medium rounded-full transition-colors">
                            Lihat Anggota Lain
                        </a>
                    </div>
                </div>
            @endguest

            <!-- Back link -->
            <div class="text-center">
                <a href="{{ route('family.index') }}" class="text-purple-300 hover:text-white text-sm transition-colors">
                    ← Kembali ke Keluarga Baricode
                </a>
            </div>

        </div>
    </div>
</x-layouts.base>
