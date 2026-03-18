<?php

namespace App\Filament\Resources\RepoHubResource\Pages;

use App\Filament\Resources\RepoHubResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRepoHubs extends ListRecords
{
    protected static string $resource = RepoHubResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
