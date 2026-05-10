<?php

namespace Database\Factories\Mentoring;

use App\Models\Mentoring\MentoringProgram;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MentoringProgram>
 */
class MentoringProgramFactory extends Factory
{
    protected $model = MentoringProgram::class;

    private static array $programs = [
        [
            'title' => 'Bimbingan Web Development Pemula',
            'description' => 'Program bimbingan intensif untuk kamu yang baru memulai perjalanan di dunia web development. Mulai dari dasar HTML, CSS, JavaScript hingga framework modern.',
            'goals' => "- Memahami konsep dasar HTML & CSS\n- Mampu membuat halaman web statis\n- Memahami dasar JavaScript\n- Mampu membuat web interaktif sederhana",
        ],
        [
            'title' => 'Bimbingan Laravel untuk Pemula',
            'description' => 'Belajar framework Laravel dari nol hingga bisa membuat aplikasi web penuh. Cocok untuk kamu yang sudah paham PHP dasar.',
            'goals' => "- Memahami konsep MVC\n- Mampu membuat CRUD dengan Laravel\n- Memahami Eloquent ORM\n- Bisa deploy aplikasi Laravel",
        ],
        [
            'title' => 'Bimbingan Python & Data Science',
            'description' => 'Perjalanan belajar Python dari dasar hingga analisis data. Termasuk library populer seperti Pandas, NumPy, dan visualisasi data.',
            'goals' => "- Menguasai syntax Python\n- Mampu melakukan analisis data dengan Pandas\n- Memahami visualisasi data\n- Membuat mini project data analysis",
        ],
        [
            'title' => 'Bimbingan Mobile Development (Flutter)',
            'description' => 'Belajar membangun aplikasi mobile cross-platform menggunakan Flutter dan Dart. Dari UI dasar hingga integrasi API.',
            'goals' => "- Memahami Dart fundamentals\n- Mampu membangun UI Flutter\n- Integrasi REST API\n- Publish ke Google Play Store",
        ],
        [
            'title' => 'Bimbingan UI/UX Design',
            'description' => 'Pelajari prinsip desain UI/UX dan cara menggunakan Figma untuk membuat desain yang menarik dan fungsional.',
            'goals' => "- Memahami prinsip UI/UX\n- Mampu menggunakan Figma\n- Membuat wireframe dan prototype\n- Memahami user research",
        ],
    ];

    public function definition(): array
    {
        $program = fake()->randomElement(self::$programs);

        return [
            'title' => $program['title'],
            'description' => $program['description'],
            'goals' => $program['goals'],
            'is_open' => true,
        ];
    }

    public function closed(): static
    {
        return $this->state(['is_open' => false]);
    }
}
