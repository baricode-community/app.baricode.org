<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BlogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
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
                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->hint('Auto-generated from title. Editable.'),
                        Textarea::make('excerpt')
                            ->maxLength(500)
                            ->rows(3),
                    ]),

                Section::make('Content')
                    ->columns(1)
                    ->collapsible()
                    ->schema([
                        RichEditor::make('content')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Media')
                    ->columns(1)
                    ->collapsible()
                    ->schema([
                        FileUpload::make('featured_image')
                            ->image()
                            ->directory('blog-featured-images')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9'),
                    ]),

                Section::make('Publishing')
                    ->columns(1)
                    ->collapsible()
                    ->schema([
                        Select::make('author_id')
                            ->relationship('author', 'name')
                            ->required()
                            ->searchable(),
                        Select::make('categories')
                            ->relationship('categories', 'name')
                            ->multiple()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                                TextInput::make('slug')
                                    ->required()
                                    ->unique('blog_categories', 'slug'),
                            ]),
                        Select::make('tags')
                            ->relationship('tags', 'name')
                            ->multiple()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                                TextInput::make('slug')
                                    ->required()
                                    ->unique('blog_tags', 'slug'),
                            ]),
                        Toggle::make('is_published')
                            ->label('Published')
                            ->helperText('Toggle to publish. Set a publish date below to schedule.'),
                        DateTimePicker::make('published_at')
                            ->label('Publish Date')
                            ->helperText('Leave empty to publish immediately when toggled on.')
                            ->nullable(),
                    ]),

                Section::make('SEO')
                    ->columns(1)
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->maxLength(60)
                            ->helperText('Max 60 characters. Defaults to post title if empty.')
                            ->nullable(),
                        Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->maxLength(160)
                            ->rows(3)
                            ->helperText('Max 160 characters. Defaults to excerpt if empty.')
                            ->nullable(),
                    ]),
            ]);
    }
}
