<?php

namespace App\Filament\Resources\Mentoring;

use App\Filament\Resources\Mentoring\MentoringEnrollmentResource\Pages\ListMentoringEnrollments;
use App\Filament\Resources\Mentoring\MentoringEnrollmentResource\Pages\ViewMentoringEnrollment;
use App\Filament\Resources\Mentoring\MentoringEnrollmentResource\RelationManagers\MentoringSessionsRelationManager;
use App\Filament\Resources\Mentoring\MentoringEnrollmentResource\Tables\MentoringEnrollmentsTable;
use App\Models\Mentoring\MentoringEnrollment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MentoringEnrollmentResource extends Resource
{
    protected static ?string $model = MentoringEnrollment::class;

    protected static ?string $slug = 'mentoring-enrollments';

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static UnitEnum|string|null $navigationGroup = 'Mentoring';

    protected static ?string $navigationLabel = 'Murid Bimbingan';

    protected static ?int $navigationSort = 2;

    public static function table(Table $table): Table
    {
        return MentoringEnrollmentsTable::configure($table);
    }

    public static function getRelationManagers(): array
    {
        return [
            MentoringSessionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMentoringEnrollments::route('/'),
            'view' => ViewMentoringEnrollment::route('/{record}'),
        ];
    }
}
