<?php

namespace App\Filament\Resources\Academy\AcademyBatchResource\Pages;

use App\Filament\Resources\Academy\AcademyBatchResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAcademyBatch extends EditRecord
{
    protected static string $resource = AcademyBatchResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
