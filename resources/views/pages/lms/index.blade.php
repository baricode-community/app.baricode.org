<x-layouts.dashboard :title="__('Baricode LMS')">

    <div class="max-w-7xl mx-auto px-4 py-12 space-y-14">

        {{-- ===== MENUNGGU PERSETUJUAN PENDAFTARAN ===== --}}
        @auth
            @if ($pendingEnrollments->isNotEmpty())
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 rounded-lg bg-yellow-500/10 border border-yellow-500/20">
                            <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white">Menunggu Persetujuan</h2>
                        <span class="text-xs font-medium px-2.5 py-1 rounded-full bg-yellow-500/10 border border-yellow-500/20 text-yellow-400">
                            {{ $pendingEnrollments->count() }} pending
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                        @foreach ($pendingEnrollments as $enrollment)
                            <div class="bg-white/5 backdrop-blur-lg border border-yellow-500/20 rounded-xl p-5 flex flex-col gap-4">

                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex-1 min-w-0">
                                        <span class="inline-flex items-center gap-1.5 text-xs font-medium text-yellow-400 mb-2">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            Menunggu Persetujuan Admin
                                        </span>
                                        <h3 class="font-bold text-white text-base leading-snug line-clamp-2">
                                            {{ $enrollment->course->title }}
                                        </h3>
                                    </div>
                                    <div class="shrink-0 w-10 h-10 rounded-lg bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                        </svg>
                                    </div>
                                </div>

                                <p class="text-sm text-purple-300 leading-relaxed">
                                    Permintaan pendaftaranmu sedang ditinjau oleh admin. Kamu akan mendapat akses setelah disetujui.
                                </p>

                                <div class="flex items-center justify-between text-xs text-purple-400 pt-1 border-t border-white/5">
                                    <span>Didaftarkan</span>
                                    <span class="text-white font-medium">{{ $enrollment->created_at->translatedFormat('d M Y') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endauth

        {{-- ===== KURSUS SEDANG BERJALAN ===== --}}
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

                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
                        @foreach ($activeEnrollments as $enrollment)
                            @php
                                $course          = $enrollment->course;
                                $categories      = $course->categories;
                                $totalModules    = $categories->count();
                                $approvedModules = $enrollment->categoryProgress->filter(fn($cp) => $cp->status->value === 'approved')->count();
                                $completedLessonIds = $enrollment->lessonProgress->pluck('lesson_id');
                            @endphp

                            <div class="bg-white/5 backdrop-blur-lg border border-green-500/20 rounded-xl p-5 flex flex-col gap-4 hover:border-green-400/40 hover:shadow-lg hover:shadow-green-500/10 transition">

                                {{-- Header --}}
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
                                @php $progress = $totalModules > 0 ? round(($approvedModules / $totalModules) * 100) : 0; @endphp
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-purple-300">Progress Modul</span>
                                        <span class="font-semibold text-white">{{ $approvedModules }}/{{ $totalModules }} selesai</span>
                                    </div>
                                    <div class="w-full bg-white/10 rounded-full h-2 overflow-hidden">
                                        <div class="h-2 rounded-full transition-all duration-500 {{ $progress === 100 ? 'bg-green-400' : 'bg-gradient-to-r from-green-500 to-emerald-400' }}"
                                            style="width: {{ $progress }}%"></div>
                                    </div>
                                    <div class="flex items-center justify-between text-xs text-purple-400">
                                        <span>{{ $progress }}% selesai</span>
                                        @if ($enrollment->approved_at)
                                            <span>Mulai {{ $enrollment->approved_at->translatedFormat('d M Y') }}</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Rincian Modul --}}
                                @if ($categories->isNotEmpty())
                                    <div class="border-t border-white/5 pt-4 space-y-2">
                                        <p class="text-xs font-semibold text-purple-400 uppercase tracking-wider mb-3">Rincian Modul</p>
                                        @foreach ($categories as $category)
                                            @php
                                                $catProgress   = $enrollment->categoryProgress->firstWhere('category_id', $category->id);
                                                $catStatus     = $catProgress?->status?->value ?? 'in_progress';
                                                $lessonIds     = $category->lessons->pluck('id');
                                                $allCompleted  = $lessonIds->isNotEmpty() && $lessonIds->diff($completedLessonIds)->isEmpty();
                                                $isReadyToSubmit = $catStatus === 'in_progress' && $allCompleted;
                                            @endphp

                                            <div class="flex items-center justify-between gap-2 py-1.5 px-3 rounded-lg bg-white/3 hover:bg-white/5 transition">
                                                <span class="text-sm text-purple-200 truncate flex-1">{{ $category->title }}</span>

                                                @if ($catStatus === 'approved')
                                                    <span class="shrink-0 inline-flex items-center gap-1 text-xs font-medium text-green-400 bg-green-500/10 border border-green-500/20 px-2 py-0.5 rounded-full">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                                        Disetujui
                                                    </span>
                                                @elseif ($catStatus === 'submitted')
                                                    <span class="shrink-0 inline-flex items-center gap-1 text-xs font-medium text-yellow-400 bg-yellow-500/10 border border-yellow-500/20 px-2 py-0.5 rounded-full">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                                        Menunggu Review
                                                    </span>
                                                @elseif ($catStatus === 'rejected')
                                                    <span class="shrink-0 inline-flex items-center gap-1 text-xs font-medium text-red-400 bg-red-500/10 border border-red-500/20 px-2 py-0.5 rounded-full">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/></svg>
                                                        Perlu Revisi
                                                    </span>
                                                @elseif ($isReadyToSubmit)
                                                    <a href="{{ route('lms.category', $category->slug) }}"
                                                        class="shrink-0 inline-flex items-center gap-1 text-xs font-medium text-sky-400 bg-sky-500/10 border border-sky-500/20 px-2 py-0.5 rounded-full hover:bg-sky-500/20 transition">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5"/></svg>
                                                        Siap Diajukan
                                                    </a>
                                                @else
                                                    <span class="shrink-0 inline-flex items-center gap-1 text-xs font-medium text-purple-400 bg-white/5 border border-white/10 px-2 py-0.5 rounded-full">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z"/></svg>
                                                        Sedang Berjalan
                                                    </span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

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

        {{-- ===== BEBERAPA KURSUS TERSEDIA ===== --}}
        <div>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-white">Beberapa Kursus Tersedia</h2>
                <a href="{{ route('lms.courses') }}"
                    class="text-purple-300 hover:text-purple-200 text-sm transition">Jelajahi Semua Kursus →</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($courses as $course)
                    <a href="{{ route('lms.course', $course->slug) }}"
                        class="bg-white/5 backdrop-blur-lg border border-purple-500/20 hover:border-green-500/50 rounded-lg overflow-hidden hover:shadow-xl hover:shadow-green-500/20 transition group cursor-pointer block">
                        <div class="h-40 bg-gradient-to-br from-green-500/20 to-emerald-500/20 flex items-center justify-center">
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
