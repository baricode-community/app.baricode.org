<?php

namespace App\Filament\Resources\Academy\AcademyProgramResource\Tables;

use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AcademyProgramsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('')
                    ->circular()
                    ->defaultImageUrl(fn () => null),

                TextColumn::make('title')
                    ->label('Nama Program')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('batches_count')
                    ->label('Batch')
                    ->counts('batches')
                    ->sortable(),

                IconColumn::make('is_published')
                    ->label('Dipublikasi')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
