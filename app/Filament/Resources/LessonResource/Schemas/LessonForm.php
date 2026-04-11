<?php

namespace App\Filament\Resources\LessonResource\Schemas;

use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LessonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'title')
                    ->required()
                    ->searchable(),
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->maxLength(65535),
                MarkdownEditor::make('content')
                    ->columnSpanFull(),
                TextInput::make('duration')
                    ->numeric()
                    ->default(0)
                    ->required()
                    ->helperText('Duration in minutes'),
                TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->required(),
                Toggle::make('is_published')
                    ->default(true),
            ]);
    }
}
