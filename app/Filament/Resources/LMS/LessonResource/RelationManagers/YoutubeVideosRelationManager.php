<?php

namespace App\Filament\Resources\LMS\LessonResource\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class YoutubeVideosRelationManager extends RelationManager
{
    protected static string $relationship = 'youtubeVideos';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                TextInput::make('youtube_url')
                    ->label('YouTube URL')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Paste the full YouTube URL (e.g., https://www.youtube.com/watch?v=...)'),
                Textarea::make('description')
                    ->maxLength(1000),
                TextInput::make('order')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_published')
                    ->default(true),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('youtube_url')
                    ->label('URL')
                    ->limit(50),
                TextColumn::make('order')
                    ->sortable(),
                IconColumn::make('is_published')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                CreateAction::make(),
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order');
    }
}
