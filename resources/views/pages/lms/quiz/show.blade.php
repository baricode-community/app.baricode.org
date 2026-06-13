<x-layouts.dashboard :title="$quiz->title">
    <div class="p-3">

        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-purple-400 mb-8">
            <a href="{{ route('lms.quiz.index') }}" class="hover:text-green-400 transition">Quiz</a>
            <i data-lucide="chevron-right" class="w-4 h-4"></i>
            <span class="text-white">{{ $quiz->title }}</span>
        </nav>

        <!-- Quiz Header -->
        <div class="bg-gradient-to-r from-purple-700/30 via-indigo-700/30 to-green-700/30 rounded-xl border border-purple-500/30 backdrop-blur-lg p-6 mb-8">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-white mb-2">{{ $quiz->title }}</h1>
                    @if ($quiz->description)
                        <p class="text-purple-200 text-sm">{{ $quiz->description }}</p>
                    @endif
                </div>
                <div class="flex-shrink-0 text-center bg-white/10 rounded-lg p-3 border border-purple-500/20">
                    <div class="text-2xl font-bold text-green-400">{{ $quiz->questions->count() }}</div>
                    <div class="text-xs text-purple-300">Soal</div>
                </div>
            </div>
        </div>

        <!-- Livewire Quiz Component -->
        <livewire:quiz.take-quiz :quiz="$quiz" />

    </div>
</x-layouts.dashboard>
