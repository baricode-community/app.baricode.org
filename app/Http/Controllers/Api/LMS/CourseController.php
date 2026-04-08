<?php

namespace App\Http\Controllers\Api\LMS;

use App\Http\Controllers\Controller;
use App\Models\LMS\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of all published courses with their content.
     */
    public function index()
    {
        $courses = Course::with([
            'categories' => function ($query) {
                $query->where('is_published', true)
                    ->orderBy('order')
                    ->with([
                        'lessons' => function ($q) {
                            $q->where('is_published', true)
                                ->orderBy('order')
                                ->with('youtubeVideos');
                        },
                    ]);
            },
        ])
            ->where('is_published', true)
            ->orderBy('title')
            ->get();

        return response()->json($courses);
    }

    /**
     * Display the specified course with its content.
     */
    public function show(Course $course)
    {
        $course->load([
            'categories' => function ($query) {
                $query->where('is_published', true)
                    ->orderBy('order')
                    ->with([
                        'lessons' => function ($q) {
                            $q->where('is_published', true)
                                ->orderBy('order')
                                ->with('youtubeVideos');
                        },
                    ]);
            },
        ]);

        return response()->json($course);
    }
}
