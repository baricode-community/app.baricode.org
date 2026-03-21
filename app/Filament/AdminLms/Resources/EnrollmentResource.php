<?php

namespace App\Filament\AdminLms\Resources;

use App\Filament\AdminLms\Resources\EnrollmentResource\Pages\ListEnrollments;
use App\Filament\AdminLms\Resources\EnrollmentResource\Tables\EnrollmentTable;
use App\Models\LMS\Enrollment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class EnrollmentResource extends Resource
{
    protected static ?string $model = Enrollment::class;

    protected static ?string $slug = 'enrollments';

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static UnitEnum|string|null $navigationGroup = 'Enrollment';

    protected static ?string $navigationLabel = 'Enrollments';

    protected static ?int $navigationSort = 1;

    public static function table(Table $table): Table
    {
        return EnrollmentTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEnrollments::route('/'),
        ];
    }
}
