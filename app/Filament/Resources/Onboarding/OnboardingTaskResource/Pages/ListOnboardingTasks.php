<?php

namespace App\Filament\Resources\Onboarding\OnboardingTaskResource\Pages;

use App\Filament\Resources\Onboarding\OnboardingTaskResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOnboardingTasks extends ListRecords
{
    protected static string $resource = OnboardingTaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
