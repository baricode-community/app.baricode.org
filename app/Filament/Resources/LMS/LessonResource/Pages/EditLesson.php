<?php

namespace App\Filament\Resources\LMS\LessonResource\Pages;

use App\Filament\Resources\LMS\CategoryResource;
use App\Filament\Resources\LMS\CourseResource;
use App\Filament\Resources\LMS\LessonResource;
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
                ->url(CategoryResource::getUrl('edit', ['record' => $this->record->category]))
                ->color('info'),
            Action::make('view_category_lessons')
                ->label('Categories')
                ->icon('heroicon-o-list-bullet')
                ->url(LessonResource::getUrl('index').'?category='.$this->record->category_id)
                ->color('gray'),
            DeleteAction::make(),
        ];
    }
}
