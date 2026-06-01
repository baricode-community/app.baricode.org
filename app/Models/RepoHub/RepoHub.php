<?php

namespace App\Models\RepoHub;

use App\Enums\RepoHub\RepoHubStatus;
use App\Models\User;
use Database\Factories\RepoHub\RepoHubFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class RepoHub extends Model
{
    /** @use HasFactory<RepoHubFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'repo_url',
        'demo_url',
        'why_recommended',
        'is_published',
        'submitted_by',
        'status',
        'rejection_note',
    ];

    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'description' => 'string',
        'repo_url' => 'string',
        'demo_url' => 'string',
        'why_recommended' => 'string',
        'is_published' => 'boolean',
        'status' => RepoHubStatus::class,
        'rejection_note' => 'string',
    ];

    public static function generateSlug(): string
    {
        do {
            $slug = Str::lower(Str::random(5));
        } while (self::where('slug', $slug)->exists());

        return $slug;
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(RepoHubTag::class, 'repo_hub_tag', 'repo_hub_id', 'repo_hub_tag_id');
    }

    public function submitter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->where('status', RepoHubStatus::Approved);
    }

    public function scopePendingSubmissions($query)
    {
        return $query->where('status', RepoHubStatus::Pending)->whereNotNull('submitted_by');
    }

    public function isPending(): bool
    {
        return $this->status === RepoHubStatus::Pending;
    }

    public function isApproved(): bool
    {
        return $this->status === RepoHubStatus::Approved;
    }

    public function isRejected(): bool
    {
        return $this->status === RepoHubStatus::Rejected;
    }

    public function approve(): void
    {
        $this->update([
            'status' => RepoHubStatus::Approved,
            'is_published' => true,
            'rejection_note' => null,
        ]);
    }

    public function reject(string $note): void
    {
        $this->update([
            'status' => RepoHubStatus::Rejected,
            'is_published' => false,
            'rejection_note' => $note,
        ]);
    }
}
