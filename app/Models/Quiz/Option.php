<?php

namespace App\Models\Quiz;

use Database\Factories\Quiz\OptionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Option extends Model
{
    /** @use HasFactory<OptionFactory> */
    use HasFactory;

    protected $fillable = [
        'question_id',
        'option_text',
        'score',
        'is_correct',
    ];

    protected $casts = [
        'option_text' => 'string',
        'score' => 'integer',
        'is_correct' => 'boolean',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
