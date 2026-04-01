<?php

namespace App\Services;

use App\Models\Quiz\Option;
use App\Models\Quiz\Question;
use App\Models\Quiz\Quiz;
use Exception;
use Illuminate\Support\Facades\DB;

class QuizImportExportService
{
    /**
     * Import one or multiple quizzes from JSON data.
     *
     * @param  array<string, mixed>|list<array<string, mixed>>  $data
     * @return list<Quiz>
     *
     * @throws Exception
     */
    public function importQuizzes(array $data): array
    {
        // Support both single quiz object and array of quizzes
        $quizzes = isset($data[0]) && is_array($data[0]) ? $data : [$data];

        return DB::transaction(function () use ($quizzes) {
            $imported = [];

            foreach ($quizzes as $index => $quizData) {
                $imported[] = $this->importQuiz($quizData, $index + 1);
            }

            return $imported;
        });
    }

    /**
     * Import a single quiz from array data.
     *
     * @param  array<string, mixed>  $data
     *
     * @throws Exception
     */
    private function importQuiz(array $data, int $position = 1): Quiz
    {
        if (empty($data['title'])) {
            throw new Exception("Quiz #{$position}: title is required.");
        }

        if (empty($data['questions']) || ! is_array($data['questions'])) {
            throw new Exception("Quiz #{$position} \"{$data['title']}\": must have at least one question.");
        }

        $quiz = Quiz::create([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'is_active' => $data['is_active'] ?? false,
        ]);

        foreach ($data['questions'] as $qIndex => $questionData) {
            $this->importQuestion($quiz, $questionData, $qIndex + 1);
        }

        return $quiz->load('questions.options');
    }

    /**
     * Import a question and its options into the given quiz.
     *
     * @param  array<string, mixed>  $questionData
     *
     * @throws Exception
     */
    private function importQuestion(Quiz $quiz, array $questionData, int $position): Question
    {
        if (empty($questionData['question_text'])) {
            throw new Exception("Question #{$position} in quiz \"{$quiz->title}\": question_text is required.");
        }

        if (empty($questionData['options']) || ! is_array($questionData['options']) || count($questionData['options']) < 2) {
            throw new Exception("Question #{$position} \"{$questionData['question_text']}\": must have at least 2 options.");
        }

        $question = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => $questionData['question_text'],
            'order' => $questionData['order'] ?? $position,
        ]);

        foreach ($questionData['options'] as $optData) {
            Option::create([
                'question_id' => $question->id,
                'option_text' => $optData['option_text'] ?? '',
                'score' => $optData['score'] ?? 0,
                'is_correct' => $optData['is_correct'] ?? false,
            ]);
        }

        return $question;
    }

    /**
     * Export a quiz to an array suitable for JSON encoding.
     *
     * @return array<string, mixed>
     */
    public function exportQuiz(Quiz $quiz): array
    {
        return [
            'title' => $quiz->title,
            'description' => $quiz->description,
            'is_active' => $quiz->is_active,
            'questions' => $quiz->questions->map(fn (Question $q) => [
                'question_text' => $q->question_text,
                'order' => $q->order,
                'options' => $q->options->map(fn (Option $o) => [
                    'option_text' => $o->option_text,
                    'score' => $o->score,
                    'is_correct' => $o->is_correct,
                ])->toArray(),
            ])->toArray(),
        ];
    }

    /**
     * Return a sample JSON structure showing the expected import format.
     *
     * @return list<array<string, mixed>>
     */
    public function sampleJson(): array
    {
        return [
            [
                'title' => 'Contoh Quiz Laravel',
                'description' => 'Quiz tentang dasar-dasar Laravel.',
                'is_active' => true,
                'questions' => [
                    [
                        'question_text' => 'Apa kepanjangan dari MVC?',
                        'order' => 1,
                        'options' => [
                            ['option_text' => 'Model View Controller', 'score' => 10, 'is_correct' => true],
                            ['option_text' => 'Module View Component', 'score' => 0, 'is_correct' => false],
                            ['option_text' => 'Model View Component', 'score' => 0, 'is_correct' => false],
                            ['option_text' => 'Module Variable Controller', 'score' => 0, 'is_correct' => false],
                        ],
                    ],
                    [
                        'question_text' => 'Perintah artisan untuk membuat model baru?',
                        'order' => 2,
                        'options' => [
                            ['option_text' => 'php artisan make:model', 'score' => 10, 'is_correct' => true],
                            ['option_text' => 'php artisan create:model', 'score' => 0, 'is_correct' => false],
                            ['option_text' => 'php artisan new:model', 'score' => 0, 'is_correct' => false],
                        ],
                    ],
                ],
            ],
        ];
    }
}
