<?php

namespace App\Filament\Resources\Mentoring\MentoringProgramResource\Pages;

use App\Filament\Resources\Mentoring\MentoringProgramResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMentoringPrograms extends ListRecords
{
    protected static string $resource = MentoringProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
