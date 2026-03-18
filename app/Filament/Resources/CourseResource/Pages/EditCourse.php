<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CategoryResource;
use App\Filament\Resources\CourseResource;
use App\Filament\Resources\CourseResource\Actions\ExportCourseAction;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditCourse extends EditRecord
{
    protected static string $resource = CourseResource::class;

    public function getTitle(): string|Htmlable
    {
        return 'Edit Course: '.$this->record->title;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('view_categories')
                ->label('Categories')
                ->icon('heroicon-o-list-bullet')
                ->url(CategoryResource::getUrl('index', ['course' => $this->record->id]))
                ->color('info'),
            ExportCourseAction::make('export'),
            DeleteAction::make(),
        ];
    }

    public function getRelationManagers(): array
    {
        return [
            // Relation managers for nested resources
        ];
    }
}
