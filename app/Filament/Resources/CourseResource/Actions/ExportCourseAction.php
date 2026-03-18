<?php

namespace App\Filament\Resources\CourseResource\Actions;

use App\Models\LMS\Course;
use App\Services\CourseImportExportService;
use Exception;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Response;

class ExportCourseAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Export Course')
            ->icon('heroicon-o-arrow-down-tray')
            ->color('info')
            ->action(function (Course $record) {
                try {
                    $exportService = new CourseImportExportService;
                    $courseData = $exportService->exportCourse($record);

                    $filename = str($record->title)->slug().'_'.now()->format('Y-m-d_His').'.json';
                    $jsonContent = json_encode($courseData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

                    return Response::streamDownload(
                        function () use ($jsonContent) {
                            echo $jsonContent;
                        },
                        $filename,
                        ['Content-Type' => 'application/json']
                    );
                } catch (Exception $e) {
                    Notification::make()
                        ->title('Export Failed')
                        ->body('Error: '.$e->getMessage())
                        ->danger()
                        ->send();

                    return null;
                }
            });
    }
}
