<?php

namespace App\Filament\Resources\RepoHub\RepoHubResource\Pages;

use App\Filament\Resources\RepoHub\RepoHubResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRepoHub extends EditRecord
{
    protected static string $resource = RepoHubResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
