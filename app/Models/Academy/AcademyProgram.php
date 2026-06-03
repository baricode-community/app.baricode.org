<?php

namespace App\Models\Academy;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Str;

class AcademyProgram extends Model
{
    protected $fillable = [
        'uuid',
        'title',
        'description',
        'thumbnail',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
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

    public function batches(): HasMany
    {
        return $this->hasMany(AcademyBatch::class);
    }

    public function activeBatches(): HasMany
    {
        return $this->hasMany(AcademyBatch::class)->where('is_active', true);
    }

    public function enrollments(): HasManyThrough
    {
        return $this->hasManyThrough(AcademyEnrollment::class, AcademyBatch::class);
    }
}
