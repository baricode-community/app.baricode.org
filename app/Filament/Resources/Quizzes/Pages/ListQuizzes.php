<?php

namespace App\Filament\Resources\Quizzes\Pages;

use App\Filament\Resources\Quizzes\Actions\DownloadSampleJsonAction;
use App\Filament\Resources\Quizzes\Actions\ImportQuizAction;
use App\Filament\Resources\Quizzes\QuizResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQuizzes extends ListRecords
{
    protected static string $resource = QuizResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DownloadSampleJsonAction::make('download_sample'),
            ImportQuizAction::make('import_quiz'),
            CreateAction::make(),
        ];
    }
}
