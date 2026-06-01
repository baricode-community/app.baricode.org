<?php

namespace App\Filament\Resources\LMS\CourseResource\Pages;

use App\Filament\Resources\LMS\CourseResource;
use App\Filament\Resources\LMS\CourseResource\Actions\ImportCoursesAction;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCourses extends ListRecords
{
    protected static string $resource = CourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ImportCoursesAction::make('import'),
            CreateAction::make(),
        ];
    }
}
