<?php

use App\Http\Controllers\Web\General\CheatSheetController;
use Illuminate\Support\Facades\Route;

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
