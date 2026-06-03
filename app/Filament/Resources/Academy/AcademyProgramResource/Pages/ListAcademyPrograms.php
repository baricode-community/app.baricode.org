<?php

namespace App\Filament\Resources\Academy\AcademyProgramResource\Pages;

use App\Filament\Resources\Academy\AcademyProgramResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAcademyPrograms extends ListRecords
{
    protected static string $resource = AcademyProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
