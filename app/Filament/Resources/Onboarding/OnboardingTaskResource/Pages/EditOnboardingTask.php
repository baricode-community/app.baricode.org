<?php

namespace App\Filament\Resources\Onboarding\OnboardingTaskResource\Pages;

use App\Filament\Resources\Onboarding\OnboardingTaskResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOnboardingTask extends EditRecord
{
    protected static string $resource = OnboardingTaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
