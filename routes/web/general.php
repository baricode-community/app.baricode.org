<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\Web\General\HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/profile/{user:username?}', 'profile')->name('profile');
});

Route::redirect('/timeline', '/timelines');

Route::controller(\App\Http\Controllers\Web\General\TimelineController::class)
    ->prefix('/timelines')
    ->group(function () {
        Route::get('/', 'index')->name('timelines.index');
        Route::get('/{timeline}', 'show')->name('timelines.show');
});


Route::controller(\App\Http\Controllers\Web\General\DashboardController::class)
    ->prefix('/dashboard')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', 'index')->name('dashboard');
        Route::get('/settings', 'settings')->name('dashboard.settings');
        Route::get('/analytics', 'analytics')->name('dashboard.analytics');
        Route::get('/fun', 'fun')->name('dashboard.fun');
        Route::get('/memes', 'memes')->name('dashboard.memes');
});

Route::get('/link/{slug}', [\App\Http\Controllers\Web\General\ShortLinkController::class, 'redirect'])
    ->name('short-link.redirect');

Route::controller(\App\Http\Controllers\Web\General\BlogController::class)
    ->prefix('/blog')
    ->group(function () {
        Route::get('/', 'index')->name('blog.index');
        Route::get('/category/{slug}', 'category')->name('blog.category');
        Route::get('/tag/{slug}', 'tag')->name('blog.tag');
        Route::get('/{slug}', 'show')->name('blog.show');
    });

Route::controller(\App\Http\Controllers\DailyCommitTrackerController::class)
    ->prefix('/daily-commit-tracker')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', 'index')->name('daily-commit-tracker.index');
        Route::get('/show/{date?}', 'show')->name('daily-commit-tracker.show');
        Route::get('/history', 'history')->name('daily-commit-tracker.history');
    });

Route::controller(\App\Http\Controllers\Web\General\RepoHubController::class)
    ->prefix('/repohub')
    ->group(function () {
        Route::get('/', 'index')->name('repohub.index');
        Route::get('/{repoHub:slug}', 'show')->name('repohub.show');
    });