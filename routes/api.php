<?php

use App\Http\Controllers\Api\General\TimelineController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Timeline Routes
Route::controller(TimelineController::class)
    ->prefix('timelines')
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/{timeline}', 'show');
    });
