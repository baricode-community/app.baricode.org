<?php

namespace App\Filament\Resources\HowToLearnResource\Schemas;

use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class HowToLearnForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->label('Judul Panduan'),

                Textarea::make('description')
                    ->rows(3)
                    ->maxLength(500)
                    ->columnSpanFull()
                    ->label('Deskripsi Singkat'),

                MarkdownEditor::make('content')
                    ->required()
                    ->columnSpanFull()
                    ->label('Konten (Markdown)')
                    ->toolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'heading',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'table',
                        'undo',
                    ]),

                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->helperText('Hanya panduan aktif yang akan ditampilkan ke pengguna.'),
            ]);
    }
}
