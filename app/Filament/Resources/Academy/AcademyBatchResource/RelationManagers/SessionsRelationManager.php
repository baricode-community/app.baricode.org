<?php

namespace App\Filament\Resources\Academy\AcademyBatchResource\RelationManagers;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SessionsRelationManager extends RelationManager
{
    protected static string $relationship = 'sessions';

    protected static ?string $title = 'Sesi';

    public function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('title')
                ->label('Judul Sesi')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),

            Textarea::make('description')
                ->label('Deskripsi')
                ->rows(2)
                ->columnSpanFull(),

            DateTimePicker::make('scheduled_at')
                ->label('Jadwal')
                ->required(),

            TextInput::make('sort_order')
                ->label('Urutan')
                ->numeric()
                ->default(0),

            TextInput::make('meeting_link')
                ->label('Link Meeting')
                ->url()
                ->placeholder('https://zoom.us/j/...')
                ->columnSpanFull(),

            TextInput::make('youtube_link')
                ->label('Link YouTube (Rekaman)')
                ->url()
                ->placeholder('https://youtube.com/watch?v=...')
                ->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->columns([
                TextColumn::make('sort_order')->label('#')->sortable(),
                TextColumn::make('title')->label('Judul')->searchable(),
                TextColumn::make('scheduled_at')->label('Jadwal')->dateTime('d M Y H:i')->sortable(),
                TextColumn::make('meeting_link')->label('Meeting')->limit(30),
                TextColumn::make('youtube_link')->label('YouTube')->limit(30),
            ])
            ->headerActions([CreateAction::make()])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
