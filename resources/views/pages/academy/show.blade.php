<x-layouts.base :title="$program->title . ' — Baricode Academy'">
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-4xl mx-auto">

            <div class="mb-4">
                <a href="{{ route('academy.index') }}" class="text-gray-500 hover:text-gray-300 text-sm">
                    ← Kembali ke Academy
                </a>
            </div>

            @if($program->thumbnail)
                <div class="h-56 rounded-2xl overflow-hidden mb-8">
                    <img src="{{ $program->thumbnail }}" alt="{{ $program->title }}" class="w-full h-full object-cover">
                </div>
            @endif

            <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-3">{{ $program->title }}</h1>

            @if($program->description)
                <p class="text-gray-300 text-lg mb-10">{{ $program->description }}</p>
            @endif

            <h2 class="text-xl font-bold text-white mb-4">Batch Tersedia</h2>

            @if($program->batches->isEmpty())
                <div class="text-center py-12 text-gray-400 bg-gray-800/30 rounded-2xl">
                    <p>Belum ada batch yang dibuka saat ini.</p>
                </div>
            @else
                <div class="grid gap-4">
                    @foreach($program->batches as $batch)
                        @php $enrolled = in_array($batch->id, $userEnrollments); @endphp
                        <div class="bg-gray-800/50 border {{ $enrolled ? 'border-green-600' : 'border-gray-700' }} rounded-2xl p-6">
                            <div class="flex items-start justify-between gap-4 flex-wrap">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h3 class="text-lg font-bold text-white">{{ $batch->name }}</h3>
                                        @if($enrolled)
                                            <span class="px-2 py-0.5 bg-green-900/60 text-green-400 text-xs rounded-full font-medium">Terdaftar</span>
                                        @elseif(!$batch->isRegistrationOpen())
                                            <span class="px-2 py-0.5 bg-gray-700 text-gray-400 text-xs rounded-full font-medium">Penuh / Tutup</span>
                                        @endif
                                    </div>
                                    <p class="text-2xl font-extrabold text-amber-400 mb-3">{{ $batch->formattedPrice() }}</p>

                                    <div class="grid grid-cols-2 gap-2 text-sm text-gray-400">
                                        <div>
                                            <span class="text-gray-500">Kuota:</span>
                                            {{ $batch->enrolledCount() }}/{{ $batch->quota }} peserta
                                        </div>
                                        @if($batch->start_at)
                                            <div>
                                                <span class="text-gray-500">Mulai:</span>
                                                {{ $batch->start_at->translatedFormat('d M Y') }}
                                            </div>
                                        @endif
                                        @if($batch->registration_close_at)
                                            <div>
                                                <span class="text-gray-500">Pendaftaran tutup:</span>
                                                {{ $batch->registration_close_at->translatedFormat('d M Y') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="shrink-0">
                                    <a href="{{ route('academy.batch', $batch->uuid) }}"
                                        class="px-5 py-2 bg-amber-600 hover:bg-amber-500 rounded-xl font-semibold text-sm transition-colors block text-center">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layouts.base>
