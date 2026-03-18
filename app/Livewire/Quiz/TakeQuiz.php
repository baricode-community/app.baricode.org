<?php

namespace App\Livewire\Quiz;

use App\Models\Quiz\Option;
use App\Models\Quiz\Quiz;
use App\Models\Quiz\QuizResult;
use Livewire\Component;

class TakeQuiz extends Component
{
    public Quiz $quiz;

    /** @var array<int, list<int>> question_id => [option_id, ...] */
    public array $answers = [];

    public ?int $totalScore = null;

    public bool $submitted = false;

    public function mount(): void
    {
        // Pre-initialize each question key as an empty array so Livewire
        // treats every checkbox group as array mode, not scalar/boolean mode.
        $this->answers = $this->quiz->questions
            ->mapWithKeys(fn ($q) => [$q->id => []])
            ->toArray();
    }

    public function submitQuiz(): void
    {
        $this->validate($this->buildValidationRules(), $this->buildValidationMessages());

        $selectedOptionIds = collect($this->answers)->flatten()->map(fn ($id) => (int) $id);

        $this->totalScore = Option::whereIn('id', $selectedOptionIds)->sum('score');

        // Convert option IDs to strings for consistent JSON storage
        $answersForStorage = collect($this->answers)
            ->mapWithKeys(fn ($options, $qId) => [(string) $qId => collect($options)->map(fn ($id) => (string) $id)->toArray()])
            ->toArray();

        QuizResult::create([
            'total_score' => $this->totalScore,
            'answers' => $answersForStorage,
        ]);

        $this->submitted = true;
    }

    public function retakeQuiz(): void
    {
        $this->answers = $this->quiz->questions
            ->mapWithKeys(fn ($q) => [$q->id => []])
            ->toArray();
        $this->totalScore = null;
        $this->submitted = false;
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
