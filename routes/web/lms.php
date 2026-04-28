<?php

use App\Http\Controllers\LMS\QuizController;
use App\Http\Controllers\Web\LMS\CategoryProgressController;
use App\Http\Controllers\Web\LMS\EnrollmentController;
use App\Http\Controllers\Web\LMS\LessonProgressController;
use App\Http\Controllers\Web\LMS\LMSController;
use Illuminate\Support\Facades\Route;

Route::controller(LMSController::class)
    ->prefix('/lms')
    ->group(function () {
        Route::redirect('/', '/lms/courses')->name('lms.index');
        // Route::get('/', 'index')->name('lms.index');
        Route::get('/courses', 'allCourses')->name('lms.all-courses');
        Route::get('/category/{category:slug}', 'category')->name('lms.category');
        Route::get('/course/{course:slug}', 'course')->name('lms.course');
        Route::get('/lesson/{lesson}', 'lesson')->name('lms.lesson');
    });

Route::middleware(['auth', 'verified'])->prefix('/lms')->group(function () {
    // Enrollment
    Route::controller(EnrollmentController::class)->group(function () {
        Route::post('/course/{course:slug}/enroll', 'store')->name('lms.enroll');
        Route::delete('/course/{course:slug}/unenroll', 'requestUnenroll')->name('lms.unenroll');
        Route::delete('/course/{course:slug}/unenroll/cancel', 'cancelUnenrollRequest')->name('lms.unenroll.cancel');
    });

    // Lesson progress
    Route::post('/lesson/{lesson}/progress/toggle', [LessonProgressController::class, 'toggle'])
        ->name('lms.lesson.progress.toggle');

    // Category progress
    Route::post('/category/{category:slug}/progress/submit', [CategoryProgressController::class, 'submit'])
        ->name('lms.category.progress.submit');
});

Route::controller(QuizController::class)
    ->prefix('/quiz')
    ->group(function () {
        Route::get('/', 'index')->name('lms.quiz.index');
        Route::get('/{quiz}', 'show')->name('lms.quiz.show');
    });
