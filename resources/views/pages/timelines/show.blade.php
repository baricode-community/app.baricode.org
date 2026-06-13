<x-layouts.base title="{{ $timeline->title }}">
    <div class="">
        <a href="{{ route('timeline.index') }}"
            class="group inline-flex items-center text-purple-400 hover:text-white mb-8 font-medium transition-all duration-200">
            <i data-lucide="chevron-left" class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform"></i>
            Kembali ke Timeline
        </a>

        @php
            $statusColors = match ($timeline->status) {
                'pending' => [
                    'border' => 'border-l-yellow-500',
                    'badge' => 'bg-yellow-500/20 text-yellow-300 border-yellow-500/30',
                ],
                'ongoing' => [
                    'border' => 'border-l-blue-500',
                    'badge' => 'bg-blue-500/20 text-blue-300 border-blue-500/30',
                ],
                'completed' => [
                    'border' => 'border-l-green-500',
                    'badge' => 'bg-green-500/20 text-green-300 border-green-500/30',
                ],
                'cancelled' => [
                    'border' => 'border-l-red-500',
                    'badge' => 'bg-red-500/20 text-red-300 border-red-500/30',
                ],
                default => [
                    'border' => 'border-l-purple-500',
                    'badge' => 'bg-purple-500/20 text-purple-300 border-purple-500/30',
                ],
            };
        @endphp

        <article @class([
            'bg-white/5 backdrop-blur-xl rounded-2xl border border-purple-500/20 p-6 md:p-10 border-l-4 shadow-2xl shadow-purple-950/20',
            $statusColors['border'],
        ])>

            <header class="mb-10">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="space-y-3">
                        <h1
                            class="text-3xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white to-purple-200 leading-tight">
                            {{ $timeline->title }}
                        </h1>
                        <span @class([
                            'inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold border tracking-wide uppercase',
                            $statusColors['badge'],
                        ])>
                            <span class="w-2 h-2 rounded-full bg-current mr-2 animate-pulse"></span>
                            {{ $timeline->status_label }}
                        </span>
                    </div>
                </div>
            </header>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <div class="lg:col-span-2 space-y-10">

                    {{-- Description --}}
                    @if ($timeline->description)
                        <section>
                            <h2 class="text-sm font-bold text-purple-400 uppercase tracking-widest mb-4">Deskripsi
                                Project</h2>
                            <p class="text-purple-100 text-lg leading-relaxed antialiased">
                                {{ $timeline->description }}
                            </p>
                        </section>
                    @endif

                    {{-- Progress Section --}}
                    <section class="bg-purple-900/10 rounded-xl p-6 border border-purple-500/10">
                        <div class="flex justify-between items-end mb-4">
                            <h2 class="text-sm font-bold text-purple-400 uppercase tracking-widest">Progress Saat Ini
                            </h2>
                            <span class="text-3xl font-black text-white">{{ $timeline->progress }}<span
                                    class="text-purple-400 text-lg">%</span></span>
                        </div>
                        <div class="relative w-full bg-purple-900/40 rounded-full h-4 overflow-hidden shadow-inner">
                            <div class="absolute top-0 left-0 bg-gradient-to-r from-purple-600 via-indigo-500 to-blue-400 h-full rounded-full transition-all duration-1000 ease-out"
                                style="width: {{ $timeline->progress }}%">
                                <div
                                    class="w-full h-full opacity-30 bg-[linear-gradient(45deg,rgba(255,255,255,.15)_25%,transparent_25%,transparent_50%,rgba(255,255,255,.15)_50%,rgba(255,255,255,.15)_75%,transparent_75%,transparent)] bg-[length:1rem_1rem] animate-[stripe_1s_linear_infinite]">
                                </div>
                            </div>
                        </div>
                    </section>

                    {{-- Notes --}}
                    @if ($timeline->notes)
                        <section>
                            <h2 class="text-sm font-bold text-purple-400 uppercase tracking-widest mb-4">Catatan
                                Internal</h2>
                            <div
                                class="relative overflow-hidden bg-amber-500/5 border border-amber-500/20 p-6 rounded-xl group">
                                <div
                                    class="absolute top-0 right-0 p-2 opacity-10 group-hover:scale-110 transition-transform">
                                    <i data-lucide="pencil" class="w-12 h-12 text-amber-500"></i>
                                </div>
                                <p class="text-amber-200/90 whitespace-pre-line leading-relaxed italic">
                                    "{{ $timeline->notes }}"</p>
                            </div>
                        </section>
                    @endif

                    {{-- Progress Journals --}}
                    @if ($timeline->progressJournals->count() > 0)
                        <section>
                            <h2 class="text-sm font-bold text-purple-400 uppercase tracking-widest mb-6">Progress Journal</h2>
                            <div class="space-y-4">
                                @foreach ($timeline->progressJournals->sortByDesc('created_at') as $journal)
                                    <div class="bg-white/5 backdrop-blur-sm rounded-xl p-6 border border-indigo-500/20 hover:border-indigo-500/40 transition-all duration-300 group">
                                        <div class="flex justify-between items-start mb-3">
                                            <div class="flex-1">
                                                <p class="text-purple-100 leading-relaxed mb-3">
                                                    {{ $journal->description }}
                                                </p>
                                                @if ($journal->progress_percentage !== null)
                                                    <div class="flex items-center gap-2">
                                                        <span class="text-xs font-semibold text-indigo-300">Progress:</span>
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-indigo-500/30 text-indigo-200 border border-indigo-500/50">
                                                            {{ $journal->progress_percentage }}%
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <p class="text-[11px] text-purple-400/60">
                                            {{ $journal->created_at->translatedFormat('d F Y \p\u\k\u\l H:i') }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </div>

                <aside class="space-y-6">
                    <div class="bg-white/5 rounded-2xl p-6 border border-purple-500/10 space-y-6">
                        <h2 class="text-sm font-bold text-purple-400 uppercase tracking-widest">Timeline Detail</h2>

                        {{-- Dates --}}
                        <div class="space-y-4">
                            @if ($timeline->start_date)
                                <div>
                                    <label class="block text-xs text-purple-500 uppercase font-semibold mb-1">Dimulai
                                        Pada</label>
                                    <p class="text-white font-medium">
                                        {{ $timeline->start_date->translatedFormat('d F Y') }}</p>
                                    <p class="text-[10px] text-purple-400 mt-1 italic opacity-70">
                                        {{ $timeline->start_date->diffForHumans() }}
                                    </p>
                                </div>
                            @endif

                            @if ($timeline->end_date)
                                <div>
                                    <label class="block text-xs text-purple-500 uppercase font-semibold mb-1">Target
                                        Selesai</label>
                                    <p class="text-white font-medium">
                                        {{ $timeline->end_date->translatedFormat('d F Y') }}</p>
                                    <p @class([
                                        'text-[10px] mt-1 italic font-medium',
                                        'text-green-400' => $timeline->end_date > now(),
                                        'text-red-400' => $timeline->end_date <= now(),
                                    ])>
                                        {{ $timeline->end_date > now() ? 'Berakhir ' . $timeline->end_date->diffForHumans() : 'Tenggat Waktu Berakhir' }}
                                    </p>
                                </div>
                            @endif

                            @if ($timeline->start_date && $timeline->end_date)
                                <div class="pt-4 border-t border-purple-500/10">
                                    <div class="flex justify-between items-center text-xs">
                                        <span class="text-purple-500">Estimasi Durasi:</span>
                                        <span
                                            class="text-blue-300 font-bold">{{ $timeline->start_date->diffInDays($timeline->end_date) }}
                                            Hari</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Metadata --}}
                    <div class="px-6 py-4 text-[11px] text-purple-500/60 leading-tight space-y-2">
                        <p>Dibuat: {{ $timeline->created_at->translatedFormat('d/m/Y H:i') }}</p>
                        @if ($timeline->updated_at->ne($timeline->created_at))
                            <p>Update: {{ $timeline->updated_at->diffForHumans() }}</p>
                        @endif
                    </div>
                </aside>
            </div>
        </article>
    </div>


    <style>
        @keyframes stripe {
            from {
                background-position: 0 0;
            }

            to {
                background-position: 1rem 0;
            }
        }
    </style>
</x-layouts.base>
