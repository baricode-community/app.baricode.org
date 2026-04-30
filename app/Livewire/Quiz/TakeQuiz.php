<?php

namespace App\Livewire\Quiz;

use App\Enums\Quiz\QuizAttemptStatus;
use App\Models\Quiz\Option;
use App\Models\Quiz\Quiz;
use App\Models\Quiz\QuizAttempt;
use Livewire\Component;

class TakeQuiz extends Component
{
    public Quiz $quiz;

    /** @var array<int, list<int>> question_id => [option_id, ...] */
    public array $answers = [];

    public int $currentIndex = 0;

    public bool $showPreview = false;

    public ?int $totalScore = null;

    public bool $submitted = false;

    public function mount(): void
    {
        $this->answers = $this->quiz->questions
            ->mapWithKeys(fn ($q) => [$q->id => []])
            ->toArray();
    }

    public function nextQuestion(): void
    {
        if ($this->currentIndex < $this->quiz->questions->count() - 1) {
            $this->currentIndex++;
        }
    }

    public function previousQuestion(): void
    {
        if ($this->currentIndex > 0) {
            $this->currentIndex--;
        }
    }

    public function goToQuestion(int $index): void
    {
        if ($index >= 0 && $index < $this->quiz->questions->count()) {
            $this->currentIndex = $index;
            $this->showPreview = false;
        }
    }

    public function openPreview(): void
    {
        $this->showPreview = true;
    }

    public function closePreview(): void
    {
        $this->showPreview = false;
    }

    public function submitQuiz(): void
    {
        $this->validate($this->buildValidationRules(), $this->buildValidationMessages());

        $selectedOptionIds = collect($this->answers)->flatten()->map(fn ($id) => (int) $id);

        $this->totalScore = Option::whereIn('id', $selectedOptionIds)->sum('score');

        $answersForStorage = collect($this->answers)
            ->mapWithKeys(fn ($options, $qId) => [(string) $qId => collect($options)->map(fn ($id) => (string) $id)->toArray()])
            ->toArray();

        if (auth()->check()) {
            QuizAttempt::create([
                'user_id' => auth()->id(),
                'quiz_id' => $this->quiz->id,
                'status' => QuizAttemptStatus::Passed,
                'score' => $this->totalScore,
                'answers' => $answersForStorage,
                'completed_at' => now(),
            ]);
        }

        $this->submitted = true;
        $this->showPreview = false;
    }

    public function retakeQuiz(): void
    {
        $this->answers = $this->quiz->questions
            ->mapWithKeys(fn ($q) => [$q->id => []])
            ->toArray();
        $this->currentIndex = 0;
        $this->totalScore = null;
        $this->submitted = false;
        $this->showPreview = false;
    }

    private function buildValidationRules(): array
    {
        $rules = [];

        foreach ($this->quiz->questions as $question) {
            $rules["answers.{$question->id}"] = ['required', 'array', 'min:1'];
            $rules["answers.{$question->id}.*"] = ['integer', 'exists:options,id'];
        }

        return $rules;
    }

    private function buildValidationMessages(): array
    {
        $messages = [];

        foreach ($this->quiz->questions as $question) {
            $label = "\"{$question->question_text}\"";
            $messages["answers.{$question->id}.required"] = "Pertanyaan {$label} wajib dijawab.";
            $messages["answers.{$question->id}.array"] = "Jawaban untuk pertanyaan {$label} tidak valid.";
            $messages["answers.{$question->id}.min"] = "Pilih minimal satu jawaban untuk pertanyaan {$label}.";
        }

        return $messages;
    }

    public function render()
    {
        return view('livewire.quiz.take-quiz', [
            'quiz' => $this->quiz->load('questions.options'),
        ]);
    }
}
