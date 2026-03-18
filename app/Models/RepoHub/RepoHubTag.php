<?php

namespace App\Models\RepoHub;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RepoHubTag extends Model
{
    /** @use HasFactory<\Database\Factories\RepoHub\RepoHubTagFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    protected $casts = [
        'name' => 'string',
        'slug' => 'string',
    ];

    public function repoHubs(): BelongsToMany
    {
        return $this->belongsToMany(RepoHub::class, 'repo_hub_tag', 'repo_hub_tag_id', 'repo_hub_id');
    }
}
