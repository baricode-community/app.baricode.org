<?php

use App\Http\Controllers\Web\Academy\AcademyController;
use App\Http\Controllers\Web\Academy\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('/academy')->group(function () {
    Route::controller(AcademyController::class)->group(function () {
        Route::get('/', 'index')->name('academy.index');
        Route::get('/{program:uuid}', 'show')->name('academy.show');
        Route::get('/batch/{batch:uuid}', 'batch')->name('academy.batch');

        Route::middleware(['auth', 'verified'])->group(function () {
            Route::get('/my/enrollments', 'dashboard')->name('academy.dashboard');
        });
    });

    Route::middleware(['auth', 'verified'])
        ->controller(OrderController::class)
        ->group(function () {
            Route::post('/order/{batch:uuid}', 'create')->name('academy.order.create');
            Route::get('/order/finish', 'finish')->name('academy.order.finish');
        });
});

