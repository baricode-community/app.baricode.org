<?php

namespace App\Filament\Resources\CheatSheets;

use App\Filament\Resources\CheatSheets\CheatSheetResource\Pages\CreateCheatSheet;
use App\Filament\Resources\CheatSheets\CheatSheetResource\Pages\EditCheatSheet;
use App\Filament\Resources\CheatSheets\CheatSheetResource\Pages\ListCheatSheets;
use App\Filament\Resources\CheatSheets\CheatSheetResource\Schemas\CheatSheetForm;
use App\Filament\Resources\CheatSheets\CheatSheetResource\Tables\CheatSheetsTable;
use App\Models\CheatSheet;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CheatSheetResource extends Resource
{
    protected static ?string $model = CheatSheet::class;

    protected static ?string $slug = 'cheat-sheets';

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static UnitEnum|string|null $navigationGroup = 'Community';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Cheat Sheets';

    public static function form(Schema $schema): Schema
    {
        return CheatSheetForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CheatSheetsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListCheatSheets::route('/'),
            'create' => CreateCheatSheet::route('/create'),
            'edit'   => EditCheatSheet::route('/{record}/edit'),
        ];
    }
}
