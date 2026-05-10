<?php

namespace Database\Factories\Mentoring;

use App\Models\Mentoring\MentoringEnrollment;
use App\Models\Mentoring\MentoringSession;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MentoringSession>
 */
class MentoringSessionFactory extends Factory
{
    protected $model = MentoringSession::class;

    private static array $topics = [
        'Pengenalan dan Setup Environment',
        'HTML & CSS Dasar',
        'JavaScript Fundamentals',
        'Git & Version Control',
        'Konsep OOP',
        'Database & SQL Dasar',
        'REST API Concepts',
        'Framework Introduction',
        'Routing & Controller',
        'Database Migration & Eloquent',
        'Authentication & Authorization',
        'Testing Dasar',
        'Deployment & CI/CD',
        'Review Project Akhir',
    ];

    private static array $tasks = [
        "1. Buat akun GitHub jika belum ada\n2. Install VS Code dan ekstensi yang direkomendasikan\n3. Buat repository pertama",
        "1. Buat halaman profil sederhana dengan HTML\n2. Styling menggunakan CSS\n3. Upload ke GitHub Pages",
        "1. Kerjakan 10 soal latihan JavaScript di HackerRank\n2. Buat program kalkulator sederhana",
        "1. Lakukan commit minimal 1x per hari selama seminggu\n2. Pelajari git branching",
        "1. Buat class sederhana sesuai contoh diskusi\n2. Implementasikan inheritance",
        "1. Buat database untuk proyek mini\n2. Tulis 5 query SQL dasar",
        "1. Baca dokumentasi REST API\n2. Coba request API menggunakan Postman",
        "1. Install framework yang disepakati\n2. Buat project baru dan jalankan di lokal",
        "1. Buat minimal 3 route\n2. Hubungkan route dengan controller",
        "1. Buat migration untuk tabel proyek\n2. Buat model dan coba CRUD sederhana",
    ];

    public function definition(): array
    {
        $sessionDate = fake()->dateTimeBetween('-3 months', 'now');
        $hasNextSession = fake()->boolean(70);

        return [
            'mentoring_enrollment_id' => MentoringEnrollment::factory()->active(),
            'session_date' => $sessionDate,
            'topic' => fake()->randomElement(self::$topics),
            'notes' => fake()->paragraph(3),
            'tasks' => fake()->randomElement(self::$tasks),
            'next_session_date' => $hasNextSession ? fake()->dateTimeBetween('now', '+2 weeks') : null,
            'next_session_plan' => $hasNextSession ? 'Melanjutkan materi ' . fake()->randomElement(self::$topics) : null,
        ];
    }
}
