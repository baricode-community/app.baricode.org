<?php

namespace App\Filament\Resources\CourseResource\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HowToLearnsRelationManager extends RelationManager
{
    protected static string $relationship = 'howToLearns';

    protected static ?string $title = 'Panduan Belajar';

    public function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(60),

                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(80)
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->filters([])
            ->recordActions([
                DetachAction::make(),
            ])
            ->toolbarActions([
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->recordSelectSearchColumns(['title', 'description']),
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ]);
    }
}
