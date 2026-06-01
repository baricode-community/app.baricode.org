<?php

namespace App\Filament\Resources\LMS\CourseResource\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->label('Course Title'),
                TextInput::make('slug')
                    ->required()
                    ->label('Course Slug'),
                Textarea::make('description')
                    ->columnSpanFull()
                    ->label('Description'),
                Toggle::make('is_published')
                    ->required()
                    ->label('Published'),
            ]);
    }
}
