<?php

namespace App\Http\Controllers\Web\LMS;

use App\Http\Controllers\Controller;
use App\Models\LMS\Course;
use App\Models\LMS\CourseCategory;
use App\Models\LMS\Lesson;
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
            // ->inRandomOrder()
            ->get();

        return view('pages.lms.index', compact('user', 'courses'));
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

        return view('pages.lms.course', compact('user', 'course', 'categories'));
    }

    public function category(CourseCategory $category)
    {
        // Check if category is published
        if (! $category->is_published) {
            abort(404);
        }

        $user = auth()->user();
        $course = $category->course;

        // Get lessons for this category
        $lessons = $category->lessons()
            ->where('is_published', true)
            ->orderBy('order')
            ->get();

        return view('pages.lms.category', compact('user', 'category', 'course', 'lessons'));
    }

    public function lesson(Lesson $lesson)
    {
        // Check if lesson is published
        if (! $lesson->is_published) {
            abort(404);
        }

        $user = auth()->user();
        $category = $lesson->category;
        $course = $category->course;

        // Get youtube videos for this lesson
        $youtubeVideos = $lesson->youtubeVideos()
            ->where('is_published', true)
            ->orderBy('order')
            ->get();

        // Get previous and next lessons
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

        return view('pages.lms.lesson', compact('user', 'lesson', 'category', 'course', 'youtubeVideos', 'prevLesson', 'nextLesson'));
    }

    public function allCourses(Request $request)
    {
        $user = auth()->user();
        $search = $request->get('search', '');

        $coursesQuery = Course::with(['categories.lessons' => function ($query) {
            $query->where('is_published', true)->orderBy('order');
        }])->where('is_published', true);

        // Search functionality
        if ($search) {
            $coursesQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Pagination with 12 courses per page
        $courses = $coursesQuery->paginate(12);

        return view('pages.lms.all-courses', compact('user', 'courses', 'search'));
    }
}
