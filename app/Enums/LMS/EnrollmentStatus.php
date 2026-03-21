<?php

namespace App\Enums\LMS;

enum EnrollmentStatus: string
{
    case Pending = 'pending';
    case Active = 'active';
    case Completed = 'completed';
    case UnenrollRequested = 'unenroll_requested';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match($this) {
            self::Pending => 'Menunggu Persetujuan',
            self::Active => 'Aktif',
            self::Completed => 'Selesai',
            self::UnenrollRequested => 'Permintaan Keluar',
            self::Rejected => 'Ditolak',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::Pending => 'warning',
            self::Active => 'success',
            self::Completed => 'info',
            self::UnenrollRequested => 'danger',
            self::Rejected => 'gray',
        };
    }
}
