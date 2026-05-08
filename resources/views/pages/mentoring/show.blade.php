<x-layouts.base :title="$enrollment->program->title">
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-3xl mx-auto">

            <div class="mb-2">
                <a href="{{ route('mentoring.dashboard') }}"
                    class="text-sm text-gray-400 hover:text-gray-300 transition-colors">
                    ← Kembali ke Bimbinganku
                </a>
            </div>

            {{-- Header --}}
            <div class="mb-8 mt-4">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-extrabold text-white mb-2">
                            {{ $enrollment->program->title }}
                        </h1>
                        @if($enrollment->goal_notes)
                            <p class="text-gray-300 text-sm">{{ $enrollment->goal_notes }}</p>
                        @endif
                    </div>
                    <span class="shrink-0 px-3 py-1 rounded-full text-xs font-semibold mt-1
                        {{ $enrollment->status->color() === 'success' ? 'bg-green-900/50 text-green-300' : '' }}
                        {{ $enrollment->status->color() === 'warning' ? 'bg-yellow-900/50 text-yellow-300' : '' }}
                        {{ $enrollment->status->color() === 'info' ? 'bg-blue-900/50 text-blue-300' : '' }}
                        {{ $enrollment->status->color() === 'gray' ? 'bg-gray-700 text-gray-300' : '' }}">
                        {{ $enrollment->status->label() }}
                    </span>
                </div>

                @if($enrollment->started_at)
                    <p class="text-gray-500 text-sm mt-2">
                        Mulai {{ $enrollment->started_at->format('d M Y') }}
                        &middot; {{ $enrollment->sessions->count() }} sesi
                    </p>
                @endif
            </div>

            {{-- Sessions --}}
            @if($enrollment->sessions->isEmpty())
                <div class="text-center py-16 text-gray-500">
                    <p>Belum ada sesi yang tercatat. Tunggu konfirmasi dari mentor.</p>
                </div>
            @else
                <div class="relative">
                    {{-- Timeline line --}}
                    <div class="absolute left-4 top-0 bottom-0 w-px bg-gray-700"></div>

                    <div class="space-y-6">
                        @foreach($enrollment->sessions as $index => $session)
                            <div class="relative pl-12">
                                {{-- Dot --}}
                                <div class="absolute left-2.5 top-1.5 w-3 h-3 rounded-full bg-indigo-500 ring-4 ring-gray-900"></div>

                                <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-5">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-xs text-gray-400 font-medium">
                                            Sesi #{{ $index + 1 }} &middot; {{ $session->session_date->format('d M Y') }}
                                        </span>
                                    </div>

                                    <h3 class="text-white font-semibold text-base mb-3">{{ $session->topic }}</h3>

                                    @if($session->notes)
                                        <div class="mb-3">
                                            <div class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">Catatan</div>
                                            <p class="text-gray-300 text-sm whitespace-pre-line">{{ $session->notes }}</p>
                                        </div>
                                    @endif

                                    @if($session->tasks)
                                        <div class="mb-3 p-3 bg-indigo-900/20 border border-indigo-700/30 rounded-xl">
                                            <div class="text-xs text-indigo-400 font-semibold uppercase tracking-wider mb-1">Tugas</div>
                                            <p class="text-gray-300 text-sm whitespace-pre-line">{{ $session->tasks }}</p>
                                        </div>
                                    @endif

                                    @if($session->next_session_date)
                                        <div class="text-xs text-gray-500 mt-2">
                                            Sesi berikutnya: {{ $session->next_session_date->format('d M Y') }}
                                            @if($session->next_session_plan)
                                                &mdash; {{ $session->next_session_plan }}
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-layouts.base>
