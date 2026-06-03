<?php

namespace App\Filament\Resources\Academy;

use App\Filament\Resources\Academy\AcademyProgramResource\Pages\CreateAcademyProgram;
use App\Filament\Resources\Academy\AcademyProgramResource\Pages\EditAcademyProgram;
use App\Filament\Resources\Academy\AcademyProgramResource\Pages\ListAcademyPrograms;
use App\Filament\Resources\Academy\AcademyProgramResource\Pages\ViewAcademyProgram;
use App\Filament\Resources\Academy\AcademyProgramResource\RelationManagers\BatchesRelationManager;
use App\Filament\Resources\Academy\AcademyProgramResource\Schemas\AcademyProgramForm;
use App\Filament\Resources\Academy\AcademyProgramResource\Tables\AcademyProgramsTable;
use App\Models\Academy\AcademyProgram;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AcademyProgramResource extends Resource
{
    protected static ?string $model = AcademyProgram::class;

    protected static ?string $slug = 'academy-programs';

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static UnitEnum|string|null $navigationGroup = 'Academy';

    protected static ?string $navigationLabel = 'Program';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return AcademyProgramForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AcademyProgramsTable::configure($table);
    }

    public static function getRelationManagers(): array
    {
        return [
            BatchesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAcademyPrograms::route('/'),
            'create' => CreateAcademyProgram::route('/create'),
            'view' => ViewAcademyProgram::route('/{record}'),
            'edit' => EditAcademyProgram::route('/{record}/edit'),
        ];
    }
}
