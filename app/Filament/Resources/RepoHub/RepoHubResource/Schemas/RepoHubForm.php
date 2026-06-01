<?php

namespace App\Filament\Resources\RepoHub\RepoHubResource\Schemas;

use App\Enums\RepoHub\RepoHubStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class RepoHubForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->label('Title')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $state, callable $set) => $set('slug', Str::slug($state))),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->label('Slug'),

                Select::make('status')
                    ->label('Status')
                    ->options(collect(RepoHubStatus::cases())->mapWithKeys(
                        fn (RepoHubStatus $s) => [$s->value => $s->label()]
                    ))
                    ->default(RepoHubStatus::Approved->value)
                    ->required(),

                Textarea::make('rejection_note')
                    ->label('Rejection Note')
                    ->nullable()
                    ->rows(3)
                    ->columnSpanFull()
                    ->visible(fn ($get) => $get('status') === RepoHubStatus::Rejected->value),

                TextInput::make('repo_url')
                    ->required()
                    ->url()
                    ->label('Repository URL')
                    ->placeholder('https://github.com/user/repo')
                    ->columnSpanFull(),

                TextInput::make('demo_url')
                    ->url()
                    ->nullable()
                    ->label('Demo URL (optional)')
                    ->placeholder('https://demo.example.com')
                    ->columnSpanFull(),

                Textarea::make('description')
                    ->required()
                    ->rows(4)
                    ->label('Description')
                    ->columnSpanFull(),

                Textarea::make('why_recommended')
                    ->required()
                    ->rows(4)
                    ->label('Why We Recommend')
                    ->columnSpanFull(),

                Select::make('tags')
                    ->relationship('tags', 'name')
                    ->multiple()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $state, callable $set) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->required()
                            ->unique(),
                    ])
                    ->label('Tags')
                    ->columnSpanFull(),

                Toggle::make('is_published')
                    ->label('Published')
                    ->default(false),
            ]);
    }
}
