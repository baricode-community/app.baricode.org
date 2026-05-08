<?php

namespace App\Filament\Resources\Mentoring\MentoringProgramResource\Tables;

use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MentoringProgramsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Program')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('enrollments_count')
                    ->label('Total Murid')
                    ->counts('enrollments')
                    ->sortable(),

                TextColumn::make('active_enrollments_count')
                    ->label('Aktif')
                    ->counts('activeEnrollments')
                    ->badge()
                    ->color('success'),

                BadgeColumn::make('is_open')
                    ->label('Status')
                    ->formatStateUsing(fn (bool $state) => $state ? 'Buka' : 'Tutup')
                    ->color(fn (bool $state) => $state ? 'success' : 'gray'),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
