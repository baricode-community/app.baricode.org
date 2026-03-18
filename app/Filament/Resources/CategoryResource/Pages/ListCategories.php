<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->url(fn () => $this->getCreateUrl()),
        ];
    }

    protected function getTableQuery(): Builder
    {
        $query = parent::getTableQuery();
        $courseId = request()->query('course');

        if ($courseId) {
            $query->where('course_id', $courseId);
        }

        return $query;
    }

    private function getCreateUrl(): string
    {
        $url = static::$resource::getUrl('create');
        $courseId = request()->query('course');

        if ($courseId) {
            $url .= '?course='.$courseId;
        }

        return $url;
    }
}
