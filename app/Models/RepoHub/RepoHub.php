<?php

namespace App\Models\RepoHub;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RepoHub extends Model
{
    /** @use HasFactory<\Database\Factories\RepoHub\RepoHubFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'repo_url',
        'demo_url',
        'why_recommended',
        'is_published',
    ];

    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'description' => 'string',
        'repo_url' => 'string',
        'demo_url' => 'string',
        'why_recommended' => 'string',
        'is_published' => 'boolean',
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(RepoHubTag::class, 'repo_hub_tag', 'repo_hub_id', 'repo_hub_tag_id');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
