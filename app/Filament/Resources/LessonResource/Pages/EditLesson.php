<?php

namespace App\Filament\Resources\LessonResource\Pages;

use App\Filament\Resources\CategoryResource;
use App\Filament\Resources\CourseResource;
use App\Filament\Resources\LessonResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLesson extends EditRecord
{
    protected static string $resource = LessonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('view_course')
                ->label('Course')
                ->icon('heroicon-o-book-open')
                ->url(CourseResource::getUrl('edit', ['record' => $this->record->category->course_id]))
                ->color('info'),
            Action::make('view_category')
                ->label('Category')
                ->icon('heroicon-o-tag')
                ->url(CategoryResource::getUrl('edit', ['record' => $this->record->category_id]))
                ->color('info'),
            DeleteAction::make(),
        ];
    }
}
