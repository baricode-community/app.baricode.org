<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use App\Filament\Resources\LessonResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('view_lessons')
                ->label('Lessons')
                ->icon('heroicon-o-rectangle-stack')
                ->url(LessonResource::getUrl('index', ['category' => $this->record->id]))
                ->color('info'),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
