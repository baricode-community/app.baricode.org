<?php

namespace App\MCP\Tools\Quiz;

use App\Models\Quiz\Quiz;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Content\Text;

class GetQuizTool extends Tool
{
    public function name(): string
    {
        return 'get_quiz';
    }

    public function description(): string
    {
        return 'Get quiz detail with all questions and options including correct flags and scores';
    }

    public function handle(array $input): Text
    {
        $quiz = Quiz::with(['questions.options:id,question_id,option_text,is_correct,score'])
            ->select('id', 'title', 'description', 'is_active', 'created_at')
            ->find($input['quiz_id']);

        if (!$quiz) {
            return Text::make(json_encode(['error' => 'Quiz not found'], JSON_UNESCAPED_SLASHES));
        }

        $data = [
            'id' => $quiz->id,
            'title' => $quiz->title,
            'description' => $quiz->description,
            'is_active' => (bool) $quiz->is_active,
            'question_count' => $quiz->questions->count(),
            'questions' => $quiz->questions->map(fn ($question) => [
                'id' => $question->id,
                'question_text' => $question->question_text,
                'order' => $question->order,
                'options' => $question->options->map(fn ($option) => [
                    'id' => $option->id,
                    'option_text' => $option->option_text,
                    'is_correct' => (bool) $option->is_correct,
                    'score' => $option->score,
                ]),
            ]),
            'created_at' => $quiz->created_at->format('Y-m-d H:i:s'),
        ];

        return Text::make(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}
