<?php

use App\Http\Controllers\Web\General\TimelineController;
use Illuminate\Support\Facades\Route;

Route::redirect('/timeline', '/timelines');

Route::controller(TimelineController::class)
    ->prefix('/timelines')
    ->group(function () {
        Route::get('/', 'index')->name('timeline.index');
        Route::get('/{timeline}', 'show')->name('timeline.show');
    });
