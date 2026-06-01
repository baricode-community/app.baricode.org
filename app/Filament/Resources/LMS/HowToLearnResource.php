<?php

namespace App\Filament\Resources\LMS;

use App\Filament\Resources\LMS\HowToLearnResource\Pages\CreateHowToLearn;
use App\Filament\Resources\LMS\HowToLearnResource\Pages\EditHowToLearn;
use App\Filament\Resources\LMS\HowToLearnResource\Pages\ListHowToLearns;
use App\Filament\Resources\LMS\HowToLearnResource\Schemas\HowToLearnForm;
use App\Filament\Resources\LMS\HowToLearnResource\Tables\HowToLearnsTable;
use App\Models\LMS\HowToLearn;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class HowToLearnResource extends Resource
{
    protected static ?string $model = HowToLearn::class;

    protected static ?string $slug = 'how-to-learns';

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static UnitEnum|string|null $navigationGroup = 'Learning';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationLabel = 'Panduan Belajar';

    protected static ?string $modelLabel = 'Panduan Belajar';

    protected static ?string $pluralModelLabel = 'Panduan Belajar';

    public static function form(Schema $schema): Schema
    {
        return HowToLearnForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HowToLearnsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListHowToLearns::route('/'),
            'create' => CreateHowToLearn::route('/create'),
            'edit'   => EditHowToLearn::route('/{record}/edit'),
        ];
    }
}
