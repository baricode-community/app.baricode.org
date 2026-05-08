<?php

namespace App\Models\Mentoring;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class MentoringSession extends Model
{
    protected $fillable = [
        'uuid',
        'mentoring_enrollment_id',
        'session_date',
        'topic',
        'notes',
        'tasks',
        'next_session_date',
        'next_session_plan',
    ];

    protected function casts(): array
    {
        return [
            'session_date' => 'date',
            'next_session_date' => 'date',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(MentoringEnrollment::class, 'mentoring_enrollment_id');
    }
}
