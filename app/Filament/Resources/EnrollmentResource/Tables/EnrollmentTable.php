<?php

namespace App\Filament\Resources\EnrollmentResource\Tables;

use App\Enums\LMS\EnrollmentStatus;
use App\Models\LMS\Enrollment;
use App\Services\LMS\EnrollmentService;
use Filament\Actions\Action;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EnrollmentTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.username')
                    ->label('Username')
                    ->searchable(),
                TextColumn::make('course.title')
                    ->label('Kursus')
                    ->searchable()
                    ->sortable(),
                BadgeColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (EnrollmentStatus $state) => $state->label())
                    ->color(fn (EnrollmentStatus $state) => $state->color()),
                TextColumn::make('created_at')
                    ->label('Tanggal Daftar')
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
                    ->options(collect(EnrollmentStatus::cases())->mapWithKeys(
                        fn (EnrollmentStatus $s) => [$s->value => $s->label()]
                    )),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Setujui Enrollment')
                    ->modalDescription('Siswa akan mendapatkan akses kursus setelah disetujui.')
                    ->visible(fn (Enrollment $record) => $record->status === EnrollmentStatus::Pending)
                    ->action(function (Enrollment $record) {
                        app(EnrollmentService::class)->approveEnrollment($record);
                    }),

                Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->form([
                        \Filament\Forms\Components\Textarea::make('rejection_reason')
                            ->label('Alasan Penolakan')
                            ->required(),
                    ])
                    ->visible(fn (Enrollment $record) => $record->status === EnrollmentStatus::Pending)
                    ->action(function (Enrollment $record, array $data) {
                        app(EnrollmentService::class)->rejectEnrollment($record, $data['rejection_reason']);
                    }),

                Action::make('approve_unenroll')
                    ->label('Setujui Keluar')
                    ->icon('heroicon-o-arrow-right-on-rectangle')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('Setujui Permintaan Keluar')
                    ->modalDescription('Enrollment siswa akan dihapus dari kursus ini.')
                    ->visible(fn (Enrollment $record) => $record->status === EnrollmentStatus::UnenrollRequested)
                    ->action(function (Enrollment $record) {
                        app(EnrollmentService::class)->approveUnenrollment($record);
                    }),

                Action::make('deny_unenroll')
                    ->label('Tolak Keluar')
                    ->icon('heroicon-o-no-symbol')
                    ->color('gray')
                    ->requiresConfirmation()
                    ->modalHeading('Tolak Permintaan Keluar')
                    ->modalDescription('Siswa akan tetap terdaftar aktif di kursus ini.')
                    ->visible(fn (Enrollment $record) => $record->status === EnrollmentStatus::UnenrollRequested)
                    ->action(function (Enrollment $record) {
                        app(EnrollmentService::class)->denyUnenrollRequest($record);
                    }),
            ]);
    }
}
