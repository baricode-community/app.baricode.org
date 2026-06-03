<?php

namespace App\Filament\Resources\Academy\AcademyProgramResource\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AcademyProgramForm
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

            FileUpload::make('thumbnail')
                ->label('Thumbnail')
                ->image()
                ->disk('s3')
                ->directory('academy/thumbnails')
                ->columnSpanFull(),

            Toggle::make('is_published')
                ->label('Tampilkan ke Publik')
                ->default(false),
        ]);
    }
}
