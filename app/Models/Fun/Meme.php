<?php

namespace App\Models\Fun;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Meme extends Model
{
    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'image_path',
        'caption',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = self::generateUniqueId();
            }
        });
    }

    /**
     * Generate unique meme ID
     */
    public static function generateUniqueId()
    {
        do {
            $id = strtoupper(substr(bin2hex(random_bytes(3)), 0, 5));
        } while (self::where('id', $id)->exists());

        return $id;
    }

    /**
     * Relasi dengan User - setiap meme dimiliki oleh satu user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi dengan MemeVote - setiap meme dapat memiliki banyak votes
     */
    public function votes()
    {
        return $this->hasMany(MemeVote::class);
    }

    /**
     * Relasi upvotes
     */
    public function upvotes()
    {
        return $this->hasMany(MemeVote::class)->where('vote_type', 'up');
    }

    /**
     * Relasi downvotes
     */
    public function downvotes()
    {
        return $this->hasMany(MemeVote::class)->where('vote_type', 'down');
    }

    /**
     * Get upvotes count
     */
    public function upvotesCount()
    {
        return $this->votes()->where('vote_type', 'up')->count();
    }

    /**
     * Get downvotes count
     */
    public function downvotesCount()
    {
        return $this->votes()->where('vote_type', 'down')->count();
    }

    /**
     * Get user's vote on this meme (if any)
     */
    public function userVote($userId)
    {
        return $this->votes()->where('user_id', $userId)->first();
    }
}
