<?php

use App\Http\Controllers\Web\Fun\FunController;
use App\Http\Controllers\Web\General\DashboardController;
use App\Http\Controllers\Web\General\OnboardingController;
use Illuminate\Support\Facades\Route;

Route::prefix('/dashboard')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::controller(DashboardController::class)->group(function () {
            Route::get('/', 'index')->name('dashboard');
            Route::get('/settings', 'settings')->name('dashboard.settings');
            Route::get('/analytics', 'analytics')->name('dashboard.analytics');
            Route::get('/memes', 'memes')->name('dashboard.memes');
        });

        Route::get('/fun', [FunController::class, 'index'])->name('dashboard.fun');

        Route::prefix('/onboarding')->controller(OnboardingController::class)->group(function () {
            Route::get('/', 'index')->name('dashboard.onboarding.index');
            Route::get('/{task:slug}', 'show')->name('dashboard.onboarding.show');
            Route::post('/{task:slug}/toggle', 'toggle')->name('dashboard.onboarding.toggle');
        });
    });
