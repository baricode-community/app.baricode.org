<?php

namespace App\Filament\Resources\Academy\AcademyProgramResource\RelationManagers;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BatchesRelationManager extends RelationManager
{
    protected static string $relationship = 'batches';

    protected static ?string $title = 'Batch';

    public function form(Schema $schema): Schema
    {
        return $schema->schema([
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

            Toggle::make('is_active')
                ->label('Aktif')
                ->default(true),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Batch')->searchable(),
                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('enrollments_count')
                    ->label('Peserta')
                    ->counts('enrollments'),
                TextColumn::make('quota')->label('Kuota'),
                IconColumn::make('is_active')->label('Aktif')->boolean(),
                TextColumn::make('start_at')->label('Mulai')->date('d M Y'),
            ])
            ->headerActions([CreateAction::make()])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
