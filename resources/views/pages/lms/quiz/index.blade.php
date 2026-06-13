<x-layouts.dashboard :title="__('Uji Kemampuanmu Sekarang')">
    <div class="max-w-7xl mx-auto px-4 py-12">

        <!-- Hero Section -->
        <div class="mb-12">
            <div class="bg-gradient-to-r from-purple-700/30 via-indigo-700/30 to-green-700/30 rounded-lg border border-purple-500/30 backdrop-blur-lg p-8 md:p-12">
                <div class="text-center">
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Uji Kemampuanmu Sekarang!</h1>
                    <p class="text-lg text-purple-200 mb-8 max-w-2xl mx-auto">
                        Tantang dirimu dengan berbagai quiz interaktif untuk mengasah pengetahuanmu dan tingkatkan kemampuan programmu.
                    </p>
                    <a href="#all-quizzes"
                        class="inline-block bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-8 rounded-lg transition shadow-lg hover:shadow-green-500/50">
                        Lihat Semua Quiz →
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-12">
            <div class="bg-white/5 backdrop-blur-lg border border-purple-500/20 rounded-lg p-6 text-center">
                <div class="text-3xl font-bold text-green-400 mb-2">{{ $quizzes->count() }}</div>
                <p class="text-purple-300 text-sm">Quiz Tersedia</p>
            </div>
            <div class="bg-white/5 backdrop-blur-lg border border-purple-500/20 rounded-lg p-6 text-center">
                <div class="text-3xl font-bold text-purple-400 mb-2">{{ $quizzes->sum('questions_count') }}</div>
                <p class="text-purple-300 text-sm">Total Pertanyaan</p>
            </div>
            <div class="bg-white/5 backdrop-blur-lg border border-purple-500/20 rounded-lg p-6 text-center">
                <div class="text-3xl font-bold text-emerald-400 mb-2">Free</div>
                <p class="text-purple-300 text-sm">Semua Gratis</p>
            </div>
        </div>

        <!-- All Quizzes Section -->
        <div id="all-quizzes">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-3xl font-bold text-white mb-2">📋 Semua Quiz</h2>
                    <p class="text-purple-300">Pilih quiz sesuai dengan kebutuhanmu</p>
                </div>
            </div>

            @if ($quizzes->isEmpty())
                <div class="text-center py-20">
                    <i data-lucide="clipboard" class="w-16 h-16 mx-auto text-purple-700 mb-4"></i>
                    <h3 class="text-xl font-semibold text-white mb-2">Belum ada quiz tersedia</h3>
                    <p class="text-purple-400">Quiz akan segera ditambahkan. Pantau terus!</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($quizzes as $quiz)
                        <a href="{{ route('lms.quiz.show', $quiz) }}"
                            class="bg-white/5 backdrop-blur-lg border border-purple-500/20 hover:border-green-500/50 rounded-lg p-6 transition hover:shadow-lg hover:shadow-green-500/20 flex items-center justify-between group">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-lg font-semibold text-white group-hover:text-green-400 transition">
                                        {{ $quiz->title }}
                                    </h3>
                                </div>
                                @if ($quiz->description)
                                    <p class="text-purple-300 text-sm mb-3">{{ Str::limit($quiz->description, 100) }}</p>
                                @endif
                                <div class="flex items-center gap-6 text-xs text-purple-400">
                                    <span class="flex items-center gap-1">
                                        📝 {{ $quiz->questions_count }} Soal
                                    </span>
                                </div>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <i data-lucide="chevron-right" class="w-6 h-6 text-purple-500 group-hover:text-green-400 transition"></i>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</x-layouts.dashboard>
