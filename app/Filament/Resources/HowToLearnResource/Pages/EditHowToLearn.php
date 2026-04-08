<?php

namespace App\Filament\Resources\HowToLearnResource\Pages;

use App\Filament\Resources\HowToLearnResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHowToLearn extends EditRecord
{
    protected static string $resource = HowToLearnResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
