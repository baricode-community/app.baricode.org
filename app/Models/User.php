<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Fun\Meme;
use App\Models\Fun\MemeVote;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasRoles, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'bio',
        'phone_number',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'id',
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'bio' => 'string',
            'phone_number' => 'integer',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function userMeets()
    {
        return $this->hasMany(UserMeet::class);
    }

    /**
     * Relasi many-to-many dengan Meet melalui user_meets pivot table
     */
    public function meets()
    {
        return $this->belongsToMany(Meet::class, 'user_meets')
            ->withPivot('description')
            ->withTimestamps();
    }

    /**
     * Relasi dengan Meme - setiap user memiliki satu meme
     */
    public function meme()
    {
        return $this->hasOne(Meme::class);
    }

    /**
     * Relasi dengan MemeVote - setiap user dapat memiliki banyak votes
     */
    public function memeVotes()
    {
        return $this->hasMany(MemeVote::class);
    }

    /**
     * Relasi dengan DailyCommitTracker - setiap user dapat memiliki banyak daily commits
     */
    public function dailyCommitTrackers()
    {
        return $this->hasMany(DailyCommitTracker::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $panel->getId() === 'admin' && $this->hasRole('admin');
    }
}
