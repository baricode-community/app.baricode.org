<?php

namespace App\Filament\Resources\CategoryProgressResource\Tables;

use App\Enums\LMS\CategoryProgressStatus;
use App\Models\LMS\CategoryProgress;
use App\Services\LMS\EnrollmentService;
use Filament\Actions\Action;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CategoryProgressTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('enrollment.user.name')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('enrollment.course.title')
                    ->label('Kursus')
                    ->searchable(),
                TextColumn::make('category.title')
                    ->label('Kategori')
                    ->searchable(),
                BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (CategoryProgressStatus $state) => $state->label())
                    ->color(fn (CategoryProgressStatus $state) => $state->color()),
                TextColumn::make('submitted_at')
                    ->label('Tanggal Diajukan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                TextColumn::make('approved_at')
                    ->label('Tanggal Disetujui')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(collect(CategoryProgressStatus::cases())->mapWithKeys(
                        fn (CategoryProgressStatus $s) => [$s->value => $s->label()]
                    ))
                    ->default(CategoryProgressStatus::Submitted->value),
            ])
            ->defaultSort('submitted_at', 'desc')
            ->recordActions([
                Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Setujui Penyelesaian Kategori')
                    ->modalDescription('Semua lesson dalam kategori ini akan dikunci dan tidak dapat diubah oleh siswa.')
                    ->visible(fn (CategoryProgress $record) => $record->status === CategoryProgressStatus::Submitted)
                    ->action(function (CategoryProgress $record) {
                        app(EnrollmentService::class)->approveCategoryProgress($record, auth()->user());
                    }),

                Action::make('reject')
                    ->label('Tolak / Revisi')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('danger')
                    ->form([
                        \Filament\Forms\Components\Textarea::make('admin_note')
                            ->label('Catatan untuk Siswa')
                            ->placeholder('Jelaskan apa yang perlu diperbaiki...')
                            ->required(),
                    ])
                    ->visible(fn (CategoryProgress $record) => $record->status === CategoryProgressStatus::Submitted)
                    ->action(function (CategoryProgress $record, array $data) {
                        app(EnrollmentService::class)->rejectCategoryProgress($record, auth()->user(), $data['admin_note']);
                    }),
            ]);
    }
}
