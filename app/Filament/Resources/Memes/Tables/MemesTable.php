<?php

namespace App\Filament\Resources\Memes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MemesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Gambar')
                    ->square()
                    ->size(80)
                    ->defaultImageUrl(fn () => 'https://placehold.co/80x80?text=No+Image'),

                TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->badge()
                    ->color('gray'),

                TextColumn::make('caption')
                    ->label('Caption')
                    ->searchable()
                    ->limit(60)
                    ->tooltip(fn ($record) => $record->caption)
                    ->placeholder('(tidak ada caption)'),

                TextColumn::make('user.name')
                    ->label('Pemilik')
                    ->searchable()
                    ->sortable()
                    ->url(fn ($record) => $record->user
                        ? route('filament.admin.resources.users.edit', $record->user)
                        : null
                    ),

                TextColumn::make('user.username')
                    ->label('Username')
                    ->searchable()
                    ->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('upvotes_count')
                    ->label('Upvotes')
                    ->counts('upvotes')
                    ->sortable()
                    ->badge()
                    ->color('success'),

                TextColumn::make('downvotes_count')
                    ->label('Downvotes')
                    ->counts('downvotes')
                    ->sortable()
                    ->badge()
                    ->color('danger'),

                TextColumn::make('votes_count')
                    ->label('Total Votes')
                    ->counts('votes')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('user_id')
                    ->label('Pemilik')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload(),

                Filter::make('has_image')
                    ->label('Punya Gambar')
                    ->query(fn (Builder $query) => $query->whereNotNull('image_path')),

                Filter::make('no_image')
                    ->label('Tanpa Gambar')
                    ->query(fn (Builder $query) => $query->whereNull('image_path')),

                Filter::make('has_caption')
                    ->label('Punya Caption')
                    ->query(fn (Builder $query) => $query->whereNotNull('caption')),

                Filter::make('created_today')
                    ->label('Dibuat Hari Ini')
                    ->query(fn (Builder $query) => $query->whereDate('created_at', today())),

                Filter::make('created_this_week')
                    ->label('Dibuat Minggu Ini')
                    ->query(fn (Builder $query) => $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
