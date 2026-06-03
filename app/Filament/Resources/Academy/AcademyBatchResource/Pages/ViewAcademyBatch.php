<?php

namespace App\Filament\Resources\Academy\AcademyBatchResource\Pages;

use App\Filament\Resources\Academy\AcademyBatchResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAcademyBatch extends ViewRecord
{
    protected static string $resource = AcademyBatchResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make()];
    }
}
