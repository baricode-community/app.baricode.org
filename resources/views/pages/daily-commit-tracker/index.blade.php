<x-layouts.dashboard :title="__('Daily Commit Tracker')">
    <style>
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-slideIn { animation: slideIn 0.5s ease-out forwards; }
        .section-delay-1 { animation-delay: 0.05s; }
        .section-delay-2 { animation-delay: 0.1s; }
        .section-delay-3 { animation-delay: 0.15s; }
    </style>

    <div class="max-w-6xl mx-auto px-4 py-6 md:px-8 space-y-8">

        {{-- ─── HEADER ─── --}}
        <div class="animate-slideIn section-delay-1 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 border-b border-purple-700/50">
            <div>
                <h1 class="text-white text-2xl font-bold">📝 Daily Commit Tracker</h1>
                <p class="text-purple-300 text-sm mt-1">Pantau progress belajarmu setiap hari dan bangun kebiasaan coding yang konsisten</p>
            </div>
            <a href="{{ route('daily-commit-tracker.history') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 hover:bg-white/10 border border-amber-500/20 hover:border-amber-400/40 rounded-xl text-amber-300 text-sm transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Lihat History
            </a>
        </div>

        {{-- ─── MAIN GRID ─── --}}
        <div class="animate-slideIn section-delay-2 grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Form Section --}}
            <div class="lg:col-span-2">
                <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-amber-500/20 overflow-hidden">
                    <div class="bg-gradient-to-r from-amber-500/20 to-orange-500/20 border-b border-amber-500/20 px-6 py-5">
                        <h2 class="text-white text-lg font-bold">📋 Catat Progress Harimu</h2>
                        <p class="text-amber-300 text-sm mt-1">Isi catatan pribadi dengan detail tentang progress belajarmu hari ini</p>
                    </div>
                    <div class="p-6">
                        @livewire('daily-commit-tracker-form')
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-5">

                {{-- Stats Card --}}
                <div class="animate-slideIn section-delay-2 bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 p-5">
                    <h3 class="text-purple-300 text-xs font-semibold uppercase tracking-wider mb-4">📊 Statistik Anda</h3>
                    <div class="space-y-3">
                        <div class="border-l-2 border-amber-500 pl-4 py-1">
                            <p class="text-purple-400 text-xs">Total Commits</p>
                            <p class="text-white text-xl font-bold">0</p>
                        </div>
                        <div class="border-l-2 border-orange-500 pl-4 py-1">
                            <p class="text-purple-400 text-xs">Minggu Ini</p>
                            <p class="text-white text-xl font-bold">0</p>
                        </div>
                        <div class="border-l-2 border-yellow-500 pl-4 py-1">
                            <p class="text-purple-400 text-xs">Rata-rata Level</p>
                            <p class="text-white text-xl font-bold">0/10</p>
                        </div>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div class="animate-slideIn section-delay-2 bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 p-5">
                    <h3 class="text-purple-300 text-xs font-semibold uppercase tracking-wider mb-4">🔗 Tautan Cepat</h3>
                    <div class="space-y-3">
                        <a href="{{ route('daily-commit-tracker.history') }}"
                           class="flex items-center gap-2 text-amber-400 hover:text-amber-300 text-sm font-medium transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Lihat History
                        </a>
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center gap-2 text-purple-400 hover:text-purple-300 text-sm font-medium transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>

                {{-- Tips Card --}}
                <div class="animate-slideIn section-delay-3 bg-gradient-to-br from-indigo-900/40 to-purple-900/40 backdrop-blur-lg rounded-2xl border border-indigo-500/30 p-5">
                    <h3 class="text-purple-300 text-xs font-semibold uppercase tracking-wider mb-4">💡 Tips</h3>
                    <ul class="space-y-2 text-sm text-purple-300">
                        <li class="flex items-start gap-2">
                            <span class="text-emerald-400 flex-shrink-0">✓</span>
                            <span>Catat poin penting dari apa yang kamu pelajari</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-emerald-400 flex-shrink-0">✓</span>
                            <span>Berikan rating jujur untuk progress harimu</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-emerald-400 flex-shrink-0">✓</span>
                            <span>Catat kesan dan pembelajaran berharga</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-emerald-400 flex-shrink-0">✓</span>
                            <span>Bisa diedit sebelum hari berganti</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</x-layouts.dashboard>
