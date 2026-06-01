<?php

use App\Http\Controllers\Web\JobBoard\JobBoardController;
use App\Http\Controllers\Web\JobBoard\JobListingController;
use Illuminate\Support\Facades\Route;

Route::prefix('/jobboard')
    ->group(function () {
        Route::get('/', [JobBoardController::class, 'index'])->name('jobboard.index');

        Route::middleware('auth')->group(function () {
            Route::get('/post', [JobListingController::class, 'create'])->name('jobboard.post');
            Route::post('/post', [JobListingController::class, 'store'])->name('jobboard.post.store');
            Route::get('/my-listings', [JobListingController::class, 'myListings'])->name('jobboard.my-listings');
        });

        Route::get('/{jobListing:slug}', [JobBoardController::class, 'show'])->name('jobboard.show');
    });
