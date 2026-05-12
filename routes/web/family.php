<?php

use App\Http\Controllers\Web\General\FamilyController;
use Illuminate\Support\Facades\Route;

Route::controller(FamilyController::class)
    ->prefix('/family')
    ->group(function () {
        Route::get('/', 'index')->name('family.index');
        Route::get('/{user:username}', 'show')->name('family.show');
    });
