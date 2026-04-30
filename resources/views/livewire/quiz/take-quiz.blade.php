<div class="space-y-6">

    {{-- Score Result --}}
    @if ($submitted)
        <div class="text-center py-16 space-y-6">
            <div class="w-24 h-24 bg-green-500/20 rounded-full flex items-center justify-center mx-auto border border-green-500/40">
                <svg class="w-12 h-12 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <div>
                <h2 class="text-2xl font-bold text-white">Quiz Selesai!</h2>
                <p class="text-purple-300 mt-1">Kamu telah menyelesaikan <strong class="text-white">{{ $quiz->title }}</strong></p>
            </div>

            <div class="bg-gradient-to-br from-green-700/30 to-emerald-700/30 border border-green-500/30 rounded-2xl p-10 inline-block">
                <p class="text-sm uppercase tracking-widest text-green-300 mb-2">Total Skor</p>
                <p class="text-6xl font-extrabold text-white">{{ $totalScore }}</p>
                <p class="text-sm text-green-300 mt-2">poin</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 justify-center pt-2">
                <button
                    wire:click="retakeQuiz"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white/10 hover:bg-white/20 border border-purple-500/30 text-white font-semibold rounded-lg transition"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Ulangi Quiz
                </button>
                <a href="{{ route('lms.quiz.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg transition">
                    Quiz Lainnya →
                </a>
            </div>
        </div>

    {{-- Preview All Answers --}}
    @elseif ($showPreview)
        <div class="space-y-5">

            {{-- Header --}}
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-white">Preview Jawaban</h3>
                    <p class="text-xs text-purple-400 mt-0.5">Periksa jawabanmu sebelum submit</p>
                </div>
                <button
                    wire:click="closePreview"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 hover:bg-white/10 border border-purple-500/30 text-purple-300 hover:text-white text-sm font-medium rounded-lg transition"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali Edit
                </button>
            </div>

            {{-- Summary bar --}}
            @php
                $answeredCount = collect($answers)->filter(fn ($a) => !empty($a))->count();
                $totalCount = $quiz->questions->count();
                $unansweredCount = $totalCount - $answeredCount;
            @endphp
            <div class="flex gap-3 flex-wrap">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-500/15 border border-blue-500/30 text-blue-300 text-sm rounded-lg">
                    <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                    {{ $answeredCount }} terjawab
                </span>
                @if ($unansweredCount > 0)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-500/15 border border-red-500/30 text-red-300 text-sm rounded-lg">
                        <span class="w-2 h-2 rounded-full bg-red-400"></span>
                        {{ $unansweredCount }} belum dijawab
                    </span>
                @endif
            </div>

            {{-- All questions --}}
            @foreach ($quiz->questions->values() as $i => $question)
                @php
                    $isAnswered = !empty($answers[$question->id]);
                    $selectedIds = array_map('strval', $answers[$question->id] ?? []);
                @endphp
                <div class="bg-white/5 backdrop-blur-lg border rounded-xl p-5 space-y-3 {{ $isAnswered ? 'border-blue-500/30' : 'border-red-500/30' }}">
                    <div class="flex items-start gap-3">
                        <span class="flex-shrink-0 w-8 h-8 text-sm font-bold rounded-full flex items-center justify-center border {{ $isAnswered ? 'bg-blue-500/20 border-blue-500/40 text-blue-300' : 'bg-red-500/20 border-red-500/40 text-red-300' }}">
                            {{ $i + 1 }}
                        </span>
                        <div class="flex-1 pt-1">
                            <p class="font-semibold text-white">{{ $question->question_text }}</p>
                            @if (!$isAnswered)
                                <p class="text-xs text-red-400 mt-1 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    Belum dijawab — klik nomor soal untuk kembali mengisi
                                </p>
                            @endif
                        </div>
                        <button
                            wire:click="goToQuestion({{ $i }})"
                            class="flex-shrink-0 text-xs px-2.5 py-1 bg-white/5 hover:bg-white/10 border border-purple-500/20 text-purple-400 hover:text-purple-200 rounded-md transition"
                        >
                            Edit
                        </button>
                    </div>

                    <div class="ml-11 space-y-2">
                        @foreach ($question->options as $option)
                            @php $isSelected = in_array((string) $option->id, $selectedIds); @endphp
                            <div class="flex items-center gap-3 p-3 rounded-lg border {{ $isSelected ? 'border-green-500/50 bg-green-500/10' : 'border-purple-500/10 bg-white/2' }}">
                                <div class="w-4 h-4 rounded flex-shrink-0 flex items-center justify-center {{ $isSelected ? 'bg-green-500 border border-green-400' : 'border border-purple-500/30' }}">
                                    @if ($isSelected)
                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                        </svg>
                                    @endif
                                </div>
                                <span class="{{ $isSelected ? 'text-green-200 font-medium' : 'text-purple-300/60' }}">{{ $option->option_text }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            {{-- Submit section --}}
            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button
                    wire:click="closePreview"
                    class="flex-1 py-3 bg-white/5 hover:bg-white/10 border border-purple-500/30 text-purple-300 hover:text-white font-semibold rounded-xl transition"
                >
                    ← Kembali Edit Jawaban
                </button>
                <button
                    wire:click="submitQuiz"
                    wire:loading.attr="disabled"
                    class="flex-1 py-3 bg-green-500 hover:bg-green-600 text-white font-bold rounded-xl transition shadow-lg hover:shadow-green-500/30 disabled:opacity-60 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                >
                    <span wire:loading.remove wire:target="submitQuiz" class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Submit Quiz
                    </span>
                    <span wire:loading wire:target="submitQuiz" class="flex items-center gap-2">
                        <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                        Mengirim...
                    </span>
                </button>
            </div>

        </div>

    {{-- Quiz Form — one question at a time --}}
    @else
        @php
            $questions = $quiz->questions->values();
            $totalQuestions = $questions->count();
            $currentQuestion = $questions->get($currentIndex);
        @endphp

        {{-- Navigation Box --}}
        <div class="bg-white/5 backdrop-blur-lg border border-purple-500/20 rounded-xl p-4 space-y-2">
            <p class="text-xs text-purple-400 font-medium uppercase tracking-wide">Navigasi Soal</p>
            <div class="flex flex-wrap gap-2">
                @foreach ($questions as $i => $q)
                    @php $qAnswered = !empty($answers[$q->id]); @endphp
                    <button
                        wire:click="goToQuestion({{ $i }})"
                        class="w-9 h-9 rounded-lg text-sm font-bold border transition-all
                            @if ($i === $currentIndex)
                                bg-purple-500 border-purple-400 text-white ring-2 ring-purple-400/40 shadow-lg shadow-purple-500/20
                            @elseif ($qAnswered)
                                bg-blue-500/20 border-blue-500/40 text-blue-300 hover:bg-blue-500/30
                            @else
                                bg-red-500/10 border-red-500/30 text-red-400 hover:bg-red-500/20
                            @endif
                        "
                        title="Soal {{ $i + 1 }}{{ $qAnswered ? ' (terjawab)' : ' (belum dijawab)' }}"
                    >
                        {{ $i + 1 }}
                    </button>
                @endforeach
            </div>
            <div class="flex gap-4 pt-1">
                <span class="inline-flex items-center gap-1.5 text-xs text-red-400">
                    <span class="w-2.5 h-2.5 rounded-sm bg-red-500/30 border border-red-500/40"></span>
                    Belum dijawab
                </span>
                <span class="inline-flex items-center gap-1.5 text-xs text-blue-300">
                    <span class="w-2.5 h-2.5 rounded-sm bg-blue-500/30 border border-blue-500/40"></span>
                    Sudah dijawab
                </span>
            </div>
        </div>

        {{-- Current Question --}}
        @if ($currentQuestion)
            <div class="bg-white/5 backdrop-blur-lg border border-purple-500/20 rounded-xl p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs text-purple-400 font-medium">
                        Soal {{ $currentIndex + 1 }} dari {{ $totalQuestions }}
                    </span>
                    <span class="text-xs text-purple-500">Boleh pilih lebih dari satu jawaban</span>
                </div>

                <div class="flex items-start gap-3">
                    <span class="flex-shrink-0 w-8 h-8 bg-purple-500/30 text-purple-300 text-sm font-bold rounded-full flex items-center justify-center border border-purple-500/40">
                        {{ $currentIndex + 1 }}
                    </span>
                    <p class="font-semibold text-white pt-1">{{ $currentQuestion->question_text }}</p>
                </div>

                <div class="ml-11 space-y-2">
                    @foreach ($currentQuestion->options as $option)
                        <label class="flex items-center gap-3 p-3 rounded-lg border border-purple-500/20 hover:border-green-500/40 hover:bg-green-500/5 cursor-pointer transition-all has-[:checked]:border-green-500/60 has-[:checked]:bg-green-500/10">
                            <input
                                type="checkbox"
                                wire:model="answers.{{ $currentQuestion->id }}"
                                value="{{ $option->id }}"
                                class="w-4 h-4 rounded border-purple-500/40 bg-white/5 text-green-500 focus:ring-green-500/30"
                            />
                            <span class="text-purple-100">{{ $option->option_text }}</span>
                        </label>
                    @endforeach
                </div>

                @error("answers.{$currentQuestion->id}")
                    <p class="ml-11 text-sm text-red-400 flex items-center gap-1 mt-1">
                        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>
        @endif

        {{-- Navigation Controls --}}
        <div class="flex items-center gap-3">

            {{-- Previous --}}
            <button
                wire:click="previousQuestion"
                @disabled($currentIndex === 0)
                class="inline-flex items-center gap-2 px-4 py-3 border font-semibold rounded-xl transition
                    {{ $currentIndex === 0
                        ? 'border-purple-500/10 text-purple-600 cursor-not-allowed opacity-40'
                        : 'bg-white/5 hover:bg-white/10 border-purple-500/30 text-purple-300 hover:text-white' }}"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Sebelumnya
            </button>

            <div class="flex-1 flex justify-end gap-3">

                {{-- Preview --}}
                <button
                    wire:click="openPreview"
                    class="inline-flex items-center gap-2 px-4 py-3 bg-white/5 hover:bg-white/10 border border-purple-500/30 text-purple-300 hover:text-white font-semibold rounded-xl transition"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Preview
                </button>

                {{-- Next or Submit --}}
                @if ($currentIndex < $totalQuestions - 1)
                    <button
                        wire:click="nextQuestion"
                        class="inline-flex items-center gap-2 px-5 py-3 bg-purple-600 hover:bg-purple-500 text-white font-semibold rounded-xl transition shadow-lg hover:shadow-purple-500/20"
                    >
                        Selanjutnya
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                @else
                    <button
                        wire:click="submitQuiz"
                        wire:loading.attr="disabled"
                        class="inline-flex items-center gap-2 px-5 py-3 bg-green-500 hover:bg-green-600 text-white font-bold rounded-xl transition shadow-lg hover:shadow-green-500/30 disabled:opacity-60 disabled:cursor-not-allowed"
                    >
                        <span wire:loading.remove wire:target="submitQuiz" class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Submit Quiz
                        </span>
                        <span wire:loading wire:target="submitQuiz" class="flex items-center gap-2">
                            <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            Mengirim...
                        </span>
                    </button>
                @endif

            </div>
        </div>

    @endif

</div>
