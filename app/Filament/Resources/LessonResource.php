<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LessonResource\Pages\CreateLesson;
use App\Filament\Resources\LessonResource\Pages\EditLesson;
use App\Filament\Resources\LessonResource\Pages\ListLessons;
use App\Filament\Resources\LessonResource\RelationManagers\YoutubeVideosRelationManager;
use App\Filament\Resources\LessonResource\Schemas\LessonForm;
use App\Filament\Resources\LessonResource\Tables\LessonTable;
use App\Models\LMS\Lesson;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $slug = 'lessons';

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static UnitEnum|string|null $navigationGroup = 'Learning';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return LessonForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LessonTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            YoutubeVideosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLessons::route('/'),
            'create' => CreateLesson::route('/create'),
            'edit' => EditLesson::route('/{record}/edit'),
        ];
    }
}
