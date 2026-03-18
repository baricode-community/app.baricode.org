<?php

namespace App\Filament\Resources\LessonResource\Pages;

use App\Filament\Resources\LessonResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListLessons extends ListRecords
{
    protected static string $resource = LessonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make()
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
            $url .= '?category=' . $categoryId;
        }
        
        return $url;
    }
}
