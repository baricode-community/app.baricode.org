<?php

namespace App\Models\Certificate;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'icon',
        'badge_color',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'certificate_user')
            ->using(CertificateUser::class)
            ->withPivot('issued_at', 'notes')
            ->withTimestamps()
            ->orderByPivot('issued_at', 'desc');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function isHeldBy(User $user): bool
    {
        return $this->users()->where('user_id', $user->id)->exists();
    }
}
