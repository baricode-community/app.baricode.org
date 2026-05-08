<?php

namespace App\Enums\Mentoring;

enum MentoringEnrollmentStatus: string
{
    case Pending = 'pending';
    case Active = 'active';
    case Completed = 'completed';
    case Dropped = 'dropped';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Menunggu Persetujuan',
            self::Active => 'Aktif',
            self::Completed => 'Selesai',
            self::Dropped => 'Dihentikan',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Active => 'success',
            self::Completed => 'info',
            self::Dropped => 'gray',
        };
    }
}
