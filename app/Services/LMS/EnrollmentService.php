<?php

namespace App\Services\LMS;

use App\Enums\LMS\CategoryProgressStatus;
use App\Enums\LMS\EnrollmentStatus;
use App\Models\LMS\CategoryProgress;
use App\Models\LMS\Course;
use App\Models\LMS\CourseCategory;
use App\Models\LMS\Enrollment;
use App\Models\LMS\Lesson;
use App\Models\LMS\LessonProgress;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EnrollmentService
{
    /**
     * Enroll a user into a course (creates a pending enrollment request).
     * Max 3 active+pending enrollments allowed.
     */
    public function enroll(User $user, Course $course): Enrollment
    {
        // Count active + pending + unenroll-requested enrollments
        $activeCount = Enrollment::where('user_id', $user->id)
            ->whereIn('status', [
                EnrollmentStatus::Active->value,
                EnrollmentStatus::Pending->value,
                EnrollmentStatus::UnenrollRequested->value,
            ])
            ->count();

        if ($activeCount >= 3) {
            throw new \RuntimeException('Kamu sudah memiliki 3 enrollment aktif atau pending. Selesaikan atau tunggu persetujuan kursus yang ada terlebih dahulu.');
        }

        // Check if enrollment already exists (not soft-deleted)
        $existing = Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if ($existing) {
            if ($existing->status === EnrollmentStatus::Rejected) {
                // Allow re-enrollment after rejection
                $existing->update([
                    'status' => EnrollmentStatus::Pending,
                    'rejection_reason' => null,
                    'approved_at' => null,
                    'completed_at' => null,
                ]);

                return $existing->fresh();
            }

            throw new \RuntimeException('Kamu sudah terdaftar di kursus ini.');
        }

        return Enrollment::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'status' => EnrollmentStatus::Pending,
        ]);
    }

    /**
     * Request unenrollment from a course.
     */
    public function requestUnenroll(User $user, Course $course): Enrollment
    {
        $enrollment = $this->getActiveEnrollment($user, $course);

        $enrollment->update([
            'status' => EnrollmentStatus::UnenrollRequested,
        ]);

        return $enrollment->fresh();
    }

    /**
     * Cancel a pending unenrollment request.
     */
    public function cancelUnenrollRequest(User $user, Course $course): Enrollment
    {
        $enrollment = Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->where('status', EnrollmentStatus::UnenrollRequested->value)
            ->firstOrFail();

        $enrollment->update([
            'status' => EnrollmentStatus::Active,
        ]);

        return $enrollment->fresh();
    }

    /**
     * Admin approves enrollment: creates lesson progress and category progress records.
     */
    public function approveEnrollment(Enrollment $enrollment): void
    {
        DB::transaction(function () use ($enrollment) {
            $enrollment->update([
                'status' => EnrollmentStatus::Active,
                'approved_at' => now(),
                'rejection_reason' => null,
            ]);

            // Initialize category progress for all published categories
            $categories = $enrollment->course->categories()
                ->where('is_published', true)
                ->get();

            foreach ($categories as $category) {
                CategoryProgress::firstOrCreate(
                    [
                        'enrollment_id' => $enrollment->id,
                        'category_id' => $category->id,
                    ],
                    ['status' => CategoryProgressStatus::InProgress]
                );

                // Initialize lesson progress for all published lessons in this category
                $lessons = $category->lessons()->where('is_published', true)->get();
                foreach ($lessons as $lesson) {
                    LessonProgress::firstOrCreate([
                        'enrollment_id' => $enrollment->id,
                        'lesson_id' => $lesson->id,
                    ]);
                }
            }
        });
    }

    /**
     * Admin rejects enrollment.
     */
    public function rejectEnrollment(Enrollment $enrollment, string $reason = ''): void
    {
        $enrollment->update([
            'status' => EnrollmentStatus::Rejected,
            'rejection_reason' => $reason,
        ]);
    }

    /**
     * Admin approves unenrollment: soft-deletes the enrollment.
     */
    public function approveUnenrollment(Enrollment $enrollment): void
    {
        $enrollment->delete(); // soft delete
    }

    /**
     * Admin denies unenrollment request: revert to active.
     */
    public function denyUnenrollRequest(Enrollment $enrollment): void
    {
        $enrollment->update([
            'status' => EnrollmentStatus::Active,
        ]);
    }

    /**
     * Toggle lesson completion for an enrolled student.
     */
    public function toggleLesson(User $user, Lesson $lesson): LessonProgress
    {
        $enrollment = $this->getActiveEnrollment($user, $lesson->category->course);

        // Check if category is locked (submitted or approved)
        $catProgress = CategoryProgress::where('enrollment_id', $enrollment->id)
            ->where('category_id', $lesson->category_id)
            ->first();

        if ($catProgress && $catProgress->isLocked()) {
            throw new \RuntimeException('Kategori ini sudah dikunci. Kamu tidak dapat mengubah progress lesson.');
        }

        $progress = LessonProgress::firstOrCreate([
            'enrollment_id' => $enrollment->id,
            'lesson_id' => $lesson->id,
        ]);

        if ($progress->is_completed) {
            $progress->update([
                'is_completed' => false,
                'completed_at' => null,
            ]);
        } else {
            $progress->update([
                'is_completed' => true,
                'completed_at' => now(),
            ]);
        }

        return $progress->fresh();
    }

    /**
     * Submit a category for admin approval (all lessons must be completed).
     */
    public function submitCategoryProgress(User $user, CourseCategory $category): CategoryProgress
    {
        $enrollment = $this->getActiveEnrollment($user, $category->course);

        // Check all published lessons are completed
        $lessons = $category->lessons()->where('is_published', true)->pluck('id');
        $completedCount = LessonProgress::where('enrollment_id', $enrollment->id)
            ->whereIn('lesson_id', $lessons)
            ->where('is_completed', true)
            ->count();

        if ($completedCount < $lessons->count()) {
            throw new \RuntimeException('Selesaikan semua lesson dalam kategori ini sebelum mengajukan persetujuan.');
        }

        $catProgress = CategoryProgress::firstOrCreate(
            [
                'enrollment_id' => $enrollment->id,
                'category_id' => $category->id,
            ],
            ['status' => CategoryProgressStatus::InProgress]
        );

        if ($catProgress->status !== CategoryProgressStatus::InProgress) {
            throw new \RuntimeException('Kategori ini sudah diajukan atau sudah disetujui.');
        }

        $catProgress->update([
            'status' => CategoryProgressStatus::Submitted,
            'submitted_at' => now(),
            'admin_note' => null,
        ]);

        return $catProgress->fresh();
    }

    /**
     * Admin approves a category progress submission.
     */
    public function approveCategoryProgress(CategoryProgress $catProgress, User $admin): void
    {
        DB::transaction(function () use ($catProgress, $admin) {
            $catProgress->update([
                'status' => CategoryProgressStatus::Approved,
                'approved_by' => $admin->id,
                'approved_at' => now(),
            ]);

            // Check if course is fully completed
            $catProgress->enrollment->checkAndMarkCompleted();
        });
    }

    /**
     * Admin rejects a category progress submission (sends back to in_progress).
     */
    public function rejectCategoryProgress(CategoryProgress $catProgress, User $admin, string $note = ''): void
    {
        $catProgress->update([
            'status' => CategoryProgressStatus::InProgress,
            'admin_note' => $note,
            'approved_by' => null,
            'approved_at' => null,
        ]);
    }

    /**
     * Get the active enrollment for a user in a course, or fail.
     */
    private function getActiveEnrollment(User $user, Course $course): Enrollment
    {
        $enrollment = Enrollment::where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->where('status', EnrollmentStatus::Active->value)
            ->first();

        if (! $enrollment) {
            throw new \RuntimeException('Kamu tidak terdaftar aktif di kursus ini.');
        }

        return $enrollment;
    }
}
