<?php

namespace App\Filament\Resources\LMS\LessonResource\Pages;

use App\Filament\Resources\LMS\LessonResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListLessons extends ListRecords
{
    protected static string $resource = LessonResource::class;

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
        $categoryId = request()->query('category');

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        return $query;
    }

    private function getCreateUrl(): string
    {
        $url = static::$resource::getUrl('create');
        $categoryId = request()->query('category');

        if ($categoryId) {
            $url .= '?category='.$categoryId;
        }

        return $url;
    }
}
