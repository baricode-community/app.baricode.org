<?php

namespace App\Filament\Resources\Mentoring\MentoringProgramResource\Pages;

use App\Filament\Resources\Mentoring\MentoringProgramResource;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;

class ViewMentoringProgram extends ViewRecord
{
    protected static string $resource = MentoringProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [EditAction::make()];
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema->schema([
            TextEntry::make('title')
                ->label('Nama Program')
                ->columnSpanFull(),

            TextEntry::make('description')
                ->label('Deskripsi')
                ->placeholder('—')
                ->columnSpanFull(),

            TextEntry::make('goals')
                ->label('Target / Goals')
                ->placeholder('—')
                ->columnSpanFull(),

            IconEntry::make('is_open')
                ->label('Menerima Murid Baru')
                ->boolean(),

            TextEntry::make('enrollments_count')
                ->label('Jumlah Murid')
                ->state(fn ($record) => $record->enrollments()->count()),

            TextEntry::make('sessions_count')
                ->label('Total Sesi')
                ->state(fn ($record) => $record->sessions()->count()),

            TextEntry::make('created_at')
                ->label('Dibuat')
                ->dateTime('d M Y'),
        ]);
    }
}
