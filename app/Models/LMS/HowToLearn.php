<?php

namespace App\Models\LMS;

use Database\Factories\LMS\HowToLearnFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class HowToLearn extends Model
{
    /** @use HasFactory<HowToLearnFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'content',
        'is_active',
    ];

    protected $casts = [
        'title'       => 'string',
        'description' => 'string',
        'content'     => 'string',
        'is_active'   => 'boolean',
    ];

    /**
     * Get the courses that use this how-to-learn guide.
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_how_to_learn');
    }
}
