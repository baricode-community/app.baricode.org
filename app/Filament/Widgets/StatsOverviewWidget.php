<?php

namespace App\Filament\Widgets;

use App\Models\Fun\Meme;
use App\Models\LMS\Course;
use App\Models\Quiz\Quiz;
use App\Models\ShortLink;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $newUsersThisMonth = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        return [
            Stat::make('Total Member', User::count())
                ->description("+{$newUsersThisMonth} bulan ini")
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->icon('heroicon-o-users'),

            Stat::make('Kursus LMS', Course::count())
                ->description(Course::where('is_published', true)->count().' aktif')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('warning')
                ->icon('heroicon-o-academic-cap'),

            Stat::make('Meme Upload', Meme::count())
                ->description('Total meme komunitas')
                ->descriptionIcon('heroicon-m-face-smile')
                ->color('danger')
                ->icon('heroicon-o-photo'),

            Stat::make('Quiz', Quiz::count())
                ->description('Total quiz tersedia')
                ->descriptionIcon('heroicon-m-question-mark-circle')
                ->color('gray')
                ->icon('heroicon-o-puzzle-piece'),

            Stat::make('Short Link', ShortLink::active()->count())
                ->description(ShortLink::sum('click_count').' total klik')
                ->descriptionIcon('heroicon-m-cursor-arrow-rays')
                ->color('primary')
                ->icon('heroicon-o-link'),
        ];
    }
}
