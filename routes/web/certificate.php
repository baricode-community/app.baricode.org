<?php

use App\Http\Controllers\Web\Certificate\CertificateController;
use Illuminate\Support\Facades\Route;

Route::get('/certificates/{certificate:slug}', [CertificateController::class, 'show'])
    ->name('certificate.show');

Route::prefix('/dashboard/certificates')
    ->middleware(['auth', 'verified'])
    ->controller(CertificateController::class)
    ->group(function () {
        Route::get('/', 'myList')->name('dashboard.certificates.index');
    });
