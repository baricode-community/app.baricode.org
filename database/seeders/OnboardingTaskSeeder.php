<?php

namespace Database\Seeders;

use App\Models\Onboarding\OnboardingTask;
use Illuminate\Database\Seeder;

class OnboardingTaskSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = [
            [
                'title'       => 'Lengkapi Profilmu',
                'slug'        => 'lengkapi-profilmu',
                'description' => 'Tambahkan foto, bio, dan informasi akun kamu.',
                'icon'        => '👤',
                'order'       => 1,
                'content'     => <<<'MD'
## Kenapa profil itu penting?

Profil yang lengkap membantu anggota lain mengenali kamu dan membangun kepercayaan di komunitas.

## Apa yang perlu dilengkapi?

- **Nama lengkap** — pastikan nama kamu mudah dikenal
- **Username** — identitas unik kamu di Baricode
- **Bio** — ceritakan sedikit tentang dirimu, minat, atau teknologi yang kamu pelajari

## Cara melakukannya

1. Pergi ke **Settings → Profile**
2. Isi semua field yang tersedia
3. Klik **Simpan**

> Profil kamu akan langsung tampil di direktori **Keluarga Baricode** dan bisa dilihat oleh semua anggota.
MD,
            ],
            [
                'title'       => 'Daftar Kursus Pertamamu',
                'slug'        => 'daftar-kursus-pertama',
                'description' => 'Mulai belajar dengan mendaftar ke salah satu kursus yang tersedia.',
                'icon'        => '📚',
                'order'       => 2,
                'content'     => <<<'MD'
## Belajar di Baricode LMS

Baricode memiliki Learning Management System (LMS) yang berisi kursus-kursus pilihan di bidang teknologi.

## Cara mendaftar kursus

1. Buka menu **LMS** dari dashboard atau navigasi atas
2. Browse kursus yang tersedia
3. Pilih kursus yang sesuai dengan minatmu
4. Klik **Daftar** dan mulai belajar!

## Tips memilih kursus pertama

- Pilih topik yang **sudah sedikit kamu kenal** agar tidak terlalu overwhelmed
- Cek **deskripsi dan silabus** sebelum mendaftar
- Satu kursus aktif dulu — fokus lebih efektif dari pada banyak sekaligus

> Kamu bisa melihat semua kursus aktifmu di dashboard pada bagian **Kursus Saya**.
MD,
            ],
            [
                'title'       => 'Catat Daily Commit Pertamamu',
                'slug'        => 'catat-daily-commit-pertama',
                'description' => 'Bangun kebiasaan belajar harian dengan mencatat aktivitasmu.',
                'icon'        => '🔥',
                'order'       => 3,
                'content'     => <<<'MD'
## Apa itu Daily Commit Tracker?

Daily Commit Tracker adalah fitur untuk mencatat aktivitas belajar atau coding harianmu — mirip dengan GitHub contribution graph, tapi lebih personal.

## Cara mencatat commit pertama

1. Buka **Daily Commit Tracker** dari dashboard
2. Klik **Catat Hari Ini**
3. Isi judul aktivitasmu (contoh: "Belajar Laravel Routing")
4. Tambahkan catatan atau refleksi jika mau
5. Pilih **success level** (1–5) sesuai produktivitasmu hari ini
6. Simpan!

## Kenapa ini penting?

- Membangun **kebiasaan konsisten** — kunci belajar yang efektif
- Melacak **progress** kamu dari waktu ke waktu
- Mempertahankan **streak** harian sebagai motivasi

> Streak yang panjang bukan tujuan utama — yang penting adalah konsistensi jangka panjang. Mulai dari satu hari dulu!
MD,
            ],
            [
                'title'       => 'Eksplorasi RepoHub',
                'slug'        => 'eksplorasi-repohub',
                'description' => 'Temukan repository keren pilihan komunitas Baricode.',
                'icon'        => '💻',
                'order'       => 4,
                'content'     => <<<'MD'
## Apa itu RepoHub?

RepoHub adalah direktori repository pilihan yang dikurasi oleh komunitas Baricode — berisi proyek-proyek open source yang menarik, tools berguna, dan referensi belajar.

## Cara menggunakannya

1. Klik **RepoHub** dari dashboard atau menu navigasi
2. Browse repository yang ada
3. Klik repository yang menarik untuk melihat detailnya
4. Kunjungi link GitHub-nya untuk eksplorasi lebih lanjut

## Manfaat

- Temukan **inspirasi proyek** baru
- Pelajari **cara orang lain menulis kode**
- Kontribusi dengan merekomendasikan repository favorit kamu ke admin

> Punya repository keren yang ingin dibagikan? Hubungi admin Baricode!
MD,
            ],
            [
                'title'       => 'Kenalan dengan Keluarga Baricode',
                'slug'        => 'kenalan-dengan-keluarga-baricode',
                'description' => 'Lihat siapa saja anggota komunitas dan mulai terhubung.',
                'icon'        => '👥',
                'order'       => 5,
                'content'     => <<<'MD'
## Keluarga Baricode

Baricode bukan hanya platform belajar — ini adalah komunitas. Di **Keluarga Baricode**, kamu bisa melihat semua anggota yang sudah bergabung.

## Cara mengaksesnya

1. Klik **Keluarga** dari dashboard
2. Browse daftar anggota — bisa search berdasarkan nama atau username
3. Klik profil anggota untuk melihat detail: bio, stats commit, kursus, dan aktivitas mereka

## Kenapa ini penting?

- Belajar lebih **menyenangkan bersama komunitas**
- Temukan orang dengan minat yang sama
- Jadikan anggota senior sebagai **inspirasi** perjalanan belajarmu

> Setelah melengkapi profilmu, kamu juga akan muncul di sini — jadi anggota lain bisa menemukanmu!
MD,
            ],
        ];

        foreach ($tasks as $task) {
            OnboardingTask::firstOrCreate(['slug' => $task['slug']], $task);
        }
    }
}
