<?php

namespace Database\Seeders\Mentoring;

use App\Models\Mentoring\MentoringEnrollment;
use App\Models\Mentoring\MentoringProgram;
use App\Models\Mentoring\MentoringSession;
use App\Models\User;
use Database\Factories\Mentoring\MentoringEnrollmentFactory;
use Illuminate\Database\Seeder;

class MentoringSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::inRandomOrder()->limit(8)->get();

        // 3 program terbuka, 1 program ditutup
        $openPrograms = MentoringProgram::factory(3)->create();
        MentoringProgram::factory()->closed()->create();

        foreach ($openPrograms as $program) {
            // 1-2 enrollment aktif dengan beberapa sesi
            $activeCount = fake()->numberBetween(1, 2);
            $activeEnrollments = MentoringEnrollment::factory($activeCount)
                ->active()
                ->for($program, 'program')
                ->for($users->shift() ?? User::factory()->create(), 'user')
                ->create();

            foreach ($activeEnrollments as $enrollment) {
                MentoringSession::factory(fake()->numberBetween(2, 5))
                    ->for($enrollment, 'enrollment')
                    ->create();
            }

            // 1-2 enrollment pending
            $pendingCount = fake()->numberBetween(1, 2);
            MentoringEnrollment::factory($pendingCount)
                ->pending()
                ->for($program, 'program')
                ->for($users->shift() ?? User::factory()->create(), 'user')
                ->create();

            // 1 enrollment selesai dengan sesi lengkap
            $completed = MentoringEnrollment::factory()
                ->completed()
                ->for($program, 'program')
                ->for($users->shift() ?? User::factory()->create(), 'user')
                ->create();

            MentoringSession::factory(fake()->numberBetween(5, 8))
                ->for($completed, 'enrollment')
                ->create();

            // 1 enrollment ditolak
            MentoringEnrollment::factory()
                ->dropped()
                ->for($program, 'program')
                ->for($users->shift() ?? User::factory()->create(), 'user')
                ->create();
        }
    }
}
