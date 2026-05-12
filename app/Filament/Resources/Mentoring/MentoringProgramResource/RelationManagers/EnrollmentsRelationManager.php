<?php

namespace App\Filament\Resources\Mentoring\MentoringProgramResource\RelationManagers;

use App\Enums\Mentoring\MentoringEnrollmentStatus;
use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EnrollmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'enrollments';

    protected static ?string $recordTitleAttribute = 'user.name';

    public function form(Schema $schema): Schema
    {
        return $schema->schema([
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
                ->getOptionLabelUsing(fn ($value) => User::find($value)?->name)
                ->columnSpanFull(),

            Textarea::make('goal_notes')
                ->label('Catatan / Tujuan Murid')
                ->placeholder('Apa yang ingin dicapai murid ini?')
                ->rows(3)
                ->columnSpanFull(),
        ]);
    }

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
            ->defaultSort('created_at', 'desc')
            ->headerActions([
                CreateAction::make()
                    ->label('Tambah Murid')
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['status'] = MentoringEnrollmentStatus::Active;
                        $data['started_at'] = now();
                        return $data;
                    }),
            ]);
    }
}
