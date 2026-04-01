<?php

namespace App\Filament\Resources\Memes\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class VotesRelationManager extends RelationManager
{
    protected static string $relationship = 'votes';

    protected static ?string $recordTitleAttribute = 'id';

    protected static ?string $title = 'Daftar Voter';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('vote_type')
                    ->label('Tipe Vote')
                    ->options([
                        'up' => 'Upvote',
                        'down' => 'Downvote',
                    ])
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama User')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user.username')
                    ->label('Username')
                    ->searchable()
                    ->color('gray'),

                TextColumn::make('vote_type')
                    ->label('Vote')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'up' => 'success',
                        'down' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'up' => 'Upvote',
                        'down' => 'Downvote',
                        default => $state,
                    }),

                TextColumn::make('created_at')
                    ->label('Waktu Vote')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('vote_type')
                    ->label('Tipe Vote')
                    ->options([
                        'up' => 'Upvote',
                        'down' => 'Downvote',
                    ]),
            ])
            ->headerActions([])
            ->recordActions([
                DeleteAction::make()
                    ->label('Hapus Vote'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
