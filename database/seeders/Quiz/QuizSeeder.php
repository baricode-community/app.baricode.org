<?php

namespace Database\Seeders\Quiz;

use App\Models\Quiz\Quiz;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $quiz = Quiz::create([
            'title' => 'Tes Kepribadian Developer',
            'description' => 'Temukan gaya kerja dan kepribadian kamu sebagai seorang developer.',
            'is_active' => true,
        ]);

        $questions = [
            [
                'question_text' => 'Ketika menghadapi bug yang sulit, apa yang pertama kali kamu lakukan?',
                'order' => 1,
                'options' => [
                    ['option_text' => 'Langsung googling error message-nya', 'score' => 5, 'is_correct' => false],
                    ['option_text' => 'Baca dokumentasi resmi dulu', 'score' => 10, 'is_correct' => true],
                    ['option_text' => 'Tanya teman atau Stack Overflow', 'score' => 7, 'is_correct' => false],
                    ['option_text' => 'Debug step by step dari awal', 'score' => 10, 'is_correct' => true],
                ],
            ],
            [
                'question_text' => 'Pilih tools yang biasa kamu gunakan saat coding:',
                'order' => 2,
                'options' => [
                    ['option_text' => 'VS Code', 'score' => 5, 'is_correct' => false],
                    ['option_text' => 'PhpStorm / JetBrains', 'score' => 10, 'is_correct' => true],
                    ['option_text' => 'Vim / Neovim', 'score' => 15, 'is_correct' => true],
                    ['option_text' => 'Sublime Text', 'score' => 3, 'is_correct' => false],
                ],
            ],
            [
                'question_text' => 'Mana dari kebiasaan berikut yang sering kamu lakukan?',
                'order' => 3,
                'options' => [
                    ['option_text' => 'Menulis unit test sebelum coding (TDD)', 'score' => 15, 'is_correct' => true],
                    ['option_text' => 'Commit kode setiap kali ada perubahan kecil', 'score' => 10, 'is_correct' => true],
                    ['option_text' => 'Deploy langsung ke production tanpa testing', 'score' => 0, 'is_correct' => false],
                    ['option_text' => 'Review kode orang lain sebelum merge', 'score' => 12, 'is_correct' => true],
                ],
            ],
        ];

        foreach ($questions as $questionData) {
            $optionsData = $questionData['options'];
            unset($questionData['options']);

            $question = $quiz->questions()->create($questionData);

            foreach ($optionsData as $optionData) {
                $question->options()->create($optionData);
            }
        }
    }
}
