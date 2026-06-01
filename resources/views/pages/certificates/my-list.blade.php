<x-layouts.dashboard :title="__('Sertifikat Saya')">
    <div class="max-w-3xl mx-auto px-4 py-6 md:px-8 space-y-6">

        {{-- Header --}}
        <div class="flex items-center gap-4 pb-6 border-b border-purple-700/50">
            <a href="{{ route('dashboard') }}"
               class="text-purple-400 hover:text-purple-300 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h1 class="text-white text-xl font-bold">Sertifikat Saya</h1>
                <p class="text-purple-300 text-sm">Semua sertifikat yang kamu miliki</p>
            </div>
        </div>

        {{-- Stats --}}
        <div class="bg-white/5 rounded-2xl border border-purple-500/20 p-4 flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center flex-shrink-0">
                <span class="text-lg">🏆</span>
            </div>
            <div>
                <p class="text-white font-bold text-lg">{{ $certificates->count() }}</p>
                <p class="text-purple-400 text-xs">Total sertifikat diraih</p>
            </div>
        </div>

        {{-- Certificate list --}}
        <div class="space-y-3">
            @forelse($certificates as $cert)
                @php
                    $colorMap = [
                        'purple' => ['bg' => 'from-purple-500 to-violet-500', 'border' => 'border-purple-500/30', 'badge' => 'bg-purple-500/20 text-purple-300'],
                        'indigo' => ['bg' => 'from-indigo-500 to-blue-500',  'border' => 'border-indigo-500/30', 'badge' => 'bg-indigo-500/20 text-indigo-300'],
                        'blue'   => ['bg' => 'from-blue-500 to-cyan-500',    'border' => 'border-blue-500/30',   'badge' => 'bg-blue-500/20 text-blue-300'],
                        'green'  => ['bg' => 'from-emerald-500 to-teal-500', 'border' => 'border-emerald-500/30','badge' => 'bg-emerald-500/20 text-emerald-300'],
                        'yellow' => ['bg' => 'from-yellow-400 to-orange-400','border' => 'border-yellow-500/30', 'badge' => 'bg-yellow-500/20 text-yellow-300'],
                        'orange' => ['bg' => 'from-orange-500 to-red-400',   'border' => 'border-orange-500/30', 'badge' => 'bg-orange-500/20 text-orange-300'],
                        'red'    => ['bg' => 'from-red-500 to-pink-500',     'border' => 'border-red-500/30',    'badge' => 'bg-red-500/20 text-red-300'],
                        'pink'   => ['bg' => 'from-pink-500 to-rose-500',    'border' => 'border-pink-500/30',   'badge' => 'bg-pink-500/20 text-pink-300'],
                        'gray'   => ['bg' => 'from-gray-400 to-slate-500',   'border' => 'border-gray-500/30',   'badge' => 'bg-gray-500/20 text-gray-300'],
                    ];
                    $colors = $colorMap[$cert->badge_color] ?? $colorMap['purple'];
                @endphp
                <a href="{{ route('certificate.show', $cert->slug) }}"
                   class="flex items-center gap-4 bg-white/5 backdrop-blur-lg rounded-2xl border {{ $colors['border'] }}
                          p-4 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg group">

                    {{-- Icon --}}
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0
                                bg-gradient-to-br {{ $colors['bg'] }}">
                        @if($cert->icon)
                            <span class="text-2xl">{{ $cert->icon }}</span>
                        @else
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-sm text-white group-hover:text-purple-300 transition-colors truncate">
                            {{ $cert->title }}
                        </p>
                        @if($cert->description)
                            <p class="text-purple-400 text-xs mt-0.5 truncate">{{ $cert->description }}</p>
                        @endif
                        <p class="text-purple-500 text-xs mt-1">
                            Diterbitkan {{ \Carbon\Carbon::parse($cert->pivot->issued_at)->translatedFormat('d F Y') }}
                        </p>
                    </div>

                    <svg class="w-4 h-4 text-purple-500 group-hover:text-purple-300 flex-shrink-0 transition-colors"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @empty
                <div class="text-center py-16">
                    <div class="text-5xl mb-4">🎓</div>
                    <p class="text-purple-300 font-semibold">Belum ada sertifikat</p>
                    <p class="text-purple-500 text-sm mt-1">Ikuti program dan kegiatan untuk mendapatkan sertifikat</p>
                </div>
            @endforelse
        </div>

    </div>
</x-layouts.dashboard>
