<?php

use App\Http\Controllers\LMS\QuizController;
use App\Http\Controllers\Web\LMS\LMSController;
use Illuminate\Support\Facades\Route;

Route::controller(LMSController::class)
    ->prefix('/lms')
    ->group(function () {
        Route::get('/', 'index')->name('lms.index');
        Route::get('/courses', 'allCourses')->name('lms.all-courses');
        Route::get('/category/{category:slug}', 'category')->name('lms.category');
        Route::get('/course/{course:slug}', 'course')->name('lms.course');
        Route::get('/lesson/{lesson}', 'lesson')->name('lms.lesson');
    });

Route::controller(QuizController::class)
    ->prefix('/quiz')
    ->group(function () {
        Route::get('/', 'index')->name('lms.quiz.index');
        Route::get('/{quiz}', 'show')->name('lms.quiz.show');
    });
