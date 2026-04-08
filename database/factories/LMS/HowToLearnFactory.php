<?php

namespace Database\Factories\LMS;

use App\Models\LMS\HowToLearn;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<HowToLearn>
 */
class HowToLearnFactory extends Factory
{
    protected $model = HowToLearn::class;

    public function definition(): array
    {
        return [
            'title'       => $this->faker->sentence(4),
            'description' => $this->faker->sentence(10),
            'content'     => $this->generateMarkdownContent(),
            'is_active'   => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(['is_active' => false]);
    }

    public function active(): static
    {
        return $this->state(['is_active' => true]);
    }

    private function generateMarkdownContent(): string
    {
        return <<<'MD'
## Langkah-Langkah Belajar

Panduan ini akan membantu kamu memulai perjalanan belajarmu di Baricode.

### 1. Persiapan Lingkungan

Pastikan kamu sudah menyiapkan tools berikut:

- **Code Editor** — Visual Studio Code atau IDE favoritmu
- **Terminal** — Git Bash / WSL untuk Windows, Terminal bawaan untuk Mac/Linux
- **Git** — Untuk version control

### 2. Mulai Belajar

> Konsistensi adalah kunci. Belajar 30 menit setiap hari lebih efektif daripada belajar 5 jam sekali seminggu.

```bash
# Contoh perintah dasar
git clone https://github.com/contoh/repo.git
cd repo
composer install
```

### 3. Evaluasi

Setelah menyelesaikan materi, evaluasi pemahamanmu dengan:

1. Mengerjakan quiz yang tersedia
2. Membuat project kecil sendiri
3. Berdiskusi di komunitas
MD;
    }
}
