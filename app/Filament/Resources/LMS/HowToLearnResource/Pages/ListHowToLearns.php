<?php

namespace App\Filament\Resources\LMS\HowToLearnResource\Pages;

use App\Filament\Resources\LMS\HowToLearnResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHowToLearns extends ListRecords
{
    protected static string $resource = HowToLearnResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
