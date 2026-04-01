<?php

namespace App\Filament\Resources\Memes\Pages;

use App\Filament\Resources\Memes\MemeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMeme extends ViewRecord
{
    protected static string $resource = MemeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
