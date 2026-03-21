<?php

namespace App\Http\Controllers\Web\LMS;

use App\Http\Controllers\Controller;
use App\Models\LMS\CourseCategory;
use App\Services\LMS\EnrollmentService;
use Illuminate\Http\RedirectResponse;

class CategoryProgressController extends Controller
{
    public function __construct(private EnrollmentService $service) {}

    public function submit(CourseCategory $category): RedirectResponse
    {
        try {
            $this->service->submitCategoryProgress(auth()->user(), $category);

            return redirect()->route('lms.category', $category->slug)
                ->with('success', 'Permintaan persetujuan kategori berhasil dikirim. Tunggu konfirmasi admin.');
        } catch (\RuntimeException $e) {
            return redirect()->route('lms.category', $category->slug)
                ->with('error', $e->getMessage());
        }
    }
}
