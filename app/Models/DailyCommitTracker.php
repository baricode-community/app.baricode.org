<?php

namespace App\Models;

use Database\Factories\DailyCommitTrackerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DailyCommitTracker extends Model
{
    /** @use HasFactory<DailyCommitTrackerFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'message',
        'impression',
        'success_level',
        'tracked_date',
    ];

    protected $keyType = 'string';

    public $incrementing = false;

    protected function casts(): array
    {
        return [
            'tracked_date' => 'date',
            'success_level' => 'integer',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::random(5);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
