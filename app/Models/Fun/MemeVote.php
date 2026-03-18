<?php

namespace App\Models\Fun;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class MemeVote extends Model
{
    protected $table = 'meme_votes';

    public $timestamps = true;

    protected $fillable = [
        'meme_id',
        'user_id',
        'vote_type',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi dengan Meme - setiap vote milik satu meme
     */
    public function meme()
    {
        return $this->belongsTo(Meme::class);
    }

    /**
     * Relasi dengan User - setiap vote dibuat oleh satu user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
