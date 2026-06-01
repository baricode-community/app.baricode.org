<?php

namespace App\Filament\Resources\LMS\CourseResource\Actions;

use App\Services\CourseImportExportService;
use Exception;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

class ImportCoursesAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Import Course')
            ->icon('heroicon-o-arrow-up-tray')
            ->color('success')
            ->form([
                FileUpload::make('json_file')
                    ->label('JSON File (or paste JSON below)')
                    ->acceptedFileTypes(['application/json'])
                    ->directory('course-imports')
                    ->visibility('private')
                    ->helperText('Upload a JSON file containing the course data'),

                Textarea::make('json_text')
                    ->label('JSON Data (paste here if not uploading file)')
                    ->rows(10)
                    ->helperText('Paste your JSON data here if you did not upload a file above'),
            ])
            ->action(function (array $data) {
                try {
                    $importService = new CourseImportExportService;

                    // Get JSON data from file or textarea
                    $jsonData = null;

                    if (! empty($data['json_file'])) {
                        $filePath = Storage::disk('local')->path('course-imports/'.$data['json_file']);
                        if (! file_exists($filePath)) {
                            throw new Exception('File not found: '.$filePath);
                        }
                        $jsonData = json_decode(file_get_contents($filePath), true);
                        // Clean up the file after import
                        Storage::disk('local')->delete('course-imports/'.$data['json_file']);
                    } elseif (! empty($data['json_text'])) {
                        $jsonData = json_decode($data['json_text'], true);
                    }

                    if (empty($data['json_file']) && empty($data['json_text'])) {
                        throw new Exception('Please provide either a JSON file or paste JSON data');
                    }

                    if ($jsonData === null) {
                        throw new Exception('Invalid JSON format. Please check your JSON syntax.');
                    }

                    // Import course
                    $course = $importService->importCourse($jsonData);

                    Notification::make()
                        ->title('Success!')
                        ->body("Course '{$course->title}' imported successfully with ".count($course->categories).' categories.')
                        ->success()
                        ->send();
                } catch (Exception $e) {
                    Notification::make()
                        ->title('Import Failed')
                        ->body('Error: '.$e->getMessage())
                        ->danger()
                        ->send();
                }
            });
    }
}
