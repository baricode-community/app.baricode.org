<x-layouts.dashboard :title="__('Daily Commit Tracker - ' . $trackedDate)">
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
                <h1 class="text-white text-2xl font-bold">
                    📅 {{ \Carbon\Carbon::parse($trackedDate)->locale('id')->isoFormat('D MMMM YYYY') }}
                </h1>
                <p class="text-purple-300 text-sm mt-1">
                    @if(\Carbon\Carbon::parse($trackedDate)->isToday())
                        Catatan untuk hari ini
                    @else
                        Lihat catatan untuk tanggal tersebut
                    @endif
                </p>
            </div>
            <a href="{{ route('daily-commit-tracker.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 hover:bg-white/10 border border-purple-500/20 hover:border-purple-400/40 rounded-xl text-purple-200 text-sm transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Tracker
            </a>
        </div>

        @if ($tracker)
            {{-- ─── EXISTING TRACKER ─── --}}
            <div class="animate-slideIn section-delay-2 grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Main Content --}}
                <div class="lg:col-span-2">
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-amber-500/20 overflow-hidden">
                        <div class="bg-gradient-to-r from-amber-500/20 to-orange-500/20 border-b border-amber-500/20 px-6 py-5 flex items-center justify-between">
                            <div>
                                <h2 class="text-white font-bold text-lg">{{ $tracker->title }}</h2>
                                <p class="text-amber-300 text-sm mt-1">
                                    @if(\Carbon\Carbon::parse($trackedDate)->isToday())
                                        ✏️ Edit catatan harimu
                                    @else
                                        📖 Lihat catatan tanggal {{ \Carbon\Carbon::parse($trackedDate)->format('d M Y') }}
                                    @endif
                                </p>
                            </div>
                            <div class="text-4xl font-extrabold text-white/70">{{ $tracker->success_level }}<span class="text-lg font-normal text-amber-400">/10</span></div>
                        </div>

                        <div class="p-6">
                            @if(\Carbon\Carbon::parse($trackedDate)->isToday())
                                @livewire('daily-commit-tracker-form', ['tracker' => $tracker, 'trackedDate' => $trackedDate])
                            @else
                                {{-- Read-only View --}}
                                <div class="space-y-5">
                                    <div>
                                        <label class="block text-purple-400 text-xs font-semibold uppercase tracking-wider mb-2">Judul Catatan</label>
                                        <div class="w-full px-4 py-3 bg-white/5 border border-purple-500/20 rounded-xl text-white text-sm">
                                            {{ $tracker->title }}
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-purple-400 text-xs font-semibold uppercase tracking-wider mb-2">Catatan / Pesan</label>
                                        <div class="w-full px-4 py-3 bg-white/5 border border-purple-500/20 rounded-xl text-purple-200 text-sm whitespace-pre-wrap">
                                            {{ $tracker->message }}
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-purple-400 text-xs font-semibold uppercase tracking-wider mb-2">Kesan Pribadi</label>
                                        <div class="w-full px-4 py-3 bg-white/5 border border-purple-500/20 rounded-xl text-purple-200 text-sm whitespace-pre-wrap">
                                            {{ $tracker->impression }}
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-purple-400 text-xs font-semibold uppercase tracking-wider mb-2">Level Keberhasilan</label>
                                        <div class="flex items-center gap-4">
                                            <div class="flex-1 h-2 bg-gradient-to-r from-red-500 via-yellow-500 to-green-500 rounded-full"></div>
                                            <span class="text-white text-xl font-bold">{{ $tracker->success_level }}<span class="text-sm font-normal text-amber-400">/10</span></span>
                                        </div>
                                    </div>

                                    <div class="bg-indigo-900/30 rounded-xl p-4 border border-indigo-500/30">
                                        <p class="text-indigo-300 text-sm">
                                            <strong>ℹ️ Info:</strong> Catatan ini dari tanggal {{ \Carbon\Carbon::parse($trackedDate)->format('d F Y') }} dan hanya bisa dilihat dalam mode read-only.
                                        </p>
                                    </div>

                                    <a href="{{ route('daily-commit-tracker.index') }}"
                                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 rounded-xl text-white text-sm font-semibold hover:shadow-lg hover:shadow-amber-500/30 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                        </svg>
                                        Kembali ke Tracker
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="space-y-5">

                    {{-- Info Card --}}
                    <div class="animate-slideIn section-delay-2 bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 p-5">
                        <h3 class="text-purple-300 text-xs font-semibold uppercase tracking-wider mb-4">📝 Informasi</h3>
                        <div class="space-y-3">
                            <div class="border-l-2 border-amber-500 pl-3 py-1">
                                <p class="text-purple-400 text-xs">Dibuat</p>
                                <p class="text-white text-sm font-semibold">{{ $tracker->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            <div class="border-l-2 border-orange-500 pl-3 py-1">
                                <p class="text-purple-400 text-xs">Diperbarui</p>
                                <p class="text-white text-sm font-semibold">{{ $tracker->updated_at->format('d M Y, H:i') }}</p>
                            </div>
                            <div class="border-l-2 border-yellow-500 pl-3 py-1">
                                <p class="text-purple-400 text-xs">ID</p>
                                <p class="text-white text-sm font-semibold font-mono">{{ $tracker->id }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Success Level Card --}}
                    <div class="animate-slideIn section-delay-2 bg-gradient-to-br from-emerald-900/40 to-teal-900/40 backdrop-blur-lg rounded-2xl border border-emerald-500/30 p-5">
                        <h3 class="text-emerald-300 text-xs font-semibold uppercase tracking-wider mb-4">⭐ Level Keberhasilan</h3>
                        <div class="flex items-center gap-4">
                            <div class="text-4xl font-extrabold text-white">{{ $tracker->success_level }}</div>
                            <div>
                                <p class="text-emerald-200 text-sm font-semibold">
                                    @if($tracker->success_level <= 3)
                                        Perlu Perbaikan
                                    @elseif($tracker->success_level <= 5)
                                        Cukup Baik
                                    @elseif($tracker->success_level <= 7)
                                        Baik
                                    @elseif($tracker->success_level <= 9)
                                        Sangat Baik
                                    @else
                                        Sempurna!
                                    @endif
                                </p>
                                <p class="text-emerald-400 text-xs mt-0.5">dari 10 poin</p>
                            </div>
                        </div>
                    </div>

                    {{-- Navigation --}}
                    <div class="animate-slideIn section-delay-3 bg-white/5 backdrop-blur-lg rounded-2xl border border-purple-500/20 p-5">
                        <h3 class="text-purple-300 text-xs font-semibold uppercase tracking-wider mb-4">🔗 Navigasi</h3>
                        <div class="space-y-3">
                            <a href="{{ route('daily-commit-tracker.history') }}"
                               class="flex items-center gap-2 text-amber-400 hover:text-amber-300 text-sm font-medium transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Lihat History
                            </a>
                            <a href="{{ route('daily-commit-tracker.index') }}"
                               class="flex items-center gap-2 text-purple-400 hover:text-purple-300 text-sm font-medium transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Buat Catatan Baru
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        @else
            {{-- ─── EMPTY STATE ─── --}}
            <div class="animate-slideIn section-delay-2">
                @if(\Carbon\Carbon::parse($trackedDate)->isToday())
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2">
                            <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-amber-500/20 overflow-hidden">
                                <div class="bg-gradient-to-r from-amber-500/20 to-orange-500/20 border-b border-amber-500/20 px-6 py-5">
                                    <h2 class="text-white font-bold text-lg">📋 Catat Progress Harimu</h2>
                                </div>
                                <div class="p-6">
                                    @livewire('daily-commit-tracker-form')
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-indigo-900/40 to-purple-900/40 backdrop-blur-lg rounded-2xl border border-indigo-500/30 p-5 h-fit">
                            <p class="text-purple-300 text-xs font-semibold uppercase tracking-wider mb-3">💡 Jangan lupa catat</p>
                            <ul class="space-y-2 text-sm text-purple-300">
                                <li class="flex items-start gap-2"><span class="text-emerald-400">✓</span> Apa yang kamu pelajari</li>
                                <li class="flex items-start gap-2"><span class="text-emerald-400">✓</span> Fitur yang berhasil dibuat</li>
                                <li class="flex items-start gap-2"><span class="text-emerald-400">✓</span> Masalah yang dipecahkan</li>
                                <li class="flex items-start gap-2"><span class="text-emerald-400">✓</span> Rating honest 1-10</li>
                            </ul>
                        </div>
                    </div>
                @else
                    <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-dashed border-purple-500/30 p-12 text-center max-w-2xl mx-auto">
                        <div class="text-5xl mb-4">📋</div>
                        <h3 class="text-white text-xl font-bold mb-2">Belum Ada Catatan</h3>
                        <p class="text-purple-300 text-sm mb-6">
                            Tidak ada catatan untuk tanggal <strong class="text-white">{{ \Carbon\Carbon::parse($trackedDate)->format('d F Y') }}</strong>.
                            Kembali ke halaman utama untuk membuat catatan.
                        </p>
                        <a href="{{ route('daily-commit-tracker.index') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 rounded-xl text-white text-sm font-semibold hover:shadow-lg hover:shadow-amber-500/30 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Kembali ke Tracker
                        </a>
                    </div>
                @endif
            </div>
        @endif

    </div>
</x-layouts.dashboard>
