<?php

namespace App\Filament\Resources\OnboardingTaskResource\Schemas;

use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class OnboardingTaskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('title')
                    ->label('Judul Task')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->columnSpanFull(),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->helperText('Digunakan di URL. Bisa dikustomisasi.')
                    ->columnSpanFull(),

                TextInput::make('description')
                    ->label('Deskripsi Singkat')
                    ->maxLength(255)
                    ->helperText('Subtitle yang tampil di bawah judul checklist.')
                    ->columnSpanFull(),

                TextInput::make('icon')
                    ->label('Ikon (emoji)')
                    ->maxLength(10)
                    ->helperText('Masukkan emoji, misalnya: 🚀 👤 📚'),

                TextInput::make('order')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0)
                    ->minValue(0),

                MarkdownEditor::make('content')
                    ->label('Konten (Markdown)')
                    ->required()
                    ->columnSpanFull()
                    ->toolbarButtons([
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
                    ->helperText('Hanya task aktif yang tampil di dashboard user.'),
            ]);
    }
}
