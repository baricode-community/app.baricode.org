<?php

namespace App\Enums\Quiz;

enum QuizAttemptStatus: string
{
    case InProgress = 'in_progress';
    case Passed = 'passed';
    case Failed = 'failed';

    public function label(): string
    {
        return match($this) {
            self::InProgress => 'Sedang Dikerjakan',
            self::Passed => 'Lulus',
            self::Failed => 'Tidak Lulus',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::InProgress => 'gray',
            self::Passed => 'success',
            self::Failed => 'danger',
        };
    }
}
