<?php

namespace App\Filament\Resources\Quizzes\Actions;

use App\Services\QuizImportExportService;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Response;

class DownloadSampleJsonAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Download Contoh JSON')
            ->icon('heroicon-o-document-arrow-down')
            ->color('gray')
            ->action(function () {
                $service = new QuizImportExportService;
                $json = json_encode($service->sampleJson(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

                return Response::streamDownload(
                    function () use ($json) {
                        echo $json;
                    },
                    'contoh-import-quiz.json',
                    ['Content-Type' => 'application/json']
                );
            });
    }
}
