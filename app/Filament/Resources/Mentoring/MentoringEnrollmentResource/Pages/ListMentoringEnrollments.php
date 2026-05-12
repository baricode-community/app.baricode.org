<?php

namespace App\Filament\Resources\Mentoring\MentoringEnrollmentResource\Pages;

use App\Enums\Mentoring\MentoringEnrollmentStatus;
use App\Filament\Resources\Mentoring\MentoringEnrollmentResource;
use App\Models\Mentoring\MentoringProgram;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Pages\ListRecords;

class ListMentoringEnrollments extends ListRecords
{
    protected static string $resource = MentoringEnrollmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('enroll_user')
                ->label('Tambah Murid')
                ->icon('heroicon-o-user-plus')
                ->color('primary')
                ->form([
                    Select::make('user_id')
                        ->label('Murid')
                        ->searchable()
                        ->required()
                        ->getSearchResultsUsing(fn (string $search) => User::query()
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere('username', 'like', "%{$search}%")
                            ->limit(20)
                            ->pluck('name', 'id')
                        )
                        ->getOptionLabelUsing(fn ($value) => User::find($value)?->name),

                    Select::make('mentoring_program_id')
                        ->label('Program Bimbingan')
                        ->required()
                        ->options(MentoringProgram::query()->pluck('title', 'id')),

                    Textarea::make('goal_notes')
                        ->label('Catatan / Tujuan Murid')
                        ->placeholder('Apa yang ingin dicapai murid ini?')
                        ->rows(3)
                        ->columnSpanFull(),
                ])
                ->action(function (array $data) {
                    \App\Models\Mentoring\MentoringEnrollment::create([
                        'user_id' => $data['user_id'],
                        'mentoring_program_id' => $data['mentoring_program_id'],
                        'goal_notes' => $data['goal_notes'] ?? null,
                        'status' => MentoringEnrollmentStatus::Active,
                        'started_at' => now(),
                    ]);
                }),
        ];
    }
}
