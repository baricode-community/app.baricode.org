<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\Web\Fun\FunController::class)
    ->prefix('/dashboard/fun')
    ->group(function () {
        Route::get('/', 'index')->name('dashboard.fun');
    });

Route::controller(\App\Http\Controllers\Web\Fun\MemeController::class)
    ->prefix('/meme')
    ->group(function () {
        Route::get('/', 'index')->name('memes.index');

        Route::get('/create', 'create')
            ->middleware(['auth', 'verified'])
            ->name('memes.create');

        Route::get('/user', 'user_list')->name('memes.user_list');
        Route::get('/user/{user:username}', 'user')->name('memes.user');

        Route::get('/show/{meme}', 'show')->name('memes.show');
    });

