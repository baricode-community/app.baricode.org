<?php

namespace App\Filament\Resources\RepoHub;

use App\Filament\Resources\RepoHub\RepoHubResource\Pages\CreateRepoHub;
use App\Filament\Resources\RepoHub\RepoHubResource\Pages\EditRepoHub;
use App\Filament\Resources\RepoHub\RepoHubResource\Pages\ListRepoHubs;
use App\Filament\Resources\RepoHub\RepoHubResource\Schemas\RepoHubForm;
use App\Filament\Resources\RepoHub\RepoHubResource\Tables\RepoHubsTable;
use App\Models\RepoHub\RepoHub;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RepoHubResource extends Resource
{
    protected static ?string $model = RepoHub::class;

    protected static ?string $slug = 'repo-hubs';

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedCodeBracket;

    protected static UnitEnum|string|null $navigationGroup = 'Community';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'RepoHub';

    public static function form(Schema $schema): Schema
    {
        return RepoHubForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RepoHubsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRepoHubs::route('/'),
            'create' => CreateRepoHub::route('/create'),
            'edit' => EditRepoHub::route('/{record}/edit'),
        ];
    }
}
