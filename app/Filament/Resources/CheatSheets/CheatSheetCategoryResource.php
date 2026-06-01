<?php

namespace App\Filament\Resources\CheatSheets;

use App\Filament\Resources\CheatSheets\CheatSheetCategoryResource\Pages\CreateCheatSheetCategory;
use App\Filament\Resources\CheatSheets\CheatSheetCategoryResource\Pages\EditCheatSheetCategory;
use App\Filament\Resources\CheatSheets\CheatSheetCategoryResource\Pages\ListCheatSheetCategories;
use App\Filament\Resources\CheatSheets\CheatSheetCategoryResource\Schemas\CheatSheetCategoryForm;
use App\Filament\Resources\CheatSheets\CheatSheetCategoryResource\Tables\CheatSheetCategoryTable;
use App\Models\CheatSheetCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CheatSheetCategoryResource extends Resource
{
    protected static ?string $model = CheatSheetCategory::class;

    protected static ?string $slug = 'cheat-sheet-categories';

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedTag;

    protected static UnitEnum|string|null $navigationGroup = 'Community';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'CS Categories';

    public static function form(Schema $schema): Schema
    {
        return CheatSheetCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CheatSheetCategoryTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListCheatSheetCategories::route('/'),
            'create' => CreateCheatSheetCategory::route('/create'),
            'edit'   => EditCheatSheetCategory::route('/{record}/edit'),
        ];
    }
}
