<?php

namespace App\Models;

use Database\Factories\ProgressJournalFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgressJournal extends Model
{
    /** @use HasFactory<ProgressJournalFactory> */
    use HasFactory;

    protected $fillable = [
        'timeline_id',
        'description',
        'progress_percentage',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function timeline(): BelongsTo
    {
        return $this->belongsTo(Timeline::class);
    }
}
