<?php

namespace App\MCP\Tools\Quiz;

use App\Models\Quiz\Quiz;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Content\Text;

class ListQuizzesTool extends Tool
{
    public function name(): string
    {
        return 'list_quizzes';
    }

    public function description(): string
    {
        return 'Get list of all quizzes with active status and question count';
    }

    public function handle(array $input): Text
    {
        $query = Quiz::with('questions:id,quiz_id');

        if ($input['active_only'] ?? true) {
            $query->where('is_active', true);
        }

        $quizzes = $query->select('id', 'title', 'description', 'is_active', 'created_at')
            ->get()
            ->map(fn ($quiz) => [
                'id' => $quiz->id,
                'title' => $quiz->title,
                'description' => $quiz->description,
                'is_active' => (bool) $quiz->is_active,
                'question_count' => $quiz->questions->count(),
                'created_at' => $quiz->created_at->format('Y-m-d H:i:s'),
            ]);

        return Text::make(json_encode($quizzes, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}
