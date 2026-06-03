<x-layouts.base :title="$batch->name . ' — ' . $batch->program->title">
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-4xl mx-auto">

            <div class="mb-4">
                <a href="{{ route('academy.show', $batch->program->uuid) }}" class="text-gray-500 hover:text-gray-300 text-sm">
                    ← Kembali ke {{ $batch->program->title }}
                </a>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-900/50 border border-green-700 rounded-xl text-green-300">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('info'))
                <div class="mb-6 p-4 bg-blue-900/50 border border-blue-700 rounded-xl text-blue-300">
                    {{ session('info') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 p-4 bg-red-900/50 border border-red-700 rounded-xl text-red-300">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid md:grid-cols-3 gap-6">
                <div class="md:col-span-2">
                    <h1 class="text-3xl font-extrabold text-white mb-1">{{ $batch->name }}</h1>
                    <p class="text-gray-400 mb-6">{{ $batch->program->title }}</p>

                    <h2 class="text-lg font-bold text-white mb-4">Jadwal Sesi</h2>

                    @if($batch->sessions->isEmpty())
                        <div class="text-gray-400 bg-gray-800/30 rounded-xl p-6 text-center">
                            Jadwal sesi belum ditetapkan.
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach($batch->sessions as $index => $session)
                                <div class="bg-gray-800/50 border border-gray-700 rounded-xl p-4">
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="flex gap-3">
                                            <span class="w-8 h-8 bg-amber-900/60 text-amber-400 rounded-full flex items-center justify-center text-sm font-bold shrink-0">
                                                {{ $index + 1 }}
                                            </span>
                                            <div>
                                                <p class="font-semibold text-white">{{ $session->title }}</p>
                                                <p class="text-sm text-gray-400">
                                                    {{ $session->scheduled_at->translatedFormat('l, d M Y · H:i') }} WIB
                                                </p>
                                                @if($session->description)
                                                    <p class="text-sm text-gray-500 mt-1">{{ $session->description }}</p>
                                                @endif
                                            </div>
                                        </div>

                                        @if($enrollment)
                                            <div class="flex gap-2 shrink-0">
                                                @if($session->meeting_link)
                                                    <a href="{{ $session->meeting_link }}" target="_blank"
                                                        class="px-3 py-1.5 bg-blue-700 hover:bg-blue-600 rounded-lg text-xs font-medium transition-colors">
                                                        Join Meeting
                                                    </a>
                                                @endif
                                                @if($session->youtube_link)
                                                    <a href="{{ $session->youtube_link }}" target="_blank"
                                                        class="px-3 py-1.5 bg-red-700 hover:bg-red-600 rounded-lg text-xs font-medium transition-colors">
                                                        Rekaman
                                                    </a>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-xs text-gray-600 shrink-0">🔒 Daftar untuk akses</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="md:col-span-1">
                    <div class="bg-gray-800/60 border border-gray-700 rounded-2xl p-6 sticky top-6">
                        <p class="text-3xl font-extrabold text-amber-400 mb-4">{{ $batch->formattedPrice() }}</p>

                        <div class="space-y-2 text-sm text-gray-400 mb-6">
                            <div class="flex justify-between">
                                <span>Peserta</span>
                                <span class="text-white">{{ $batch->enrolledCount() }}/{{ $batch->quota }}</span>
                            </div>
                            @if($batch->start_at)
                                <div class="flex justify-between">
                                    <span>Mulai</span>
                                    <span class="text-white">{{ $batch->start_at->translatedFormat('d M Y') }}</span>
                                </div>
                            @endif
                            @if($batch->end_at)
                                <div class="flex justify-between">
                                    <span>Selesai</span>
                                    <span class="text-white">{{ $batch->end_at->translatedFormat('d M Y') }}</span>
                                </div>
                            @endif
                            <div class="flex justify-between">
                                <span>Sesi</span>
                                <span class="text-white">{{ $batch->sessions->count() }} pertemuan</span>
                            </div>
                        </div>

                        @if($enrollment)
                            <div class="w-full py-3 bg-green-800/50 border border-green-700 rounded-xl text-center text-green-400 font-semibold text-sm">
                                ✓ Kamu sudah terdaftar
                            </div>
                        @elseif($batch->isRegistrationOpen())
                            @auth
                                <form action="{{ route('academy.order.create', $batch->uuid) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full py-3 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-400 hover:to-orange-400 rounded-xl font-bold text-sm transition-all shadow-lg shadow-amber-500/20">
                                        Daftar Sekarang
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}"
                                    class="block w-full py-3 bg-gray-700 hover:bg-gray-600 rounded-xl font-semibold text-sm text-center transition-colors">
                                    Login untuk Daftar
                                </a>
                            @endauth
                        @else
                            <div class="w-full py-3 bg-gray-700/50 border border-gray-600 rounded-xl text-center text-gray-400 font-semibold text-sm">
                                Pendaftaran Ditutup
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.base>
