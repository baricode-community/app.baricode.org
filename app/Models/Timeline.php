<?php

namespace App\Models;

use Database\Factories\TimelineFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Timeline extends Model
{
    /** @use HasFactory<TimelineFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'start_date',
        'end_date',
        'progress',
        'notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'progress' => 'integer',
    ];

    public function progressJournals(): HasMany
    {
        return $this->hasMany(ProgressJournal::class);
    }

    /**
     * Calculate progress based on all progress journals
     * Average of all journal progress percentages
     */
    public function calculateProgress(): int
    {
        $journals = $this->progressJournals()->whereNotNull('progress_percentage')->get();

        if ($journals->isEmpty()) {
            return 0;
        }

        $average = $journals->avg('progress_percentage');

        return (int) round($average);
    }

    /**
     * Update progress based on journals
     */
    public function updateProgressFromJournals(): void
    {
        $this->update(['progress' => $this->calculateProgress()]);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'planned' => 'Direncanakan',
            'pending' => 'Tertunda',
            'ongoing' => 'Berlangsung',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => 'Tidak Diketahui',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'planned' => 'primary',
            'pending' => 'warning',
            'ongoing' => 'info',
            'completed' => 'success',
            'cancelled' => 'danger',
            default => 'secondary',
        };
    }
}
