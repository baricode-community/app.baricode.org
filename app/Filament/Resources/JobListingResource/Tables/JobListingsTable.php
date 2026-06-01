<?php

namespace App\Filament\Resources\JobListingResource\Tables;

use App\Enums\JobBoard\JobListingStatus;
use App\Enums\JobBoard\JobType;
use App\Models\JobBoard\JobListing;
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

class JobListingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->description(fn (JobListing $r) => $r->company_name),

                TextColumn::make('poster.name')
                    ->label('Dipost Oleh')
                    ->searchable()
                    ->toggleable(),

                BadgeColumn::make('job_type')
                    ->label('Tipe')
                    ->formatStateUsing(fn (JobType $state) => $state->label())
                    ->color(fn (JobType $state) => $state->color()),

                TextColumn::make('location')
                    ->label('Lokasi')
                    ->searchable(),

                IconColumn::make('is_remote')
                    ->label('Remote')
                    ->boolean(),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (JobListingStatus $state) => $state->label())
                    ->color(fn (JobListingStatus $state) => $state->color()),

                TextColumn::make('views_count')
                    ->label('Views')
                    ->sortable(),

                TextColumn::make('expires_at')
                    ->label('Kadaluarsa')
                    ->dateTime('d M Y')
                    ->placeholder('Tidak ada')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(collect(JobListingStatus::cases())->mapWithKeys(
                        fn (JobListingStatus $s) => [$s->value => $s->label()]
                    ))
                    ->default(JobListingStatus::Pending->value),

                SelectFilter::make('job_type')
                    ->label('Tipe Pekerjaan')
                    ->options(collect(JobType::cases())->mapWithKeys(
                        fn (JobType $t) => [$t->value => $t->label()]
                    )),

                TernaryFilter::make('is_remote')
                    ->label('Remote'),
            ])
            ->recordActions([
                Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Setujui Lowongan')
                    ->modalDescription('Lowongan ini akan dipublikasikan ke Job Board.')
                    ->visible(fn (JobListing $record) => $record->isPending())
                    ->action(fn (JobListing $record) => $record->approve()),

                Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->form([
                        Textarea::make('rejection_note')
                            ->label('Alasan Penolakan')
                            ->required()
                            ->rows(3),
                    ])
                    ->visible(fn (JobListing $record) => $record->isPending())
                    ->action(fn (JobListing $record, array $data) => $record->reject($data['rejection_note'])),

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
