<?php

use App\Http\Controllers\Web\General\HomeController;
use App\Http\Controllers\Web\General\HowToLearnController;
use App\Http\Controllers\Web\General\ShortLinkController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/profile/{user:username?}', 'profile')->name('profile');
});

Route::get('/link/{slug}', [ShortLinkController::class, 'redirect'])
    ->name('short-link.redirect');

Route::get('/cara-belajar-di-baricode', [HowToLearnController::class, 'index'])
    ->name('how-to-learn');
