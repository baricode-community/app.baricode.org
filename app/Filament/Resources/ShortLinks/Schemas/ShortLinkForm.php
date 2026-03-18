<?php

namespace App\Filament\Resources\ShortLinks\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ShortLinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Link Details')
                    ->columns(1)
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, ?string $state, ?string $operation) {
                                if ($operation === 'create' && $state) {
                                    $set('slug', Str::slug($state));
                                }
                            }),
                        Textarea::make('description')
                            ->maxLength(1000)
                            ->rows(3)
                            ->nullable(),
                        TextInput::make('real_url')
                            ->label('Destination URL')
                            ->required()
                            ->url()
                            ->maxLength(2048)
                            ->placeholder('https://example.com/your-long-url'),
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->alphaDash()
                            ->hint('Auto-generated from title. Used in: /link/{slug}'),
                    ]),

                Section::make('Settings')
                    ->columns(1)
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Inactive links will show a 404 page.'),
                        DateTimePicker::make('expired_at')
                            ->label('Expiry Date')
                            ->helperText('Leave empty for no expiration.')
                            ->nullable()
                            ->minDate(now()),
                    ]),
            ]);
    }
}
