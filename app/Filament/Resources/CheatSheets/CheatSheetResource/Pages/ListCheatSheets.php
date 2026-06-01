<?php

namespace App\Filament\Resources\CheatSheets\CheatSheetResource\Pages;

use App\Filament\Resources\CheatSheets\CheatSheetResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCheatSheets extends ListRecords
{
    protected static string $resource = CheatSheetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
