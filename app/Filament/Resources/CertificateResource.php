<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CertificateResource\Pages\CreateCertificate;
use App\Filament\Resources\CertificateResource\Pages\EditCertificate;
use App\Filament\Resources\CertificateResource\Pages\ListCertificates;
use App\Filament\Resources\CertificateResource\RelationManagers\UsersRelationManager;
use App\Filament\Resources\CertificateResource\Schemas\CertificateForm;
use App\Filament\Resources\CertificateResource\Tables\CertificatesTable;
use App\Models\Certificate\Certificate;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CertificateResource extends Resource
{
    protected static ?string $model = Certificate::class;

    protected static ?string $slug = 'certificates';

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static UnitEnum|string|null $navigationGroup = 'Community';

    protected static ?int $navigationSort = 11;

    protected static ?string $navigationLabel = 'Certificates';

    protected static ?string $modelLabel = 'Certificate';

    protected static ?string $pluralModelLabel = 'Certificates';

    public static function form(Schema $schema): Schema
    {
        return CertificateForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CertificatesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListCertificates::route('/'),
            'create' => CreateCertificate::route('/create'),
            'edit'   => EditCertificate::route('/{record}/edit'),
        ];
    }
}
