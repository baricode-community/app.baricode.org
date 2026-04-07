<?php

namespace App\MCP\Tools\LMS;

use App\Models\LMS\Course;
use App\Models\LMS\Enrollment;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Content\Text;

class ListCoursesTool extends Tool
{
    public function name(): string
    {
        return 'list_courses';
    }

    public function description(): string
    {
        return 'Get list of courses with publication status, category count, and enrollment count';
    }

    public function handle(array $input): Text
    {
        $query = Course::with('categories:id,course_id');

        if ($input['published_only'] ?? true) {
            $query->where('is_published', true);
        }

        $courses = $query->select('id', 'title', 'slug', 'description', 'is_published', 'created_at')
            ->get()
            ->map(function ($course) {
                $enrollmentCount = Enrollment::where('course_id', $course->id)
                    ->whereIn('status', ['active', 'pending', 'completed'])
                    ->count();

                return [
                    'id' => $course->id,
                    'title' => $course->title,
                    'slug' => $course->slug,
                    'description' => $course->description,
                    'is_published' => (bool) $course->is_published,
                    'category_count' => $course->categories->count(),
                    'enrollment_count' => $enrollmentCount,
                    'created_at' => $course->created_at->format('Y-m-d H:i:s'),
                ];
            });

        return Text::make(json_encode($courses, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}
