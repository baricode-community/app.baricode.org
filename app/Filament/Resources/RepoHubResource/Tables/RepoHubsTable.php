<?php

namespace App\Filament\Resources\RepoHubResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class RepoHubsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tags.name')
                    ->badge()
                    ->label('Tags')
                    ->color('purple'),

                TextColumn::make('repo_url')
                    ->label('Repository')
                    ->url(fn ($record) => $record->repo_url)
                    ->openUrlInNewTab()
                    ->limit(40)
                    ->searchable(),

                IconColumn::make('demo_url')
                    ->label('Demo')
                    ->boolean()
                    ->getStateUsing(fn ($record) => filled($record->demo_url)),

                IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_published')
                    ->label('Published'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
