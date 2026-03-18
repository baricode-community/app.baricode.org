<?php

namespace App\Models\LMS;

use Database\Factories\LMS\LessonFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    /** @use HasFactory<LessonFactory> */
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'content',
        'order',
        'duration',
        'is_published',
    ];

    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'content' => 'string',
        'order' => 'integer',
        'duration' => 'integer',
        'is_published' => 'boolean',
    ];

    /**
     * Get the category that owns this lesson.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(CourseCategory::class, 'category_id');
    }

    /**
     * Get the youtube videos for this lesson.
     */
    public function youtubeVideos(): HasMany
    {
        return $this->hasMany(YoutubeList::class, 'lesson_id')->orderBy('order');
    }
}
