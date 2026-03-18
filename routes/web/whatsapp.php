<?php

use App\Http\Controllers\Web\General\HomeController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/profile/{user:username?}', 'profile')->name('profile');
});
