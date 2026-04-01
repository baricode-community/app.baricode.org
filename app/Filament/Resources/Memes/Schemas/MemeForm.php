<?php

namespace App\Filament\Resources\Memes\Schemas;

use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MemeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Meme')
                    ->columns(1)
                    ->schema([
                        Select::make('user_id')
                            ->label('Pemilik Meme')
                            ->relationship('user', 'name')
                            ->options(
                                User::query()
                                    ->orderBy('name')
                                    ->pluck('name', 'id')
                            )
                            ->searchable()
                            ->preload()
                            ->required()
                            ->helperText('Pilih user atas nama siapa meme ini dibuat.'),
                        Textarea::make('caption')
                            ->label('Caption')
                            ->maxLength(255)
                            ->rows(3)
                            ->nullable(),
                    ]),

                Section::make('Gambar')
                    ->columns(1)
                    ->schema([
                        FileUpload::make('image_path')
                            ->label('Gambar Meme')
                            ->image()
                            ->directory('memes')
                            ->imageResizeMode('contain')
                            ->maxSize(5120)
                            ->helperText('Format: JPG, PNG, GIF, WebP. Maksimal 5MB.')
                            ->nullable(),
                    ]),
            ]);
    }
}
