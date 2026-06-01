<?php

namespace App\Filament\Resources\Mentoring\MentoringProgramResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProgramSessionsRelationManager extends RelationManager
{
    protected static string $relationship = 'sessions';

    protected static ?string $title = 'Jurnal Sesi';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('session_date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('enrollment.user.name')
                    ->label('Murid')
                    ->searchable(),

                TextColumn::make('topic')
                    ->label('Topik')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('notes')
                    ->label('Catatan')
                    ->wrap()
                    ->limit(80)
                    ->toggleable(),

                TextColumn::make('tasks')
                    ->label('Tugas')
                    ->wrap()
                    ->limit(60)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('next_session_date')
                    ->label('Sesi Berikutnya')
                    ->date('d M Y')
                    ->placeholder('—')
                    ->toggleable(),
            ])
            ->defaultSort('session_date', 'desc');
    }
}
