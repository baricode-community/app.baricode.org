<?php

namespace App\Filament\Resources\CheatSheetCategoryResource\Pages;

use App\Filament\Resources\CheatSheetCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCheatSheetCategory extends EditRecord
{
    protected static string $resource = CheatSheetCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
