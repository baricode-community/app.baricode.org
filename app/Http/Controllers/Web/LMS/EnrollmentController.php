<?php

namespace App\Http\Controllers\Web\LMS;

use App\Http\Controllers\Controller;
use App\Models\LMS\Course;
use App\Services\LMS\EnrollmentService;
use Illuminate\Http\RedirectResponse;

class EnrollmentController extends Controller
{
    public function __construct(private EnrollmentService $service) {}

    public function store(Course $course): RedirectResponse
    {
        try {
            $this->service->enroll(auth()->user(), $course);

            return redirect()->route('lms.course', $course->slug)
                ->with('success', 'Permintaan enrollment berhasil dikirim. Tunggu persetujuan admin.');
        } catch (\RuntimeException $e) {
            return redirect()->route('lms.course', $course->slug)
                ->with('error', $e->getMessage());
        }
    }

    public function requestUnenroll(Course $course): RedirectResponse
    {
        try {
            $this->service->requestUnenroll(auth()->user(), $course);

            return redirect()->route('lms.course', $course->slug)
                ->with('success', 'Permintaan keluar dari kursus telah dikirim. Tunggu persetujuan admin.');
        } catch (\RuntimeException $e) {
            return redirect()->route('lms.course', $course->slug)
                ->with('error', $e->getMessage());
        }
    }

    public function cancelUnenrollRequest(Course $course): RedirectResponse
    {
        try {
            $this->service->cancelUnenrollRequest(auth()->user(), $course);

            return redirect()->route('lms.course', $course->slug)
                ->with('success', 'Permintaan keluar dari kursus berhasil dibatalkan.');
        } catch (\RuntimeException $e) {
            return redirect()->route('lms.course', $course->slug)
                ->with('error', $e->getMessage());
        }
    }
}
