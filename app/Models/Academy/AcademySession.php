<?php

namespace App\Models\Academy;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcademySession extends Model
{
    protected $fillable = [
        'academy_batch_id',
        'title',
        'description',
        'scheduled_at',
        'meeting_link',
        'youtube_link',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
            'sort_order' => 'integer',
        ];
    }

    public function batch(): BelongsTo
    {
        return $this->belongsTo(AcademyBatch::class, 'academy_batch_id');
    }
}
