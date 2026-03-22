<?php

namespace App\Http\Controllers\Web\LMS;

use App\Enums\LMS\CategoryProgressStatus;
use App\Enums\LMS\EnrollmentStatus;
use App\Http\Controllers\Controller;
use App\Models\LMS\CategoryProgress;
use App\Models\LMS\Course;
use App\Models\LMS\CourseCategory;
use App\Models\LMS\Enrollment;
use App\Models\LMS\Lesson;
use App\Models\LMS\LessonProgress;
use Illuminate\Http\Request;

class LMSController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $courses = Course::with(['categories.lessons' => function ($query) {
            $query->where('is_published', true)->orderBy('order');
        }])
            ->where('is_published', true)
            ->take(25)
            ->get();

        $pendingEnrollments = collect();
        $activeEnrollments = collect();

        if ($user) {
            $pendingEnrollments = Enrollment::where('user_id', $user->id)
                ->where('status', EnrollmentStatus::Pending->value)
                ->with('course')
                ->get();

            $activeEnrollments = Enrollment::where('user_id', $user->id)
                ->where('status', EnrollmentStatus::Active->value)
                ->with([
                    'course.categories' => function ($query) {
                        $query->where('is_published', true)
                            ->with(['lessons' => function ($q) {
                                $q->where('is_published', true)->select('id', 'category_id');
                            }]);
                    },
                    'categoryProgress',
                    'lessonProgress' => function ($query) {
                        $query->where('is_completed', true)->select('enrollment_id', 'lesson_id');
                    },
                ])
                ->get();
        }

        return view('pages.lms.index', compact('user', 'courses', 'pendingEnrollments', 'activeEnrollments'));
    }

    public function course(Course $course)
    {
        $user = auth()->user();
        $categories = $course->categories()
            ->where('is_published', true)
            ->orderBy('order')
            ->with(['lessons' => function ($query) {
                $query->where('is_published', true)->orderBy('order');
            }])
            ->get();

        $enrollment = null;
        $categoryProgressMap = collect();

        if ($user) {
            $enrollment = Enrollment::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->first();

            if ($enrollment && $enrollment->isActive()) {
                $categoryProgressMap = CategoryProgress::where('enrollment_id', $enrollment->id)
                    ->whereIn('category_id', $categories->pluck('id'))
                    ->get()
                    ->keyBy('category_id');
            }
        }

        return view('pages.lms.course', compact('user', 'course', 'categories', 'enrollment', 'categoryProgressMap'));
    }

    public function category(CourseCategory $category)
    {
        if (! $category->is_published) {
            abort(404);
        }

        $user = auth()->user();
        $course = $category->course;

        $lessons = $category->lessons()
            ->where('is_published', true)
            ->orderBy('order')
            ->get();

        $enrollment = null;
        $categoryProgress = null;
        $lessonProgressMap = collect();

        if ($user) {
            $enrollment = Enrollment::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->where('status', EnrollmentStatus::Active->value)
                ->first();

            if ($enrollment) {
                $categoryProgress = CategoryProgress::where('enrollment_id', $enrollment->id)
                    ->where('category_id', $category->id)
                    ->first();

                $lessonProgressMap = LessonProgress::where('enrollment_id', $enrollment->id)
                    ->whereIn('lesson_id', $lessons->pluck('id'))
                    ->get()
                    ->keyBy('lesson_id');
            }
        }

        return view('pages.lms.category', compact(
            'user', 'category', 'course', 'lessons',
            'enrollment', 'categoryProgress', 'lessonProgressMap'
        ));
    }

    public function lesson(Lesson $lesson)
    {
        if (! $lesson->is_published) {
            abort(404);
        }

        $user = auth()->user();
        $category = $lesson->category;
        $course = $category->course;

        $youtubeVideos = $lesson->youtubeVideos()
            ->where('is_published', true)
            ->orderBy('order')
            ->get();

        $prevLesson = Lesson::where('category_id', $lesson->category_id)
            ->where('order', '<', $lesson->order)
            ->where('is_published', true)
            ->orderBy('order', 'desc')
            ->first();

        $nextLesson = Lesson::where('category_id', $lesson->category_id)
            ->where('order', '>', $lesson->order)
            ->where('is_published', true)
            ->orderBy('order')
            ->first();

        $enrollment = null;
        $lessonProgress = null;
        $isCategoryLocked = false;

        if ($user) {
            $enrollment = Enrollment::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->where('status', EnrollmentStatus::Active->value)
                ->first();

            if ($enrollment) {
                $lessonProgress = LessonProgress::where('enrollment_id', $enrollment->id)
                    ->where('lesson_id', $lesson->id)
                    ->first();

                $catProgress = CategoryProgress::where('enrollment_id', $enrollment->id)
                    ->where('category_id', $lesson->category_id)
                    ->first();

                $isCategoryLocked = $catProgress && $catProgress->isLocked();
            }
        }

        return view('pages.lms.lesson', compact(
            'user', 'lesson', 'category', 'course', 'youtubeVideos',
            'prevLesson', 'nextLesson', 'enrollment', 'lessonProgress', 'isCategoryLocked'
        ));
    }

    public function allCourses(Request $request)
    {
        $user = auth()->user();
        $search = $request->get('search', '');

        $coursesQuery = Course::with(['categories.lessons' => function ($query) {
            $query->where('is_published', true)->orderBy('order');
        }])->where('is_published', true);

        if ($search) {
            $coursesQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $courses = $coursesQuery->paginate(12);

        return view('pages.lms.all-courses', compact('user', 'courses', 'search'));
    }
}
