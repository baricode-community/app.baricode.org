<?php

namespace App\Filament\Resources\CertificateResource\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CertificateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('title')
                    ->label('Judul Sertifikat')
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

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->maxLength(1000)
                    ->helperText('Deskripsi singkat tentang sertifikat ini.')
                    ->columnSpanFull(),

                TextInput::make('icon')
                    ->label('Ikon (emoji)')
                    ->maxLength(10)
                    ->helperText('Masukkan emoji, misalnya: 🏆 🎓 ⭐'),

                Select::make('badge_color')
                    ->label('Warna Badge')
                    ->options([
                        'purple' => 'Purple',
                        'indigo' => 'Indigo',
                        'blue'   => 'Blue',
                        'green'  => 'Green',
                        'yellow' => 'Yellow (Gold)',
                        'orange' => 'Orange',
                        'red'    => 'Red',
                        'pink'   => 'Pink',
                        'gray'   => 'Gray (Silver)',
                    ])
                    ->default('purple')
                    ->required(),

                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->helperText('Hanya sertifikat aktif yang tampil di halaman publik.')
                    ->columnSpanFull(),
            ]);
    }
}
