<?php

namespace App\Filament\Resources\Academy\AcademyProgramResource\Pages;

use App\Filament\Resources\Academy\AcademyProgramResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAcademyProgram extends ViewRecord
{
    protected static string $resource = AcademyProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make()];
    }
}
