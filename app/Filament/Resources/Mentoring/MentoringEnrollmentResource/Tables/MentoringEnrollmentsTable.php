<?php

namespace App\Filament\Resources\Mentoring\MentoringEnrollmentResource\Tables;

use App\Enums\Mentoring\MentoringEnrollmentStatus;
use App\Models\Mentoring\MentoringEnrollment;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MentoringEnrollmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Murid')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user.username')
                    ->label('Username')
                    ->searchable(),

                TextColumn::make('program.title')
                    ->label('Program')
                    ->searchable()
                    ->sortable(),

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
                    ->sortable()
                    ->placeholder('—'),

                TextColumn::make('created_at')
                    ->label('Daftar')
                    ->date('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(collect(MentoringEnrollmentStatus::cases())->mapWithKeys(
                        fn (MentoringEnrollmentStatus $s) => [$s->value => $s->label()]
                    ))
                    ->default(MentoringEnrollmentStatus::Pending->value),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Setujui Bimbingan')
                    ->modalDescription('Murid akan aktif mengikuti program bimbingan ini.')
                    ->visible(fn (MentoringEnrollment $record) => $record->isPending())
                    ->action(function (MentoringEnrollment $record) {
                        $record->update([
                            'status' => MentoringEnrollmentStatus::Active,
                            'started_at' => now(),
                        ]);
                    }),

                Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->form([
                        Textarea::make('rejection_reason')
                            ->label('Alasan Penolakan')
                            ->required(),
                    ])
                    ->visible(fn (MentoringEnrollment $record) => $record->isPending())
                    ->action(function (MentoringEnrollment $record, array $data) {
                        $record->update([
                            'status' => MentoringEnrollmentStatus::Dropped,
                            'rejection_reason' => $data['rejection_reason'],
                        ]);
                    }),

                Action::make('complete')
                    ->label('Tandai Selesai')
                    ->icon('heroicon-o-academic-cap')
                    ->color('info')
                    ->requiresConfirmation()
                    ->modalHeading('Tandai Bimbingan Selesai')
                    ->visible(fn (MentoringEnrollment $record) => $record->isActive())
                    ->action(function (MentoringEnrollment $record) {
                        $record->update([
                            'status' => MentoringEnrollmentStatus::Completed,
                            'completed_at' => now(),
                        ]);
                    }),

                Action::make('view')
                    ->label('Lihat Sesi')
                    ->icon('heroicon-o-eye')
                    ->color('gray')
                    ->url(fn (MentoringEnrollment $record) => route('filament.admin.resources.mentoring-enrollments.view', $record)),
            ]);
    }
}
