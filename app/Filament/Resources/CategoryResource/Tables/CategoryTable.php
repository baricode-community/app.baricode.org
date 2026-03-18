<?php

namespace App\Filament\Resources\CategoryResource\Tables;

use App\Filament\Resources\CourseResource;
use App\Filament\Resources\LessonResource;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CategoryTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('course.title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->limit(50)
                    ->wrap(),
                TextColumn::make('order')
                    ->sortable(),
                IconColumn::make('is_published')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('view_course')
                    ->label('Course')
                    ->icon('heroicon-o-book-open')
                    ->url(function ($record) {
                        return CourseResource::getUrl('edit', ['record' => $record->course_id]);
                    }),
                Action::make('view_lessons')
                    ->label('Lessons')
                    ->icon('heroicon-o-rectangle-stack')
                    ->url(function ($record) {
                        return LessonResource::getUrl('index', ['category' => $record->id]);
                    }),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
