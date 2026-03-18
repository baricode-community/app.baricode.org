<?php

namespace Database\Seeders;

use App\Models\ProgressJournal;
use App\Models\Timeline;
use Illuminate\Database\Seeder;

class TimelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some demo timeline data
        $timeline1 = Timeline::create([
            'title' => 'Peluncuran Platform Baricode',
            'description' => 'Tahap awal peluncuran platform komunitas Baricode dengan fitur-fitur dasar.',
            'status' => 'completed',
            'start_date' => now()->subMonths(3),
            'end_date' => now()->subMonths(2),
            'progress' => 100,
            'notes' => 'Platform berhasil diluncurkan dengan semua fitur dasar sesuai rencana.',
        ]);

        $timeline1->progressJournals()->createMany([
            [
                'description' => 'Setup awal infrastruktur dan database server.',
                'progress_percentage' => 100,
            ],
            [
                'description' => 'Implementasi fitur authentication dan user management.',
                'progress_percentage' => 100,
            ],
            [
                'description' => 'Testing dan bug fixes sebelum launch.',
                'progress_percentage' => 100,
            ],
        ]);

        $timeline2 = Timeline::create([
            'title' => 'Pengembangan Fitur Dashboard Admin',
            'description' => 'Membuat dashboard admin yang komprehensif untuk mengelola komunitas dan konten.',
            'status' => 'ongoing',
            'start_date' => now()->subMonths(1),
            'end_date' => now()->addMonths(1),
            'progress' => 65,
            'notes' => 'Sedang dalam tahap implementasi fitur-fitur dashboard utama.',
        ]);

        $timeline2->progressJournals()->createMany([
            [
                'description' => 'Design UI/UX dashboard dan approval dari stakeholder.',
                'progress_percentage' => 100,
            ],
            [
                'description' => 'Implementasi backend API untuk dashboard functionality.',
                'progress_percentage' => 80,
            ],
            [
                'description' => 'Frontend development dan integration testing.',
                'progress_percentage' => 50,
            ],
        ]);

        $timeline3 = Timeline::create([
            'title' => 'Integrasi Payment Gateway',
            'description' => 'Integrasi dengan berbagai payment gateway untuk mendukung transaksi komunitas.',
            'status' => 'pending',
            'start_date' => now()->addWeeks(2),
            'end_date' => now()->addMonths(2),
            'progress' => 0,
            'notes' => 'Menunggu approval dari pihak payment provider.',
        ]);

        $timeline3->progressJournals()->create([
            'description' => 'Requirement gathering dan dokumentasi payment flow.',
            'progress_percentage' => 10,
        ]);

        $timeline4 = Timeline::create([
            'title' => 'Fitur Komunitas & Forum',
            'description' => 'Mengembangkan sistem forum dan komunitas untuk interaksi antar member.',
            'status' => 'ongoing',
            'start_date' => now()->subWeeks(2),
            'end_date' => now()->addMonths(1),
            'progress' => 45,
            'notes' => 'Backend API sudah selesai, sedang mengembangkan frontend interface.',
        ]);

        $timeline4->progressJournals()->createMany([
            [
                'description' => 'Database design untuk forum dan komunitas structure.',
                'progress_percentage' => 100,
            ],
            [
                'description' => 'Backend API development untuk post, comment, dan user interaction.',
                'progress_percentage' => 100,
            ],
            [
                'description' => 'Frontend UI development dan real-time updates.',
                'progress_percentage' => 30,
            ],
        ]);

        $timeline5 = Timeline::create([
            'title' => 'Sistem Notifikasi Real-time',
            'description' => 'Implementasi sistem notifikasi real-time menggunakan WebSocket.',
            'status' => 'cancelled',
            'start_date' => now()->subMonths(2),
            'end_date' => now()->subMonths(1),
            'progress' => 20,
            'notes' => 'Dibatalkan karena perubahan prioritas dan resource constraints.',
        ]);

        $timeline5->progressJournals()->createMany([
            [
                'description' => 'Research dan prototype WebSocket integration.',
                'progress_percentage' => 50,
            ],
            [
                'description' => 'Pembatalan project karena perubahan prioritas bisnis.',
                'progress_percentage' => 0,
            ],
        ]);

        $timeline6 = Timeline::create([
            'title' => 'Optimization & Performance Testing',
            'description' => 'Melakukan optimization dan performance testing untuk memastikan aplikasi berjalan dengan lancar.',
            'status' => 'pending',
            'start_date' => now()->addMonths(2),
            'end_date' => now()->addMonths(3),
            'progress' => 0,
            'notes' => 'Dijadwalkan setelah fitur-fitur utama selesai.',
        ]);

        $timeline6->progressJournals()->create([
            'description' => 'Planning dan setup untuk performance testing environment.',
            'progress_percentage' => 5,
        ]);

        // Create additional random timelines with progress journals
        Timeline::factory()->count(5)->create()->each(function ($timeline) {
            ProgressJournal::factory()->count(rand(2, 4))->create([
                'timeline_id' => $timeline->id,
            ]);
        });

        // Recalculate progress for all timelines based on their journals
        Timeline::all()->each(function ($timeline) {
            $timeline->updateProgressFromJournals();
        });
    }
}
