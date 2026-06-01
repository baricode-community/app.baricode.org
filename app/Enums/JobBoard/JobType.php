<?php

namespace App\Enums\JobBoard;

enum JobType: string
{
    case FullTime = 'full_time';
    case PartTime = 'part_time';
    case Contract = 'contract';
    case Internship = 'internship';
    case Freelance = 'freelance';

    public function label(): string
    {
        return match ($this) {
            self::FullTime => 'Full-time',
            self::PartTime => 'Part-time',
            self::Contract => 'Kontrak',
            self::Internship => 'Magang',
            self::Freelance => 'Freelance',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::FullTime => 'success',
            self::PartTime => 'info',
            self::Contract => 'warning',
            self::Internship => 'purple',
            self::Freelance => 'gray',
        };
    }
}
