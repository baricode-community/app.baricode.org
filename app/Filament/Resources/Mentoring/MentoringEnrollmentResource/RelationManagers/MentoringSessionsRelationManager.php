<?php

namespace App\Filament\Resources\Mentoring\MentoringEnrollmentResource\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MentoringSessionsRelationManager extends RelationManager
{
    protected static string $relationship = 'sessions';

    protected static ?string $recordTitleAttribute = 'topic';

    public function form(Schema $schema): Schema
    {
        return $schema->schema([
            DatePicker::make('session_date')
                ->label('Tanggal Sesi')
                ->required()
                ->default(today()),

            TextInput::make('topic')
                ->label('Topik')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),

            Textarea::make('notes')
                ->label('Catatan Sesi')
                ->placeholder('Apa yang sudah dipahami? Poin penting yang dibahas...')
                ->rows(3)
                ->columnSpanFull(),

            Textarea::make('tasks')
                ->label('Tugas / PR')
                ->placeholder('Tugas yang harus dikerjakan sebelum sesi berikutnya...')
                ->rows(3)
                ->columnSpanFull(),

            DatePicker::make('next_session_date')
                ->label('Tanggal Sesi Berikutnya'),

            Textarea::make('next_session_plan')
                ->label('Rencana Sesi Berikutnya')
                ->placeholder('Topik yang akan dibahas di sesi berikutnya...')
                ->rows(2)
                ->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('session_date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('topic')
                    ->label('Topik')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('tasks')
                    ->label('Tugas')
                    ->wrap()
                    ->limit(60)
                    ->toggleable(),

                TextColumn::make('next_session_date')
                    ->label('Sesi Ke-2')
                    ->date('d M Y')
                    ->placeholder('—'),
            ])
            ->defaultSort('session_date', 'asc')
            ->headerActions([
                CreateAction::make()->label('+ Tambah Sesi'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
