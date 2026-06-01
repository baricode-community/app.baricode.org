<?php

namespace App\Filament\Resources\LMS;

use App\Filament\Resources\LMS\CategoryProgressResource\Pages\ListCategoryProgress;
use App\Filament\Resources\LMS\CategoryProgressResource\Tables\CategoryProgressTable;
use App\Models\LMS\CategoryProgress;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CategoryProgressResource extends Resource
{
    protected static ?string $model = CategoryProgress::class;

    protected static ?string $slug = 'category-progress';

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedCheckCircle;

    protected static UnitEnum|string|null $navigationGroup = 'Enrollment';

    protected static ?string $navigationLabel = 'Category Progress';

    protected static ?int $navigationSort = 2;

    public static function table(Table $table): Table
    {
        return CategoryProgressTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCategoryProgress::route('/'),
        ];
    }
}
