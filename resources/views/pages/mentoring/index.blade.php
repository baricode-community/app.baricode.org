<x-layouts.base :title="'Program Bimbingan'">
    <div class="min-h-screen py-12 px-4">
        <div class="max-w-4xl mx-auto">

            <div class="mb-12">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-3 bg-gradient-to-r from-purple-400 via-violet-400 to-indigo-400 bg-clip-text text-transparent">
                    Bimbingan Langsung
                </h1>
                <p class="text-gray-300 text-lg">
                    Belajar lebih intensif dengan bimbingan personal dari mentor.
                </p>
            </div>

            @if($programs->isEmpty())
                <div class="text-center py-16 text-gray-400">
                    <p class="text-lg">Belum ada program bimbingan yang tersedia saat ini.</p>
                </div>
            @else
                <div class="grid gap-6">
                    @foreach($programs as $program)
                        <div class="bg-gray-800/50 border border-gray-700 rounded-2xl p-6">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1">
                                    <h2 class="text-xl font-bold text-white mb-2">{{ $program->title }}</h2>

                                    @if($program->description)
                                        <p class="text-gray-300 mb-3">{{ $program->description }}</p>
                                    @endif

                                    @if($program->goals)
                                        <div class="text-sm text-gray-400">
                                            <span class="font-semibold text-indigo-400">Target:</span>
                                            {{ $program->goals }}
                                        </div>
                                    @endif
                                </div>

                                @auth
                                    <form action="{{ route('mentoring.apply') }}" method="POST" class="shrink-0">
                                        @csrf
                                        <input type="hidden" name="mentoring_program_id" value="{{ $program->id }}">
                                        <button type="submit"
                                            class="px-5 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-lg font-semibold text-sm hover:shadow-lg hover:shadow-purple-500/40 transition-all">
                                            Daftar
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="shrink-0 px-5 py-2 bg-gray-700 rounded-lg font-semibold text-sm text-gray-300 hover:bg-gray-600 transition-all">
                                        Login untuk daftar
                                    </a>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @auth
                <div class="mt-8 text-center">
                    <a href="{{ route('mentoring.dashboard') }}"
                        class="text-indigo-400 hover:text-indigo-300 text-sm transition-colors">
                        Lihat status bimbinganmu →
                    </a>
                </div>
            @endauth

            @if(session('error'))
                <div class="mt-4 p-4 bg-red-900/40 border border-red-700 rounded-lg text-red-300 text-sm">
                    {{ session('error') }}
                </div>
            @endif

        </div>
    </div>
</x-layouts.base>
