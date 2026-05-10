<?php

namespace Database\Factories\Mentoring;

use App\Enums\Mentoring\MentoringEnrollmentStatus;
use App\Models\Mentoring\MentoringEnrollment;
use App\Models\Mentoring\MentoringProgram;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MentoringEnrollment>
 */
class MentoringEnrollmentFactory extends Factory
{
    protected $model = MentoringEnrollment::class;

    private static array $goalNotes = [
        'Saya ingin berkarir sebagai web developer dalam 6 bulan ke depan. Saya sudah belajar sendiri tapi butuh arahan yang lebih terstruktur.',
        'Ingin pindah jalur dari non-IT ke software engineering. Butuh mentor yang bisa membantu saya memulai dari nol.',
        'Sudah kerja 2 tahun tapi merasa stuck. Ingin upgrade skill dan belajar best practices yang benar.',
        'Mau bikin startup dan butuh skill teknis yang solid. Fokus ke full-stack development.',
        'Fresh graduate yang ingin memperdalam skill sebelum melamar kerja.',
        'Belajar sambil kerja, butuh panduan biar belajarnya lebih efektif dan terarah.',
    ];

    public function definition(): array
    {
        return [
            'mentoring_program_id' => MentoringProgram::factory(),
            'user_id' => User::factory(),
            'status' => MentoringEnrollmentStatus::Pending,
            'goal_notes' => fake()->randomElement(self::$goalNotes),
            'rejection_reason' => null,
            'started_at' => null,
            'completed_at' => null,
        ];
    }

    public function pending(): static
    {
        return $this->state([
            'status' => MentoringEnrollmentStatus::Pending,
            'started_at' => null,
            'completed_at' => null,
            'rejection_reason' => null,
        ]);
    }

    public function active(): static
    {
        return $this->state([
            'status' => MentoringEnrollmentStatus::Active,
            'started_at' => fake()->dateTimeBetween('-2 months', '-1 week'),
            'completed_at' => null,
            'rejection_reason' => null,
        ]);
    }

    public function completed(): static
    {
        $startedAt = fake()->dateTimeBetween('-6 months', '-2 months');

        return $this->state([
            'status' => MentoringEnrollmentStatus::Completed,
            'started_at' => $startedAt,
            'completed_at' => fake()->dateTimeBetween($startedAt, '-1 month'),
            'rejection_reason' => null,
        ]);
    }

    public function dropped(): static
    {
        return $this->state([
            'status' => MentoringEnrollmentStatus::Dropped,
            'started_at' => null,
            'completed_at' => null,
            'rejection_reason' => fake()->randomElement([
                'Slot untuk program ini sudah penuh.',
                'Profil dan tujuan belum sesuai dengan program yang dipilih.',
                'Belum memenuhi prasyarat yang dibutuhkan.',
            ]),
        ]);
    }
}
