<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserMeet extends Pivot
{
    use HasFactory;

    protected $table = 'user_meets';

    protected $fillable = [
        'user_id',
        'meet_id',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function meet()
    {
        return $this->belongsTo(Meet::class);
    }
}
