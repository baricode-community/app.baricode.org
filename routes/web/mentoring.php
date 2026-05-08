<?php

use App\Http\Controllers\Web\Mentoring\MentoringController;
use Illuminate\Support\Facades\Route;

Route::controller(MentoringController::class)
    ->prefix('/mentoring')
    ->group(function () {
        Route::get('/', 'index')->name('mentoring.index');

        Route::middleware(['auth', 'verified'])->group(function () {
            Route::get('/dashboard', 'dashboard')->name('mentoring.dashboard');
            Route::get('/{enrollment:uuid}', 'show')->name('mentoring.show');
            Route::post('/apply', 'apply')->name('mentoring.apply');
        });
    });
