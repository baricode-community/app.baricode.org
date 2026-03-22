<x-layouts.dashboard :title="__('Baricode LMS')">

    <div class="max-w-7xl mx-auto px-4 py-12 space-y-14">

        {{-- Kursus Sedang Berjalan (hanya untuk user yang login & punya enrollment aktif) --}}
        @auth
            @if ($activeEnrollments->isNotEmpty())
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 rounded-lg bg-green-500/10 border border-green-500/20">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white">Kursus Sedang Berjalan</h2>
                        <span class="text-xs font-medium px-2.5 py-1 rounded-full bg-green-500/10 border border-green-500/20 text-green-400">
                            {{ $activeEnrollments->count() }} aktif
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                        @foreach ($activeEnrollments as $enrollment)
                            @php
                                $course = $enrollment->course;
                                $totalModules = $course->categories->count();
                                $approvedModules = $enrollment->categoryProgress->count();
                                $progress = $totalModules > 0 ? round(($approvedModules / $totalModules) * 100) : 0;
                            @endphp

                            <div class="bg-white/5 backdrop-blur-lg border border-green-500/20 rounded-xl p-5 flex flex-col gap-4 hover:border-green-400/40 hover:shadow-lg hover:shadow-green-500/10 transition">

                                {{-- Header kursus --}}
                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex-1 min-w-0">
                                        <span class="inline-flex items-center gap-1.5 text-xs font-medium text-green-400 mb-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                                            Sedang Berjalan
                                        </span>
                                        <h3 class="font-bold text-white text-base leading-snug line-clamp-2">
                                            {{ $course->title }}
                                        </h3>
                                    </div>
                                    <div class="shrink-0 w-10 h-10 rounded-lg bg-green-500/10 border border-green-500/20 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>

                                {{-- Progress bar --}}
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-purple-300">Progress Modul</span>
                                        <span class="font-semibold text-white">{{ $approvedModules }}/{{ $totalModules }} selesai</span>
                                    </div>
                                    <div class="w-full bg-white/10 rounded-full h-2 overflow-hidden">
                                        <div
                                            class="h-2 rounded-full transition-all duration-500 {{ $progress === 100 ? 'bg-green-400' : 'bg-gradient-to-r from-green-500 to-emerald-400' }}"
                                            style="width: {{ $progress }}%">
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between text-xs text-purple-400">
                                        <span>{{ $progress }}% selesai</span>
                                        @if ($enrollment->approved_at)
                                            <span>Mulai {{ $enrollment->approved_at->translatedFormat('d M Y') }}</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Tombol lanjutkan --}}
                                <a href="{{ route('lms.course', $course->slug) }}"
                                    class="mt-auto w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-green-500/15 border border-green-500/30 text-green-400 text-sm font-medium hover:bg-green-500/25 hover:border-green-400/50 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                                    </svg>
                                    Lanjutkan Belajar
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endauth

        {{-- Sebagian Kursus Tersedia --}}
        <div>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-white">Beberapa Kursus Tersedia</h2>
                <a href="{{ route('lms.all-courses') }}"
                    class="text-purple-300 hover:text-purple-200 text-sm transition">Jelajahi Semua Kursus →</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($courses as $course)
                    <a href="{{ route('lms.course', $course->slug) }}"
                        class="bg-white/5 backdrop-blur-lg border border-purple-500/20 hover:border-green-500/50 rounded-lg overflow-hidden hover:shadow-xl hover:shadow-green-500/20 transition group cursor-pointer block">
                        <div
                            class="h-40 bg-gradient-to-br from-green-500/20 to-emerald-500/20 flex items-center justify-center">
                            <svg class="w-16 h-16 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-white group-hover:text-green-400 transition mb-2">
                                {{ $course->title }}</h3>
                            <p class="text-purple-300 text-sm mb-4">{{ $course->description }}</p>
                            <div class="flex items-center justify-between text-xs text-purple-400">
                                <span>{{ $course->categories->count() }} Modul</span>
                                <span class="text-green-400">Gratis</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

    </div>
</x-layouts.dashboard>
