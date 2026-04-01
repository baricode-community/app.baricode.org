<?php

namespace App\Filament\Resources\CheatSheetResource\Pages;

use App\Filament\Resources\CheatSheetResource;
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
