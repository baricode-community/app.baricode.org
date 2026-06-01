<?php

namespace App\Filament\Resources\RepoHub\RepoHubResource\Tables;

use App\Enums\RepoHub\RepoHubStatus;
use App\Models\RepoHub\RepoHub;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
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

                TextColumn::make('submitter.name')
                    ->label('Submitted By')
                    ->placeholder('Admin')
                    ->searchable()
                    ->toggleable(),

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

                BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (RepoHubStatus $state) => $state->label())
                    ->color(fn (RepoHubStatus $state) => $state->color()),

                IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(collect(RepoHubStatus::cases())->mapWithKeys(
                        fn (RepoHubStatus $s) => [$s->value => $s->label()]
                    ))
                    ->default(RepoHubStatus::Pending->value),

                TernaryFilter::make('is_published')
                    ->label('Published'),
            ])
            ->recordActions([
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Approve Submission')
                    ->modalDescription('Repo ini akan dipublikasikan ke RepoHub.')
                    ->visible(fn (RepoHub $record) => $record->isPending())
                    ->action(fn (RepoHub $record) => $record->approve()),

                Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->form([
                        Textarea::make('rejection_note')
                            ->label('Alasan Penolakan')
                            ->required()
                            ->rows(3),
                    ])
                    ->visible(fn (RepoHub $record) => $record->isPending())
                    ->action(fn (RepoHub $record, array $data) => $record->reject($data['rejection_note'])),

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
