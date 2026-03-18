<?php

namespace App\Filament\Resources\Timelines\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TimelineForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Section::make('Informasi Timeline')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->placeholder('Jelaskan detail timeline ini...')
                            ->maxLength(500)
                            ->rows(3)
                            ->columnSpanFull(),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'planned' => 'Direncanakan',
                                'pending' => 'Tertunda',
                                'ongoing' => 'Berlangsung',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                            ])
                            ->required()
                            ->native(false),
                    ]),

                Section::make('Jadwal')
                    ->columns(2)
                    ->schema([
                        DatePicker::make('start_date')
                            ->label('Tanggal Mulai')
                            ->native(false),

                        DatePicker::make('end_date')
                            ->label('Tanggal Selesai')
                            ->native(false),
                    ]),

                Section::make('Catatan Tambahan')
                    ->schema([
                        Textarea::make('notes')
                            ->label('Catatan')
                            ->placeholder('Catatan atau keterangan tambahan...')
                            ->maxLength(1000)
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
