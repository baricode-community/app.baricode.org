<?php

namespace App\Models;

use Database\Factories\BlogFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Blog extends Model
{
    /** @use HasFactory<BlogFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'author_id',
        'is_published',
        'published_at',
        'views_count',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'content' => 'string',
        'excerpt' => 'string',
        'featured_image' => 'string',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'views_count' => 'integer',
        'meta_title' => 'string',
        'meta_description' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_category', 'blog_id', 'category_id')
            ->withTimestamps();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(BlogTag::class, 'blog_tag', 'blog_id', 'tag_id')
            ->withTimestamps();
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->where(function ($q) {
                $q->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    public function getReadingTimeAttribute(): int
    {
        $wordCount = str_word_count(strip_tags($this->content));

        return (int) ceil($wordCount / 200);
    }

    public function getWordCountAttribute(): int
    {
        return str_word_count(strip_tags($this->content));
    }

    public function getEffectiveTitleAttribute(): string
    {
        return $this->meta_title ?: $this->title;
    }

    public function getEffectiveDescriptionAttribute(): string
    {
        return $this->meta_description ?: ($this->excerpt ?: '');
    }
}
