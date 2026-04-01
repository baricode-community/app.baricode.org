<?php

use App\Http\Controllers\DailyCommitTrackerController;
use App\Http\Controllers\Web\General\BlogController;
use App\Http\Controllers\Web\General\DashboardController;
use App\Http\Controllers\Web\General\FamilyController;
use App\Http\Controllers\Web\General\HomeController;
use App\Http\Controllers\Web\General\CheatSheetController;
use App\Http\Controllers\Web\General\HowToLearnController;
use App\Http\Controllers\Web\General\RepoHubController;
use App\Http\Controllers\Web\General\ShortLinkController;
use App\Http\Controllers\Web\General\TimelineController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/profile/{user:username?}', 'profile')->name('profile');
});

Route::redirect('/timeline', '/timelines');

Route::controller(TimelineController::class)
    ->prefix('/timelines')
    ->group(function () {
        Route::get('/', 'index')->name('timelines.index');
        Route::get('/{timeline}', 'show')->name('timelines.show');
    });

Route::controller(DashboardController::class)
    ->prefix('/dashboard')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', 'index')->name('dashboard');
        Route::get('/settings', 'settings')->name('dashboard.settings');
        Route::get('/analytics', 'analytics')->name('dashboard.analytics');
        Route::get('/fun', 'fun')->name('dashboard.fun');
        Route::get('/memes', 'memes')->name('dashboard.memes');
    });

Route::get('/link/{slug}', [ShortLinkController::class, 'redirect'])
    ->name('short-link.redirect');

Route::controller(BlogController::class)
    ->prefix('/blog')
    ->group(function () {
        Route::get('/', 'index')->name('blog.index');
        Route::get('/category/{slug}', 'category')->name('blog.category');
        Route::get('/tag/{slug}', 'tag')->name('blog.tag');
        Route::get('/{slug}', 'show')->name('blog.show');
    });

Route::controller(DailyCommitTrackerController::class)
    ->prefix('/daily-commit-tracker')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', 'index')->name('daily-commit-tracker.index');
        Route::get('/show/{date?}', 'show')->name('daily-commit-tracker.show');
        Route::get('/history', 'history')->name('daily-commit-tracker.history');
    });

Route::controller(RepoHubController::class)
    ->prefix('/repohub')
    ->group(function () {
        Route::get('/', 'index')->name('repohub.index');
        Route::get('/{repoHub:slug}', 'show')->name('repohub.show');
    });

Route::controller(FamilyController::class)
    ->prefix('/family')
    ->group(function () {
        Route::get('/', 'index')->name('family.index');
        Route::get('/{user:username}', 'show')->name('family.show');
    });

Route::get('/cara-belajar-di-baricode', [HowToLearnController::class, 'index'])->name('how-to-learn');

Route::controller(CheatSheetController::class)
    ->prefix('/cheatsheet')
    ->group(function () {
        Route::get('/', 'index')->name('cheatsheet.index');

        Route::middleware(['auth', 'verified'])->group(function () {
            Route::get('/create', 'create')->name('cheatsheet.create');
            Route::post('/', 'store')->name('cheatsheet.store');
        });

        Route::get('/{cheatSheet}', 'show')->name('cheatsheet.show');

        Route::middleware(['auth', 'verified'])->group(function () {
            Route::get('/{cheatSheet}/edit', 'edit')->name('cheatsheet.edit');
            Route::put('/{cheatSheet}', 'update')->name('cheatsheet.update');
            Route::delete('/{cheatSheet}', 'destroy')->name('cheatsheet.destroy');
        });
    });
