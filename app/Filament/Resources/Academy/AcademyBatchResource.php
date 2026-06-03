<?php

namespace App\Filament\Resources\Academy;

use App\Filament\Resources\Academy\AcademyBatchResource\Pages\CreateAcademyBatch;
use App\Filament\Resources\Academy\AcademyBatchResource\Pages\EditAcademyBatch;
use App\Filament\Resources\Academy\AcademyBatchResource\Pages\ListAcademyBatches;
use App\Filament\Resources\Academy\AcademyBatchResource\Pages\ViewAcademyBatch;
use App\Filament\Resources\Academy\AcademyBatchResource\RelationManagers\SessionsRelationManager;
use App\Models\Academy\AcademyBatch;
use BackedEnum;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class AcademyBatchResource extends Resource
{
    protected static ?string $model = AcademyBatch::class;

    protected static ?string $slug = 'academy-batches';

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static UnitEnum|string|null $navigationGroup = 'Academy';

    protected static ?string $navigationLabel = 'Batch';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('academy_program_id')
                ->label('Program')
                ->relationship('program', 'title')
                ->required()
                ->searchable()
                ->preload(),

            TextInput::make('name')
                ->label('Nama Batch')
                ->placeholder('Angkatan 1')
                ->required()
                ->maxLength(255),

            TextInput::make('price')
                ->label('Harga (Rp)')
                ->numeric()
                ->required()
                ->minValue(0),

            TextInput::make('quota')
                ->label('Kuota Peserta')
                ->numeric()
                ->required()
                ->minValue(1),

            Section::make('Jadwal')->schema([
                DateTimePicker::make('registration_open_at')->label('Pendaftaran Dibuka'),
                DateTimePicker::make('registration_close_at')->label('Pendaftaran Ditutup'),
                DateTimePicker::make('start_at')->label('Mulai'),
                DateTimePicker::make('end_at')->label('Selesai'),
            ])->columns(2),

            Toggle::make('is_active')->label('Aktif')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('program.title')->label('Program')->searchable()->sortable(),
                TextColumn::make('name')->label('Batch')->searchable(),
                TextColumn::make('price')->label('Harga')->money('IDR')->sortable(),
                TextColumn::make('enrollments_count')->label('Peserta')->counts('enrollments'),
                TextColumn::make('quota')->label('Kuota'),
                IconColumn::make('is_active')->label('Aktif')->boolean(),
                TextColumn::make('start_at')->label('Mulai')->date('d M Y')->sortable(),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelationManagers(): array
    {
        return [
            SessionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAcademyBatches::route('/'),
            'create' => CreateAcademyBatch::route('/create'),
            'view' => ViewAcademyBatch::route('/{record}'),
            'edit' => EditAcademyBatch::route('/{record}/edit'),
        ];
    }
}
