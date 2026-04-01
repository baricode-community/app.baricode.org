<?php

namespace App\Filament\Resources\CheatSheetResource\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CheatSheetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('cheat_sheet_category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('description')
                    ->maxLength(500)
                    ->columnSpanFull(),
                Textarea::make('content')
                    ->required()
                    ->rows(16)
                    ->columnSpanFull(),
                Toggle::make('is_public')
                    ->label('Tampilkan ke publik')
                    ->default(true),
            ]);
    }
}
