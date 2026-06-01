<?php

namespace App\Filament\Resources\LMS;

use App\Filament\Resources\LMS\CategoryResource\Pages\CreateCategory;
use App\Filament\Resources\LMS\CategoryResource\Pages\EditCategory;
use App\Filament\Resources\LMS\CategoryResource\Pages\ListCategories;
use App\Filament\Resources\LMS\CategoryResource\Schemas\CategoryForm;
use App\Filament\Resources\LMS\CategoryResource\Tables\CategoryTable;
use App\Models\LMS\CourseCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CategoryResource extends Resource
{
    protected static ?string $model = CourseCategory::class;

    protected static ?string $slug = 'categories';

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedCircleStack;

    protected static UnitEnum|string|null $navigationGroup = 'Learning';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return CategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoryTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
}
