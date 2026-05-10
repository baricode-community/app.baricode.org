<?php

namespace App\Models\Mentoring;

use Database\Factories\Mentoring\MentoringProgramFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class MentoringProgram extends Model
{
    use HasFactory;

    protected static function newFactory(): MentoringProgramFactory
    {
        return MentoringProgramFactory::new();
    }

    protected $fillable = [
        'uuid',
        'title',
        'description',
        'goals',
        'is_open',
    ];

    protected function casts(): array
    {
        return [
            'is_open' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(MentoringEnrollment::class);
    }

    public function activeEnrollments(): HasMany
    {
        return $this->hasMany(MentoringEnrollment::class)->where('status', 'active');
    }
}
