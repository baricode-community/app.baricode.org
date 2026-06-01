<?php

namespace App\Filament\Resources\CertificateResource\RelationManagers;

use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('user_id')
                ->label('Pengguna')
                ->searchable()
                ->required()
                ->getSearchResultsUsing(fn (string $search) => User::query()
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->limit(20)
                    ->pluck('name', 'id')
                )
                ->getOptionLabelUsing(fn ($value) => User::find($value)?->name)
                ->columnSpanFull(),

            DateTimePicker::make('issued_at')
                ->label('Tanggal Terbit')
                ->required()
                ->default(now())
                ->columnSpanFull(),

            Textarea::make('notes')
                ->label('Catatan (opsional)')
                ->placeholder('Misalnya: Lulus batch 3, kelas Laravel Advanced...')
                ->rows(2)
                ->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('username')
                    ->label('Username')
                    ->searchable(),

                TextColumn::make('pivot.issued_at')
                    ->label('Tanggal Terbit')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('pivot.notes')
                    ->label('Catatan')
                    ->limit(50)
                    ->toggleable(),
            ])
            ->defaultSort('pivot.issued_at', 'desc')
            ->headerActions([
                CreateAction::make()
                    ->label('Tambah Pemegang'),
            ])
            ->recordActions([
                DeleteAction::make()
                    ->label('Hapus'),
            ]);
    }
}
