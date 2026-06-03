<?php

namespace App\Filament\Resources\Academy\AcademyBatchResource\Pages;

use App\Filament\Resources\Academy\AcademyBatchResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAcademyBatches extends ListRecords
{
    protected static string $resource = AcademyBatchResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
