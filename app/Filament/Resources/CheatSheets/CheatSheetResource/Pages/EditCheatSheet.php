<?php

namespace App\Filament\Resources\CheatSheets\CheatSheetResource\Pages;

use App\Filament\Resources\CheatSheets\CheatSheetResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCheatSheet extends EditRecord
{
    protected static string $resource = CheatSheetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
