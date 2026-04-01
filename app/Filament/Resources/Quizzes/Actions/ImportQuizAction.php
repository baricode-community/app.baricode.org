<?php

namespace App\Filament\Resources\Quizzes\Actions;

use App\Services\QuizImportExportService;
use Exception;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;

class ImportQuizAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Import Quiz dari JSON')
            ->icon('heroicon-o-arrow-up-tray')
            ->color('success')
            ->modalWidth('2xl')
            ->modalDescription('Import satu atau beberapa quiz sekaligus dari file JSON.')
            ->form([
                Placeholder::make('format_info')
                    ->label('Format JSON')
                    ->content(new HtmlString(
                        '<div class="text-sm text-gray-600 dark:text-gray-400 space-y-1">'
                        .'<p>JSON harus berupa <strong>array</strong> (bisa berisi satu atau banyak quiz). Setiap quiz wajib memiliki:</p>'
                        .'<ul class="list-disc list-inside mt-1 space-y-0.5">'
                        .'<li><code class="font-mono bg-gray-100 dark:bg-gray-800 px-1 rounded">title</code> — judul quiz (wajib)</li>'
                        .'<li><code class="font-mono bg-gray-100 dark:bg-gray-800 px-1 rounded">description</code> — deskripsi (opsional)</li>'
                        .'<li><code class="font-mono bg-gray-100 dark:bg-gray-800 px-1 rounded">is_active</code> — true/false (opsional, default false)</li>'
                        .'<li><code class="font-mono bg-gray-100 dark:bg-gray-800 px-1 rounded">questions</code> — array pertanyaan (minimal 1, wajib)</li>'
                        .'</ul>'
                        .'<p class="mt-2">Setiap <strong>question</strong> wajib memiliki:</p>'
                        .'<ul class="list-disc list-inside mt-1 space-y-0.5">'
                        .'<li><code class="font-mono bg-gray-100 dark:bg-gray-800 px-1 rounded">question_text</code> — teks pertanyaan (wajib)</li>'
                        .'<li><code class="font-mono bg-gray-100 dark:bg-gray-800 px-1 rounded">order</code> — urutan (opsional)</li>'
                        .'<li><code class="font-mono bg-gray-100 dark:bg-gray-800 px-1 rounded">options</code> — array pilihan jawaban (minimal 2, wajib)</li>'
                        .'</ul>'
                        .'<p class="mt-2">Setiap <strong>option</strong> wajib memiliki:</p>'
                        .'<ul class="list-disc list-inside mt-1 space-y-0.5">'
                        .'<li><code class="font-mono bg-gray-100 dark:bg-gray-800 px-1 rounded">option_text</code> — teks pilihan (wajib)</li>'
                        .'<li><code class="font-mono bg-gray-100 dark:bg-gray-800 px-1 rounded">score</code> — nilai (opsional, default 0)</li>'
                        .'<li><code class="font-mono bg-gray-100 dark:bg-gray-800 px-1 rounded">is_correct</code> — true/false (opsional, default false)</li>'
                        .'</ul>'
                        .'<p class="mt-2 text-xs text-gray-500">Download contoh JSON menggunakan tombol "Download Contoh JSON" di sebelahnya.</p>'
                        .'</div>'
                    )),

                FileUpload::make('json_file')
                    ->label('Upload File JSON')
                    ->acceptedFileTypes(['application/json', 'text/plain'])
                    ->directory('quiz-imports')
                    ->visibility('private')
                    ->helperText('Upload file .json berisi data quiz'),

                Textarea::make('json_text')
                    ->label('Atau Paste JSON di sini')
                    ->rows(12)
                    ->placeholder('[{"title":"Quiz saya","questions":[...]}]')
                    ->helperText('Isi salah satu saja: upload file atau paste JSON'),
            ])
            ->action(function (array $data) {
                try {
                    $jsonData = $this->resolveJsonData($data);

                    $service = new QuizImportExportService;
                    $quizzes = $service->importQuizzes($jsonData);
                    $count = count($quizzes);

                    $titles = collect($quizzes)->pluck('title')->join(', ');

                    Notification::make()
                        ->title('Import Berhasil!')
                        ->body("{$count} quiz berhasil diimport: {$titles}.")
                        ->success()
                        ->send();
                } catch (Exception $e) {
                    Notification::make()
                        ->title('Import Gagal')
                        ->body('Error: '.$e->getMessage())
                        ->danger()
                        ->persistent()
                        ->send();
                }
            });
    }

    /**
     * Resolve JSON data from file upload or raw textarea input.
     *
     * @param  array<string, mixed>  $data
     * @return array<mixed>
     *
     * @throws Exception
     */
    private function resolveJsonData(array $data): array
    {
        if (empty($data['json_file']) && empty($data['json_text'])) {
            throw new Exception('Harap upload file JSON atau paste data JSON terlebih dahulu.');
        }

        $raw = null;

        if (! empty($data['json_file'])) {
            $filePath = Storage::disk('local')->path('quiz-imports/'.$data['json_file']);

            if (! file_exists($filePath)) {
                throw new Exception('File tidak ditemukan setelah upload.');
            }

            $raw = json_decode(file_get_contents($filePath), true);
            Storage::disk('local')->delete('quiz-imports/'.$data['json_file']);
        } else {
            $raw = json_decode($data['json_text'], true);
        }

        if ($raw === null) {
            throw new Exception('Format JSON tidak valid. Periksa sintaks JSON Anda.');
        }

        return $raw;
    }
}
