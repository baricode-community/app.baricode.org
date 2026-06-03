<x-layouts.base :title="'Academy Saya'">
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-4xl mx-auto">

            <div class="mb-10">
                <h1 class="text-3xl font-extrabold text-white mb-1">Academy Saya</h1>
                <p class="text-gray-400">Program yang kamu ikuti di Baricode Academy.</p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-900/50 border border-green-700 rounded-xl text-green-300">
                    {{ session('success') }}
                </div>
            @endif

            @if($enrollments->isEmpty())
                <div class="text-center py-16 text-gray-400 bg-gray-800/30 rounded-2xl">
                    <p class="text-lg mb-4">Kamu belum terdaftar di program manapun.</p>
                    <a href="{{ route('academy.index') }}"
                        class="px-6 py-2.5 bg-amber-600 hover:bg-amber-500 rounded-xl font-semibold text-sm transition-colors">
                        Lihat Program
                    </a>
                </div>
            @else
                <div class="space-y-6">
                    @foreach($enrollments as $enrollment)
                        <div class="bg-gray-800/50 border border-gray-700 rounded-2xl overflow-hidden">
                            <div class="p-6 border-b border-gray-700">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <h2 class="text-xl font-bold text-white">{{ $enrollment->batch->program->title }}</h2>
                                        <p class="text-gray-400 text-sm">{{ $enrollment->batch->name }}</p>
                                        <p class="text-gray-500 text-xs mt-1">
                                            Terdaftar {{ $enrollment->enrolled_at->diffForHumans() }}
                                        </p>
                                    </div>
                                    <a href="{{ route('academy.batch', $enrollment->batch->uuid) }}"
                                        class="shrink-0 px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-xl text-sm font-medium transition-colors">
                                        Lihat Batch
                                    </a>
                                </div>
                            </div>

                            @if($enrollment->batch->sessions->isNotEmpty())
                                <div class="p-6">
                                    <p class="text-sm font-semibold text-gray-400 mb-3">Jadwal Sesi</p>
                                    <div class="space-y-2">
                                        @foreach($enrollment->batch->sessions->take(3) as $index => $session)
                                            <div class="flex items-center justify-between gap-3 text-sm">
                                                <div class="flex items-center gap-2">
                                                    <span class="w-6 h-6 bg-amber-900/60 text-amber-400 rounded-full flex items-center justify-center text-xs font-bold">
                                                        {{ $index + 1 }}
                                                    </span>
                                                    <div>
                                                        <span class="text-white">{{ $session->title }}</span>
                                                        <span class="text-gray-500 ml-2">
                                                            {{ $session->scheduled_at->translatedFormat('d M · H:i') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="flex gap-2">
                                                    @if($session->meeting_link)
                                                        <a href="{{ $session->meeting_link }}" target="_blank"
                                                            class="px-2.5 py-1 bg-blue-700 hover:bg-blue-600 rounded-lg text-xs transition-colors">
                                                            Join
                                                        </a>
                                                    @endif
                                                    @if($session->youtube_link)
                                                        <a href="{{ $session->youtube_link }}" target="_blank"
                                                            class="px-2.5 py-1 bg-red-700 hover:bg-red-600 rounded-lg text-xs transition-colors">
                                                            YT
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                        @if($enrollment->batch->sessions->count() > 3)
                                            <p class="text-xs text-gray-500 mt-2">
                                                +{{ $enrollment->batch->sessions->count() - 3 }} sesi lainnya
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layouts.base>
