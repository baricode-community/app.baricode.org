<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Blogs\BlogResource;
use App\Models\Blog;
use Filament\Actions\Action;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestBlogsWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Blog Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Blog::with('author')->latest()->limit(8)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->weight('semibold')
                    ->limit(50),

                Tables\Columns\TextColumn::make('author.name')
                    ->label('Penulis')
                    ->icon('heroicon-m-user'),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-clock')
                    ->trueColor('success')
                    ->falseColor('warning'),

                Tables\Columns\TextColumn::make('views_count')
                    ->label('Views')
                    ->numeric()
                    ->icon('heroicon-m-eye')
                    ->sortable(),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Diterbitkan')
                    ->since()
                    ->color('gray')
                    ->placeholder('Belum diterbitkan'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->since()
                    ->color('gray'),
            ])
            ->actions([
                Action::make('edit')
                    ->label('Edit')
                    ->icon('heroicon-m-pencil-square')
                    ->url(fn (Blog $record): string => BlogResource::getUrl('edit', ['record' => $record]))
                    ->color('gray'),
            ])
            ->paginated(false);
    }
}
