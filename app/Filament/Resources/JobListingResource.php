<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobListingResource\Pages\CreateJobListing;
use App\Filament\Resources\JobListingResource\Pages\EditJobListing;
use App\Filament\Resources\JobListingResource\Pages\ListJobListings;
use App\Filament\Resources\JobListingResource\Schemas\JobListingForm;
use App\Filament\Resources\JobListingResource\Tables\JobListingsTable;
use App\Models\JobBoard\JobListing;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class JobListingResource extends Resource
{
    protected static ?string $model = JobListing::class;

    protected static ?string $slug = 'job-listings';

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedBriefcase;

    protected static UnitEnum|string|null $navigationGroup = 'Community';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Job Board';

    protected static ?string $modelLabel = 'Lowongan';

    protected static ?string $pluralModelLabel = 'Lowongan Kerja';

    public static function form(Schema $schema): Schema
    {
        return JobListingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JobListingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListJobListings::route('/'),
            'create' => CreateJobListing::route('/create'),
            'edit' => EditJobListing::route('/{record}/edit'),
        ];
    }
}
