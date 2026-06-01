<?php

namespace App\Filament\Resources\Onboarding;

use App\Filament\Resources\Onboarding\OnboardingTaskResource\Pages\CreateOnboardingTask;
use App\Filament\Resources\Onboarding\OnboardingTaskResource\Pages\EditOnboardingTask;
use App\Filament\Resources\Onboarding\OnboardingTaskResource\Pages\ListOnboardingTasks;
use App\Filament\Resources\Onboarding\OnboardingTaskResource\Schemas\OnboardingTaskForm;
use App\Filament\Resources\Onboarding\OnboardingTaskResource\Tables\OnboardingTasksTable;
use App\Models\Onboarding\OnboardingTask;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class OnboardingTaskResource extends Resource
{
    protected static ?string $model = OnboardingTask::class;

    protected static ?string $slug = 'onboarding-tasks';

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static UnitEnum|string|null $navigationGroup = 'Community';

    protected static ?int $navigationSort = 10;

    protected static ?string $navigationLabel = 'Onboarding Tasks';

    protected static ?string $modelLabel = 'Onboarding Task';

    protected static ?string $pluralModelLabel = 'Onboarding Tasks';

    public static function form(Schema $schema): Schema
    {
        return OnboardingTaskForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OnboardingTasksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListOnboardingTasks::route('/'),
            'create' => CreateOnboardingTask::route('/create'),
            'edit'   => EditOnboardingTask::route('/{record}/edit'),
        ];
    }
}
