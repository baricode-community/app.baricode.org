<x-layouts.dashboard :title="__('Baricode Dashboard')">
    <style>
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
        }
        .animate-slideIn { animation: slideIn 0.5s ease-out forwards; }
        .animate-float { animation: float 3s ease-in-out infinite; }
        .card-delay-1 { animation-delay: 0.05s; }
        .card-delay-2 { animation-delay: 0.1s; }
        .card-delay-3 { animation-delay: 0.15s; }
        .card-delay-4 { animation-delay: 0.2s; }
        .card-delay-5 { animation-delay: 0.25s; }
        .card-delay-6 { animation-delay: 0.3s; }
        .card-delay-7 { animation-delay: 0.35s; }
        .card-delay-8 { animation-delay: 0.4s; }
        .section-delay-1 { animation-delay: 0.1s; }
        .section-delay-2 { animation-delay: 0.2s; }
        .section-delay-3 { animation-delay: 0.3s; }
        .section-delay-4 { animation-delay: 0.4s; }
    </style>

    <div class="max-w-6xl mx-auto px-4 py-6 md:px-8 space-y-8">

        {{-- ─── GREETING HEADER ─── --}}
        <div class="animate-slideIn section-delay-1 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-purple-700/50">
            <div class="flex items-center gap-4">
                <div class="animate-float w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-purple-500/30 flex-shrink-0">
                    {{ auth()->user()->initials() }}
                </div>
                <div>
                    <h1 class="text-white text-2xl font-bold">
                        Halo, {{ auth()->user()->name }}! 👋
                    </h1>
                    <p class="text-purple-300 text-sm">
                        {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }} &mdash; Semangat belajar hari ini!
                    </p>
                </div>
            </div>
            <a href="{{ route('profile.edit') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 hover:bg-white/10 border border-purple-500/20 hover:border-purple-400/40 rounded-xl text-purple-200 text-sm transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Edit Profil
            </a>
        </div>

        {{-- ─── QUICK STATS ─── --}}
        <div class="animate-slideIn section-delay-2">
            <h2 class="text-purple-300 text-xs font-semibold uppercase tracking-wider mb-3">Statistik Kamu</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                {{-- Kursus Aktif --}}
                <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-blue-500/20 p-5 hover:border-blue-400/40 transition-all duration-200">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <p class="text-white text-2xl font-bold">{{ $activeEnrollments->count() }}</p>
                    <p class="text-blue-300 text-xs mt-1">Kursus Aktif</p>
                </div>

                {{-- Kursus Selesai --}}
                <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-emerald-500/20 p-5 hover:border-emerald-400/40 transition-all duration-200">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <p class="text-white text-2xl font-bold">{{ $completedEnrollments }}</p>
                    <p class="text-emerald-300 text-xs mt-1">Kursus Selesai</p>
                </div>

                {{-- Daily Commit Streak --}}
                <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-amber-500/20 p-5 hover:border-amber-400/40 transition-all duration-200">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <p class="text-white text-2xl font-bold">{{ $commitStreak }}<span class="text-sm font-normal text-amber-300 ml-1">hari</span></p>
                    <p class="text-amber-300 text-xs mt-1">Streak Harian</p>
                </div>

                {{-- Total Commits --}}
                <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-violet-500/20 p-5 hover:border-violet-400/40 transition-all duration-200">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <p class="text-white text-2xl font-bold">{{ $totalCommits }}</p>
                    <p class="text-violet-300 text-xs mt-1">Total Commit</p>
                </div>
            </div>
        </div>

        {{-- ─── MY COURSES ─── --}}
        <div class="animate-slideIn section-delay-3">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-purple-300 text-xs font-semibold uppercase tracking-wider">Kursus Saya</h2>
                <a href="{{ route('lms.index') }}" class="text-blue-400 hover:text-blue-300 text-xs transition-colors">Lihat semua →</a>
            </div>
            @if($activeEnrollments->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($activeEnrollments as $enrollment)
                        <a href="{{ route('lms.course', $enrollment->course->slug) }}"
                           class="bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-blue-400/40 p-5 hover:shadow-lg hover:shadow-blue-500/10 transition-all duration-200 hover:-translate-y-0.5 group">
                            <div class="flex items-start justify-between mb-3">
                                <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                                <span class="text-xs px-2 py-0.5 rounded-full
                                    {{ $enrollment->status->value === 'active' ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' : 'bg-amber-500/20 text-amber-300 border border-amber-500/30' }}">
                                    {{ $enrollment->status->label() }}
                                </span>
                            </div>
                            <h3 class="text-white font-semibold text-sm leading-snug group-hover:text-blue-300 transition-colors">
                                {{ $enrollment->course->title }}
                            </h3>
                            <p class="text-purple-400 text-xs mt-2 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                                Lanjutkan belajar
                            </p>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-dashed border-purple-500/30 p-8 text-center">
                    <div class="text-4xl mb-3">📚</div>
                    <p class="text-purple-300 text-sm mb-4">Kamu belum mendaftar kursus apapun.</p>
                    <a href="{{ route('lms.courses') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-xl text-white text-sm font-semibold hover:shadow-lg hover:shadow-blue-500/30 transition-all">
                        Jelajahi Kursus
                    </a>
                </div>
            @endif
        </div>

        {{-- ─── DAILY COMMIT RECENT ENTRY ─── --}}
        <div class="animate-slideIn section-delay-3">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-purple-300 text-xs font-semibold uppercase tracking-wider">Daily Commit Tracker</h2>
                <a href="{{ route('daily-commit-tracker.index') }}" class="text-amber-400 hover:text-amber-300 text-xs transition-colors">Buka tracker →</a>
            </div>
            <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-amber-500/20 p-5">
                @if($recentCommit)
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center flex-shrink-0 text-white font-bold text-sm">
                            {{ $recentCommit->success_level ?? '-' }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 flex-wrap">
                                <h3 class="text-white font-semibold text-sm truncate">{{ $recentCommit->title }}</h3>
                                <span class="text-amber-400 text-xs flex-shrink-0">{{ $recentCommit->tracked_date->locale('id')->isoFormat('D MMM YYYY') }}</span>
                            </div>
                            @if($recentCommit->message)
                                <p class="text-purple-300 text-xs mt-1 line-clamp-2">{{ $recentCommit->message }}</p>
                            @endif
                        </div>
                        <a href="{{ route('daily-commit-tracker.show', $recentCommit->tracked_date->format('Y-m-d')) }}"
                           class="flex-shrink-0 text-xs text-amber-400 hover:text-amber-300 transition-colors">
                            Detail →
                        </a>
                    </div>
                    <div class="mt-4 pt-4 border-t border-white/5 flex items-center gap-6 text-xs text-purple-400">
                        <span>🔥 Streak: <span class="text-amber-300 font-semibold">{{ $commitStreak }} hari</span></span>
                        <span>📋 Total: <span class="text-white font-semibold">{{ $totalCommits }}</span></span>
                    </div>
                @else
                    <div class="text-center py-4">
                        <div class="text-3xl mb-2">🔥</div>
                        <p class="text-purple-300 text-sm mb-3">Belum ada commit hari ini. Yuk mulai!</p>
                        <a href="{{ route('daily-commit-tracker.index') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-500 rounded-xl text-white text-xs font-semibold hover:shadow-lg hover:shadow-amber-500/30 transition-all">
                            Catat Commit Hari Ini
                        </a>
                    </div>
                @endif
            </div>
        </div>

        {{-- ─── QUICK NAVIGATION ─── --}}
        <div class="animate-slideIn section-delay-4">
            <h2 class="text-purple-300 text-xs font-semibold uppercase tracking-wider mb-3">Jelajahi Fitur</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">

                {{-- LMS --}}
                <a href="{{ route('lms.index') }}" class="group card-delay-1 animate-slideIn bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-blue-400/40 p-4 hover:shadow-lg hover:shadow-blue-500/10 transition-all duration-200 hover:-translate-y-0.5">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <p class="text-white font-semibold text-sm">LMS</p>
                    <p class="text-purple-400 text-xs mt-0.5">Kursus & materi</p>
                </a>

                {{-- Daily Commit Tracker --}}
                <a href="{{ route('daily-commit-tracker.index') }}" class="group card-delay-2 animate-slideIn bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-amber-400/40 p-4 hover:shadow-lg hover:shadow-amber-500/10 transition-all duration-200 hover:-translate-y-0.5">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <p class="text-white font-semibold text-sm">Daily Commit</p>
                    <p class="text-purple-400 text-xs mt-0.5">Catat aktivitas</p>
                </a>

                {{-- RepoHub --}}
                <a href="{{ route('repohub.index') }}" class="group card-delay-3 animate-slideIn bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-emerald-400/40 p-4 hover:shadow-lg hover:shadow-emerald-500/10 transition-all duration-200 hover:-translate-y-0.5">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                        </svg>
                    </div>
                    <p class="text-white font-semibold text-sm">RepoHub</p>
                    <p class="text-purple-400 text-xs mt-0.5">Repo pilihan</p>
                </a>

                {{-- Keluarga Baricode --}}
                <a href="{{ route('family.index') }}" class="group card-delay-4 animate-slideIn bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-pink-400/40 p-4 hover:shadow-lg hover:shadow-pink-500/10 transition-all duration-200 hover:-translate-y-0.5">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-pink-500 to-rose-500 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <p class="text-white font-semibold text-sm">Keluarga</p>
                    <p class="text-purple-400 text-xs mt-0.5">{{ $totalMembers }} anggota</p>
                </a>

                {{-- Blog --}}
                <a href="https://blog.baricode.org" class="group card-delay-5 animate-slideIn bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-sky-400/40 p-4 hover:shadow-lg hover:shadow-sky-500/10 transition-all duration-200 hover:-translate-y-0.5">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-sky-500 to-blue-600 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <p class="text-white font-semibold text-sm">Blog</p>
                    <p class="text-purple-400 text-xs mt-0.5">Artikel & tips</p>
                </a>

                {{-- Meme --}}
                <a href="{{ route('meme.index') }}" class="group card-delay-6 animate-slideIn bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-yellow-400/40 p-4 hover:shadow-lg hover:shadow-yellow-500/10 transition-all duration-200 hover:-translate-y-0.5">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center mb-3 text-xl">
                        😂
                    </div>
                    <p class="text-white font-semibold text-sm">Meme</p>
                    <p class="text-purple-400 text-xs mt-0.5">Hiburan komunitas</p>
                </a>

                {{-- Timelines --}}
                <a href="{{ route('timeline.index') }}" class="group card-delay-7 animate-slideIn bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-violet-400/40 p-4 hover:shadow-lg hover:shadow-violet-500/10 transition-all duration-200 hover:-translate-y-0.5">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <p class="text-white font-semibold text-sm">Timeline</p>
                    <p class="text-purple-400 text-xs mt-0.5">Progress komunitas</p>
                </a>

                {{-- Cara Belajar --}}
                <a href="{{ route('how-to-learn') }}" class="group card-delay-8 animate-slideIn bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-indigo-400/40 p-4 hover:shadow-lg hover:shadow-indigo-500/10 transition-all duration-200 hover:-translate-y-0.5">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <p class="text-white font-semibold text-sm">Cara Belajar</p>
                    <p class="text-purple-400 text-xs mt-0.5">Panduan memulai</p>
                </a>

                {{-- Cheat Sheet --}}
                <a href="{{ route('cheatsheet.index') }}" class="group animate-slideIn bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-cyan-400/40 p-4 hover:shadow-lg hover:shadow-cyan-500/10 transition-all duration-200 hover:-translate-y-0.5">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-500 to-teal-500 flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <p class="text-white font-semibold text-sm">Cheat Sheet</p>
                    <p class="text-purple-400 text-xs mt-0.5">Referensi cepat</p>
                </a>

            </div>
        </div>

        {{-- ─── COMMUNITY SNAPSHOT ─── --}}
        <div class="animate-slideIn section-delay-4">
            <h2 class="text-purple-300 text-xs font-semibold uppercase tracking-wider mb-3">Komunitas Baricode</h2>
            <div class="bg-gradient-to-br from-purple-900/40 to-indigo-900/40 backdrop-blur-lg rounded-2xl border border-purple-500/20 p-6">
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="text-center">
                        <p class="text-white text-3xl font-extrabold">{{ $totalMembers }}</p>
                        <p class="text-purple-300 text-xs mt-1">Anggota Aktif</p>
                    </div>
                    <div class="text-center border-x border-purple-500/20">
                        <p class="text-white text-3xl font-extrabold">{{ $timelines['ongoing'] }}</p>
                        <p class="text-purple-300 text-xs mt-1">Proyek Berjalan</p>
                    </div>
                    <div class="text-center">
                        <p class="text-white text-3xl font-extrabold">{{ $timelines['completed'] }}</p>
                        <p class="text-purple-300 text-xs mt-1">Proyek Selesai</p>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('family.index') }}"
                       class="flex-1 text-center px-4 py-2.5 bg-white/10 hover:bg-white/15 border border-purple-400/20 hover:border-purple-400/40 rounded-xl text-purple-200 text-sm font-medium transition-all">
                        👥 Lihat Keluarga Baricode
                    </a>
                    <a href="{{ route('timeline.index') }}"
                       class="flex-1 text-center px-4 py-2.5 bg-white/10 hover:bg-white/15 border border-purple-400/20 hover:border-purple-400/40 rounded-xl text-purple-200 text-sm font-medium transition-all">
                        📅 Lihat Timeline
                    </a>
                </div>
            </div>
        </div>


    </div>
</x-layouts.dashboard>
