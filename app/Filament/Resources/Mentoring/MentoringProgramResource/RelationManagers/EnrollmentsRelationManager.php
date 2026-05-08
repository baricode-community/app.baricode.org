<?php

namespace App\Filament\Resources\Mentoring\MentoringProgramResource\RelationManagers;

use App\Enums\Mentoring\MentoringEnrollmentStatus;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EnrollmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'enrollments';

    protected static ?string $recordTitleAttribute = 'user.name';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Murid')
                    ->searchable(),

                TextColumn::make('user.username')
                    ->label('Username')
                    ->searchable(),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (MentoringEnrollmentStatus $state) => $state->label())
                    ->color(fn (MentoringEnrollmentStatus $state) => $state->color()),

                TextColumn::make('sessions_count')
                    ->label('Sesi')
                    ->counts('sessions'),

                TextColumn::make('started_at')
                    ->label('Mulai')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(collect(MentoringEnrollmentStatus::cases())->mapWithKeys(
                        fn (MentoringEnrollmentStatus $s) => [$s->value => $s->label()]
                    )),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
