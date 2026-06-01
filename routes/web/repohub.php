<?php

use App\Http\Controllers\Web\General\RepoHubController;
use App\Http\Controllers\Web\General\RepoHubSubmissionController;
use Illuminate\Support\Facades\Route;

Route::controller(RepoHubController::class)
    ->prefix('/repohub')
    ->group(function () {
        Route::get('/', 'index')->name('repohub.index');

        Route::middleware('auth')->group(function () {
            Route::get('/submit', [RepoHubSubmissionController::class, 'create'])->name('repohub.submit');
            Route::post('/submit', [RepoHubSubmissionController::class, 'store'])->name('repohub.submit.store');
            Route::get('/my-submissions', [RepoHubSubmissionController::class, 'mySubmissions'])->name('repohub.my-submissions');
        });

        Route::get('/{repoHub:slug}', 'show')->name('repohub.show');
    });
