<x-layouts.base :title="'Bimbinganku'">
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-4xl mx-auto">

            <div class="mb-10 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-extrabold text-white mb-1">Bimbinganku</h1>
                    <p class="text-gray-400">Pantau progress bimbingan langsung kamu di sini.</p>
                </div>
                <a href="{{ route('mentoring.index') }}"
                    class="px-4 py-2 bg-gray-700 rounded-lg text-sm text-gray-300 hover:bg-gray-600 transition-all">
                    + Daftar Program
                </a>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-900/40 border border-green-700 rounded-lg text-green-300 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if($enrollments->isEmpty())
                <div class="text-center py-16 text-gray-400">
                    <p class="text-lg mb-4">Kamu belum terdaftar di program bimbingan apapun.</p>
                    <a href="{{ route('mentoring.index') }}"
                        class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg font-semibold text-sm">
                        Lihat Program
                    </a>
                </div>
            @else
                <div class="grid gap-4">
                    @foreach($enrollments as $enrollment)
                        <a href="{{ route('mentoring.show', $enrollment->uuid) }}"
                            class="block bg-gray-800/50 border border-gray-700 rounded-2xl p-5 hover:border-indigo-500/50 transition-all">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <div class="text-white font-semibold text-lg mb-1">
                                        {{ $enrollment->program->title }}
                                    </div>
                                    <div class="text-sm text-gray-400">
                                        {{ $enrollment->sessions_count }} sesi &middot;
                                        @if($enrollment->started_at)
                                            Mulai {{ $enrollment->started_at->format('d M Y') }}
                                        @else
                                            Belum mulai
                                        @endif
                                    </div>
                                </div>
                                <span class="shrink-0 px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $enrollment->status->color() === 'success' ? 'bg-green-900/50 text-green-300' : '' }}
                                    {{ $enrollment->status->color() === 'warning' ? 'bg-yellow-900/50 text-yellow-300' : '' }}
                                    {{ $enrollment->status->color() === 'info' ? 'bg-blue-900/50 text-blue-300' : '' }}
                                    {{ $enrollment->status->color() === 'gray' ? 'bg-gray-700 text-gray-300' : '' }}">
                                    {{ $enrollment->status->label() }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-layouts.base>
