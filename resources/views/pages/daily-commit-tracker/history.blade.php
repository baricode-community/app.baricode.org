<x-layouts.dashboard :title="__('Daily Commit Tracker History')">
    <style>
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-slideIn { animation: slideIn 0.5s ease-out forwards; }
        .section-delay-1 { animation-delay: 0.05s; }
        .section-delay-2 { animation-delay: 0.1s; }

        .success-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            font-weight: bold;
            color: white;
            flex-shrink: 0;
        }
        .success-badge-1  { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); }
        .success-badge-2  { background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); }
        .success-badge-3  { background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); }
        .success-badge-4  { background: linear-gradient(135deg, #eab308 0%, #ca8a04 100%); }
        .success-badge-5  { background: linear-gradient(135deg, #eab308 0%, #ca8a04 100%); }
        .success-badge-6  { background: linear-gradient(135deg, #84cc16 0%, #65a30d 100%); }
        .success-badge-7  { background: linear-gradient(135deg, #84cc16 0%, #65a30d 100%); }
        .success-badge-8  { background: linear-gradient(135deg, #22c55e 0%, #15803d 100%); }
        .success-badge-9  { background: linear-gradient(135deg, #22c55e 0%, #15803d 100%); }
        .success-badge-10 { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
    </style>

    <div class="max-w-6xl mx-auto px-4 py-6 md:px-8 space-y-8">

        {{-- ─── HEADER ─── --}}
        <div class="animate-slideIn section-delay-1 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-purple-700/50">
            <div>
                <h1 class="text-white text-2xl font-bold">📚 History Commits</h1>
                <p class="text-purple-300 text-sm mt-1">Lihat seluruh catatan commit harianmu dan pantau perkembangan</p>
            </div>
            <a href="{{ route('daily-commit-tracker.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 hover:bg-white/10 border border-purple-500/20 hover:border-purple-400/40 rounded-xl text-purple-200 text-sm transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Catat Hari Ini
            </a>
        </div>

        {{-- ─── HISTORY LIST ─── --}}
        <div class="animate-slideIn section-delay-2">
            @if ($trackers->count() > 0)
                <div class="space-y-4">
                    @foreach ($trackers as $tracker)
                        <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 hover:border-amber-400/30 transition-all duration-200 overflow-hidden">
                            <div class="flex flex-col md:flex-row gap-5 p-6">

                                {{-- Success Level Badge --}}
                                <div class="flex flex-col items-center justify-center md:border-r md:border-white/10 md:pr-6 gap-1">
                                    <div class="success-badge success-badge-{{ $tracker->success_level }}">
                                        {{ $tracker->success_level }}
                                    </div>
                                    <p class="text-purple-400 text-xs text-center">Level</p>
                                </div>

                                {{-- Content --}}
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-3 mb-3">
                                        <div>
                                            <h3 class="text-white font-bold text-lg leading-snug">{{ $tracker->title }}</h3>
                                            <p class="text-purple-400 text-xs mt-1 flex items-center gap-2">
                                                <span>📅 {{ $tracker->tracked_date->format('d M Y') }}</span>
                                                <span class="px-2 py-0.5 bg-amber-500/20 text-amber-300 border border-amber-500/30 rounded-full text-xs">
                                                    {{ $tracker->tracked_date->format('l') }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>

                                    <p class="text-purple-200 text-sm leading-relaxed mb-3">{{ $tracker->message }}</p>

                                    <div class="bg-indigo-900/30 rounded-xl p-3 border-l-2 border-indigo-400/50 mb-3">
                                        <p class="text-xs font-semibold text-indigo-300 mb-1">💭 Kesan Pribadi:</p>
                                        <p class="text-indigo-200 text-sm">{{ $tracker->impression }}</p>
                                    </div>

                                    <div class="flex items-center justify-between text-xs text-purple-500">
                                        <span>{{ $tracker->created_at->format('H:i') }} &mdash; {{ $tracker->created_at->diffForHumans() }}</span>
                                        @if (now()->toDateString() === $tracker->tracked_date->toDateString())
                                            <a href="{{ route('daily-commit-tracker.show', $tracker->tracked_date->toDateString()) }}"
                                               class="inline-flex items-center gap-1 text-amber-400 hover:text-amber-300 font-semibold transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Lihat / Edit
                                            </a>
                                        @else
                                            <a href="{{ route('daily-commit-tracker.show', $tracker->tracked_date->toDateString()) }}"
                                               class="inline-flex items-center gap-1 text-purple-400 hover:text-purple-300 font-semibold transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                Lihat
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Pagination --}}
                    <div class="mt-6 flex justify-center">
                        {{ $trackers->links('pagination::tailwind') }}
                    </div>
                </div>
            @else
                <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-dashed border-purple-500/30 p-12 text-center">
                    <div class="text-5xl mb-4">📋</div>
                    <h3 class="text-white text-xl font-bold mb-2">Belum Ada Catatan</h3>
                    <p class="text-purple-300 text-sm mb-6">Mulai buat catatan harian commit-mu sekarang untuk memantau progress belajarmu!</p>
                    <a href="{{ route('daily-commit-tracker.index') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 rounded-xl text-white text-sm font-semibold hover:shadow-lg hover:shadow-amber-500/30 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Buat Catatan Pertama
                    </a>
                </div>
            @endif
        </div>

    </div>
</x-layouts.dashboard>
