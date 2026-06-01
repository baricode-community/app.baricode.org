<?php

namespace App\Filament\Resources\LMS\CategoryResource\Schemas;

use App\Models\Quiz\Quiz;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('course_id')
                    ->relationship('course', 'title')
                    ->required()
                    ->searchable(),
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->columnSpanFull()
                    ->maxLength(65535),
                TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->required(),
                Toggle::make('is_published')
                    ->default(true),
                Select::make('quiz_id')
                    ->label('Quiz Syarat Kelulusan')
                    ->options(Quiz::where('is_active', true)->pluck('title', 'id'))
                    ->searchable()
                    ->nullable()
                    ->live()
                    ->helperText('Opsional. Jika diisi, user harus menyelesaikan quiz ini sebelum dapat mengajukan approval.'),
                TextInput::make('passing_score')
                    ->label('Nilai Minimum Kelulusan')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->suffix('%')
                    ->nullable()
                    ->visible(fn ($get) => filled($get('quiz_id')))
                    ->helperText('Nilai minimum (0–100) yang harus dicapai. Kosongkan untuk tidak ada batas minimum.'),
            ]);
    }
}
