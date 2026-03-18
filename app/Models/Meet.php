<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meet extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'scheduled_at',
        'status',
    ];

    protected $hidden = [
        'id',
        'created_at',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    /**
     * Relasi many-to-many dengan User melalui user_meets pivot table
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_meets')
            ->withPivot('description')
            ->withTimestamps();
    }
}
