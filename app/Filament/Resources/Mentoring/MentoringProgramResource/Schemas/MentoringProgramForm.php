<?php

namespace App\Filament\Resources\Mentoring\MentoringProgramResource\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MentoringProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('title')
                ->label('Nama Program')
                ->required()
                ->maxLength(255)
                ->columnSpanFull(),

            Textarea::make('description')
                ->label('Deskripsi')
                ->rows(3)
                ->columnSpanFull(),

            Textarea::make('goals')
                ->label('Target / Goals')
                ->placeholder('Apa yang akan bisa dilakukan murid setelah program ini selesai?')
                ->rows(3)
                ->columnSpanFull(),

            Toggle::make('is_open')
                ->label('Menerima Murid Baru')
                ->default(true),
        ]);
    }
}
