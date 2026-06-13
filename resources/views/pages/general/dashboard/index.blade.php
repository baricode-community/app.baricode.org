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
                <i data-lucide="user" class="w-4 h-4"></i>
                Edit Profil
            </a>
        </div>

        {{-- ─── ONBOARDING CHECKLIST ─── --}}
        @if($onboardingTotal > 0)
        <div class="animate-slideIn section-delay-2">
            @if($onboardingCompleted >= $onboardingTotal)
                {{-- All done state --}}
                <div class="bg-gradient-to-br from-emerald-900/40 to-teal-900/40 backdrop-blur-lg rounded-2xl border border-emerald-500/30 p-5">
                    <div class="flex items-center justify-between flex-wrap gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center text-xl">
                                🎉
                            </div>
                            <div>
                                <h2 class="text-white font-bold text-sm">Semua Selesai!</h2>
                                <p class="text-emerald-300 text-xs">Kamu telah menyelesaikan semua langkah onboarding.</p>
                            </div>
                        </div>
                        <a href="{{ route('dashboard.onboarding.index') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-500/20 hover:bg-emerald-500/30 border border-emerald-500/30 hover:border-emerald-400/50 rounded-xl text-emerald-300 text-xs font-medium transition-all">
                            Lihat semua task →
                        </a>
                    </div>
                </div>
            @else
                {{-- In-progress state --}}
                <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 p-5">
                    <div class="flex items-center justify-between mb-4 flex-wrap gap-2">
                        <div>
                            <h2 class="text-white font-bold text-sm">Mulai Perjalananmu 🚀</h2>
                            <p class="text-purple-300 text-xs mt-0.5">
                                {{ $onboardingCompleted }} dari {{ $onboardingTotal }} langkah selesai
                            </p>
                        </div>
                        <span class="text-purple-400 text-xs">
                            {{ $onboardingTotal > 0 ? round(($onboardingCompleted / $onboardingTotal) * 100) : 0 }}%
                        </span>
                    </div>

                    {{-- Progress bar --}}
                    <div class="w-full bg-white/10 rounded-full h-1.5 mb-4">
                        <div class="bg-gradient-to-r from-purple-500 to-indigo-500 h-1.5 rounded-full transition-all duration-500"
                             style="width: {{ $onboardingTotal > 0 ? round(($onboardingCompleted / $onboardingTotal) * 100) : 0 }}%">
                        </div>
                    </div>

                    {{-- Task list --}}
                    <div class="space-y-2">
                        @foreach($onboardingTasks as $task)
                        <div class="flex items-center gap-3 group">
                            {{-- Toggle checkbox --}}
                            <form method="POST" action="{{ route('dashboard.onboarding.toggle', $task->slug) }}" class="flex-shrink-0">
                                @csrf
                                <button type="submit"
                                        class="w-5 h-5 rounded-full border-2 flex items-center justify-center transition-all duration-200 cursor-pointer
                                               {{ $task->is_completed
                                                    ? 'bg-emerald-500 border-emerald-500'
                                                    : 'border-purple-500/50 hover:border-purple-400 bg-transparent' }}">
                                    @if($task->is_completed)
                                        <i data-lucide="check" class="w-3 h-3 text-white"></i>
                                    @endif
                                </button>
                            </form>

                            {{-- Task link --}}
                            <a href="{{ route('dashboard.onboarding.show', $task->slug) }}"
                               class="flex-1 min-w-0 flex items-center gap-2 py-1">
                                @if($task->icon)
                                    <span class="text-base flex-shrink-0">{{ $task->icon }}</span>
                                @endif
                                <span class="text-sm transition-colors
                                             {{ $task->is_completed ? 'text-purple-400 line-through' : 'text-white group-hover:text-purple-300' }}">
                                    {{ $task->title }}
                                </span>
                            </a>

                            <a href="{{ route('dashboard.onboarding.show', $task->slug) }}"
                               class="flex-shrink-0 text-purple-500 hover:text-purple-300 transition-colors">
                                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        @endif

        {{-- ─── QUICK STATS ─── --}}
        <div class="animate-slideIn section-delay-2">
            <h2 class="text-purple-300 text-xs font-semibold uppercase tracking-wider mb-3">Statistik Kamu</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                {{-- Kursus Aktif --}}
                <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-blue-500/20 p-5 hover:border-blue-400/40 transition-all duration-200">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center mb-3">
                        <i data-lucide="book-open" class="w-5 h-5 text-white"></i>
                    </div>
                    <p class="text-white text-2xl font-bold">{{ $activeEnrollments->count() }}</p>
                    <p class="text-blue-300 text-xs mt-1">Kursus Aktif</p>
                </div>

                {{-- Kursus Selesai --}}
                <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-emerald-500/20 p-5 hover:border-emerald-400/40 transition-all duration-200">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center mb-3">
                        <i data-lucide="award" class="w-5 h-5 text-white"></i>
                    </div>
                    <p class="text-white text-2xl font-bold">{{ $completedEnrollments }}</p>
                    <p class="text-emerald-300 text-xs mt-1">Kursus Selesai</p>
                </div>

                {{-- Daily Commit Streak --}}
                <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-amber-500/20 p-5 hover:border-amber-400/40 transition-all duration-200">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center mb-3">
                        <i data-lucide="zap" class="w-5 h-5 text-white"></i>
                    </div>
                    <p class="text-white text-2xl font-bold">{{ $commitStreak }}<span class="text-sm font-normal text-amber-300 ml-1">hari</span></p>
                    <p class="text-amber-300 text-xs mt-1">Streak Harian</p>
                </div>

                {{-- Total Commits --}}
                <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-violet-500/20 p-5 hover:border-violet-400/40 transition-all duration-200">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center mb-3">
                        <i data-lucide="clipboard-list" class="w-5 h-5 text-white"></i>
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
                                    <i data-lucide="book-open" class="w-4 h-4 text-white"></i>
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
                                <i data-lucide="chevron-right" class="w-3 h-3"></i>
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
                        <i data-lucide="book-open" class="w-5 h-5 text-white"></i>
                    </div>
                    <p class="text-white font-semibold text-sm">LMS</p>
                    <p class="text-purple-400 text-xs mt-0.5">Kursus & materi</p>
                </a>

                {{-- Daily Commit Tracker --}}
                <a href="{{ route('daily-commit-tracker.index') }}" class="group card-delay-2 animate-slideIn bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-amber-400/40 p-4 hover:shadow-lg hover:shadow-amber-500/10 transition-all duration-200 hover:-translate-y-0.5">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-orange-500 flex items-center justify-center mb-3">
                        <i data-lucide="zap" class="w-5 h-5 text-white"></i>
                    </div>
                    <p class="text-white font-semibold text-sm">Daily Commit</p>
                    <p class="text-purple-400 text-xs mt-0.5">Catat aktivitas</p>
                </a>

                {{-- RepoHub --}}
                <a href="{{ route('repohub.index') }}" class="group card-delay-3 animate-slideIn bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-emerald-400/40 p-4 hover:shadow-lg hover:shadow-emerald-500/10 transition-all duration-200 hover:-translate-y-0.5">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center mb-3">
                        <i data-lucide="code" class="w-5 h-5 text-white"></i>
                    </div>
                    <p class="text-white font-semibold text-sm">RepoHub</p>
                    <p class="text-purple-400 text-xs mt-0.5">Repo pilihan</p>
                </a>

                {{-- Keluarga Baricode --}}
                <a href="{{ route('family.index') }}" class="group card-delay-4 animate-slideIn bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-pink-400/40 p-4 hover:shadow-lg hover:shadow-pink-500/10 transition-all duration-200 hover:-translate-y-0.5">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-pink-500 to-rose-500 flex items-center justify-center mb-3">
                        <i data-lucide="users" class="w-5 h-5 text-white"></i>
                    </div>
                    <p class="text-white font-semibold text-sm">Keluarga</p>
                    <p class="text-purple-400 text-xs mt-0.5">{{ $totalMembers }} anggota</p>
                </a>

                {{-- Blog --}}
                <a href="https://blog.baricode.org" class="group card-delay-5 animate-slideIn bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-sky-400/40 p-4 hover:shadow-lg hover:shadow-sky-500/10 transition-all duration-200 hover:-translate-y-0.5">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-sky-500 to-blue-600 flex items-center justify-center mb-3">
                        <i data-lucide="newspaper" class="w-5 h-5 text-white"></i>
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
                        <i data-lucide="bar-chart-2" class="w-5 h-5 text-white"></i>
                    </div>
                    <p class="text-white font-semibold text-sm">Timeline</p>
                    <p class="text-purple-400 text-xs mt-0.5">Progress komunitas</p>
                </a>

                {{-- Cara Belajar --}}
                <a href="{{ route('how-to-learn') }}" class="group card-delay-8 animate-slideIn bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-indigo-400/40 p-4 hover:shadow-lg hover:shadow-indigo-500/10 transition-all duration-200 hover:-translate-y-0.5">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center mb-3">
                        <i data-lucide="lightbulb" class="w-5 h-5 text-white"></i>
                    </div>
                    <p class="text-white font-semibold text-sm">Cara Belajar</p>
                    <p class="text-purple-400 text-xs mt-0.5">Panduan memulai</p>
                </a>

                {{-- Cheat Sheet --}}
                <a href="{{ route('cheatsheet.index') }}" class="group animate-slideIn bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-cyan-400/40 p-4 hover:shadow-lg hover:shadow-cyan-500/10 transition-all duration-200 hover:-translate-y-0.5">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-500 to-teal-500 flex items-center justify-center mb-3">
                        <i data-lucide="file-text" class="w-5 h-5 text-white"></i>
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
