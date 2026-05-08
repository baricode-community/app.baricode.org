<?php

namespace App\Filament\Resources\Mentoring\MentoringProgramResource\Pages;

use App\Filament\Resources\Mentoring\MentoringProgramResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMentoringProgram extends EditRecord
{
    protected static string $resource = MentoringProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
