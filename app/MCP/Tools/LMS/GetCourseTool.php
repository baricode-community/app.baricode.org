<?php

namespace App\MCP\Tools\LMS;

use App\Models\LMS\Course;
use App\Models\LMS\Enrollment;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Content\Text;

class GetCourseTool extends Tool
{
    public function name(): string
    {
        return 'get_course';
    }

    public function description(): string
    {
        return 'Get course detail with categories and lesson summaries';
    }

    public function handle(array $input): Text
    {
        $course = Course::with(['categories.lessons:id,category_id,title,duration,is_published'])
            ->select('id', 'title', 'slug', 'description', 'is_published', 'created_at')
            ->find($input['course_id']);

        if (!$course) {
            return Text::make(json_encode(['error' => 'Course not found'], JSON_UNESCAPED_SLASHES));
        }

        $enrollmentCount = Enrollment::where('course_id', $course->id)
            ->whereIn('status', ['active', 'pending', 'completed'])
            ->count();

        $data = [
            'id' => $course->id,
            'title' => $course->title,
            'slug' => $course->slug,
            'description' => $course->description,
            'is_published' => (bool) $course->is_published,
            'enrollment_count' => $enrollmentCount,
            'category_count' => $course->categories->count(),
            'categories' => $course->categories->map(fn ($category) => [
                'id' => $category->id,
                'title' => $category->title,
                'slug' => $category->slug,
                'description' => $category->description,
                'is_published' => (bool) $category->is_published,
                'order' => $category->order,
                'lesson_count' => $category->lessons->count(),
                'lessons' => $category->lessons->map(fn ($lesson) => [
                    'id' => $lesson->id,
                    'title' => $lesson->title,
                    'duration' => $lesson->duration,
                    'is_published' => (bool) $lesson->is_published,
                ]),
            ]),
            'created_at' => $course->created_at->format('Y-m-d H:i:s'),
        ];

        return Text::make(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}
