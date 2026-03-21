<?php

namespace App\Models\LMS;

use Database\Factories\LMS\CourseCategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class CourseCategory extends Model
{
    /** @use HasFactory<CourseCategoryFactory> */
    use HasFactory;

    protected $table = 'course_categories';

    protected $fillable = [
        'course_id',
        'title',
        'slug',
        'description',
        'order',
        'is_published',
    ];

    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'order' => 'integer',
        'is_published' => 'boolean',
    ];

    /**
     * Get the course that owns this category.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get lessons that belong to this category.
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class, 'category_id')->orderBy('order');
    }

    /**
     * Get category progress records for this category.
     */
    public function categoryProgress(): HasMany
    {
        return $this->hasMany(CategoryProgress::class, 'category_id');
    }

    /**
     * Get the route key for model binding.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Boot the model.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (! $model->slug) {
                $model->slug = Str::slug($model->title);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('title')) {
                $model->slug = Str::slug($model->title);
            }
        });
    }
}
