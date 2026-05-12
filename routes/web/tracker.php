<?php

use App\Http\Controllers\Web\General\DailyCommitTrackerController;
use Illuminate\Support\Facades\Route;

Route::controller(DailyCommitTrackerController::class)
    ->prefix('/daily-commit-tracker')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', 'index')->name('daily-commit-tracker.index');
        Route::get('/history', 'history')->name('daily-commit-tracker.history');
        Route::get('/{date?}', 'show')->name('daily-commit-tracker.show');
    });
