<?php

namespace App\Filament\Resources\CheatSheetCategoryResource\Pages;

use App\Filament\Resources\CheatSheetCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCheatSheetCategories extends ListRecords
{
    protected static string $resource = CheatSheetCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
