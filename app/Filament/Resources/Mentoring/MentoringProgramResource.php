<?php

namespace App\Filament\Resources\Mentoring;

use App\Filament\Resources\Mentoring\MentoringProgramResource\Pages\CreateMentoringProgram;
use App\Filament\Resources\Mentoring\MentoringProgramResource\Pages\EditMentoringProgram;
use App\Filament\Resources\Mentoring\MentoringProgramResource\Pages\ListMentoringPrograms;
use App\Filament\Resources\Mentoring\MentoringProgramResource\Pages\ViewMentoringProgram;
use App\Filament\Resources\Mentoring\MentoringProgramResource\RelationManagers\EnrollmentsRelationManager;
use App\Filament\Resources\Mentoring\MentoringProgramResource\RelationManagers\ProgramSessionsRelationManager;
use App\Filament\Resources\Mentoring\MentoringProgramResource\Schemas\MentoringProgramForm;
use App\Filament\Resources\Mentoring\MentoringProgramResource\Tables\MentoringProgramsTable;
use App\Models\Mentoring\MentoringProgram;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MentoringProgramResource extends Resource
{
    protected static ?string $model = MentoringProgram::class;

    protected static ?string $slug = 'mentoring-programs';

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static UnitEnum|string|null $navigationGroup = 'Mentoring';

    protected static ?string $navigationLabel = 'Program Bimbingan';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return MentoringProgramForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MentoringProgramsTable::configure($table);
    }

    public static function getRelationManagers(): array
    {
        return [
            EnrollmentsRelationManager::class,
            ProgramSessionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMentoringPrograms::route('/'),
            'create' => CreateMentoringProgram::route('/create'),
            'view' => ViewMentoringProgram::route('/{record}'),
            'edit' => EditMentoringProgram::route('/{record}/edit'),
        ];
    }
}
