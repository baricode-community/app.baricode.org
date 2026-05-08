<?php

use App\Http\Controllers\Web\Fun\FunController;
use App\Http\Controllers\Web\Fun\MemeController;
use Illuminate\Support\Facades\Route;

Route::controller(FunController::class)
    ->prefix('/dashboard/fun')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', 'index')->name('dashboard.fun');
    });

Route::controller(MemeController::class)
    ->prefix('/meme')
    ->group(function () {
        Route::get('/', 'index')->name('meme.index');

        Route::get('/create', 'create')
            ->middleware(['auth', 'verified'])
            ->name('meme.create');

        Route::get('/user', 'user_list')->name('meme.users');
        Route::get('/user/{user:username}', 'user')->name('meme.user');

        Route::get('/{meme}', 'show')->name('meme.show');
    });
