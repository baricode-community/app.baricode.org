<?php

namespace App\Filament\Resources\Academy\AcademyProgramResource\Pages;

use App\Filament\Resources\Academy\AcademyProgramResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAcademyProgram extends EditRecord
{
    protected static string $resource = AcademyProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
