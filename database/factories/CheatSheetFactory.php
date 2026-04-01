<?php

namespace Database\Factories;

use App\Models\CheatSheet;
use App\Models\CheatSheetCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CheatSheet>
 */
class CheatSheetFactory extends Factory
{
    private static array $sampleContents = [
        "# Git Dasar\ngit init             → inisialisasi repo baru\ngit clone <url>      → clone repo\ngit status           → cek status\ngit add .            → stage semua perubahan\ngit commit -m 'msg'  → commit\ngit push             → push ke remote\ngit pull             → pull dari remote",
        "# Docker Commands\ndocker ps            → list container berjalan\ndocker ps -a         → semua container\ndocker images        → list image\ndocker build -t .    → build image\ndocker run -it       → jalankan container interaktif\ndocker stop <id>     → stop container\ndocker rm <id>       → hapus container",
        "# SQL Dasar\nSELECT * FROM table;\nINSERT INTO table (col) VALUES (val);\nUPDATE table SET col = val WHERE id = 1;\nDELETE FROM table WHERE id = 1;\nCREATE TABLE table (id INT PRIMARY KEY);\nALTER TABLE table ADD COLUMN name VARCHAR(255);",
        "# Linux Terminal\nls -la               → list file dengan detail\ncd /path             → pindah direktori\nmkdir nama           → buat folder\nrm -rf folder        → hapus folder\ncp src dst           → copy file\nmv src dst           → pindah/rename\nchmod 755 file       → ubah permission\ncat file.txt         → tampilkan isi file",
        "# JavaScript Array Methods\narr.map(fn)          → transformasi tiap element\narr.filter(fn)       → filter berdasarkan kondisi\narr.reduce(fn, init) → akumulasi nilai\narr.find(fn)         → element pertama yang cocok\narr.some(fn)         → minimal satu yang true\narr.every(fn)        → semua harus true\narr.includes(val)    → cek keberadaan nilai",
    ];

    public function definition(): array
    {
        $content = $this->faker->randomElement(self::$sampleContents);

        return [
            'user_id'                   => User::factory(),
            'cheat_sheet_category_id'   => CheatSheetCategory::factory(),
            'title'                     => $this->faker->sentence(4, true),
            'description'               => $this->faker->optional(0.7)->sentence(),
            'content'                   => $content,
            'is_public'                 => $this->faker->boolean(75),
        ];
    }

    public function public(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_public' => true,
        ]);
    }

    public function private(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_public' => false,
        ]);
    }
}
