<?php

namespace App\Http\Controllers\Web\LMS;

use App\Http\Controllers\Controller;
use App\Models\LMS\Lesson;
use App\Services\LMS\EnrollmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class LessonProgressController extends Controller
{
    public function __construct(private EnrollmentService $service) {}

    public function toggle(Lesson $lesson): JsonResponse|RedirectResponse
    {
        try {
            $progress = $this->service->toggleLesson(auth()->user(), $lesson);

            if (request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'is_completed' => $progress->is_completed,
                ]);
            }

            return redirect()->back()
                ->with('success', $progress->is_completed ? 'Lesson ditandai selesai.' : 'Tanda selesai dihapus.');
        } catch (\RuntimeException $e) {
            if (request()->expectsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
            }

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
