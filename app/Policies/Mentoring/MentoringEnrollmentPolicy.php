<?php

namespace App\Policies\Mentoring;

use App\Models\Mentoring\MentoringEnrollment;
use App\Models\User;

class MentoringEnrollmentPolicy
{
    public function before(User $user, string $ability): ?bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }

        return null;
    }

    public function view(User $user, MentoringEnrollment $enrollment): bool
    {
        return $user->id == $enrollment->user_id;
    }
}
