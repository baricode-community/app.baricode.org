<?php

use App\Http\Controllers\Web\General\RepoHubController;
use Illuminate\Support\Facades\Route;

Route::controller(RepoHubController::class)
    ->prefix('/repohub')
    ->group(function () {
        Route::get('/', 'index')->name('repohub.index');
        Route::get('/{repoHub:slug}', 'show')->name('repohub.show');
    });
