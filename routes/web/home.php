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

Route::view('/tentang', 'pages.general.about.index')->name('about');

Route::view('/syarat-ketentuan', 'pages.general.legal.terms')->name('terms');
Route::view('/kebijakan-privasi', 'pages.general.legal.privacy')->name('privacy');

Route::view('/roadmap', 'pages.general.roadmap.index')->name('roadmap');
Route::view('/roadmap/website-developer', 'pages.general.roadmap.website-developer')->name('roadmap.website-developer');
