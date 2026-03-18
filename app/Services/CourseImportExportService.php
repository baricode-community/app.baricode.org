<?php

namespace App\Services;

use App\Models\LMS\Course;
use App\Models\LMS\CourseCategory;
use App\Models\LMS\Lesson;
use App\Models\LMS\YoutubeList;
use Exception;
use Illuminate\Support\Facades\DB;

class CourseImportExportService
{
    /**
     * Import a course from JSON data
     *
     * @throws Exception
     */
    public function importCourse(array $data): Course
    {
        return DB::transaction(function () use ($data) {
            // Validate required fields
            if (empty($data['title'])) {
                throw new Exception('Course title is required');
            }

            // Create or update course
            $course = Course::updateOrCreate(
                ['slug' => $data['slug'] ?? str($data['title'])->slug()],
                [
                    'title' => $data['title'],
                    'description' => $data['description'] ?? '',
                    'is_published' => $data['is_published'] ?? false,
                ]
            );

            // Import categories
            if (! empty($data['categories']) && is_array($data['categories'])) {
                foreach ($data['categories'] as $categoryData) {
                    $this->importCategory($course, $categoryData);
                }
            }

            return $course;
        });
    }

    /**
     * Import a course category
     *
     * @throws Exception
     */
    private function importCategory(Course $course, array $categoryData): CourseCategory
    {
        if (empty($categoryData['title'])) {
            throw new Exception('Category title is required');
        }

        $category = CourseCategory::updateOrCreate(
            [
                'course_id' => $course->id,
                'title' => $categoryData['title'],
            ],
            [
                'description' => $categoryData['description'] ?? '',
                'order' => $categoryData['order'] ?? 0,
                'is_published' => $categoryData['is_published'] ?? false,
            ]
        );

        // Import lessons
        if (! empty($categoryData['lessons']) && is_array($categoryData['lessons'])) {
            foreach ($categoryData['lessons'] as $lessonData) {
                $this->importLesson($category, $lessonData);
            }
        }

        return $category;
    }

    /**
     * Import a lesson
     *
     * @throws Exception
     */
    private function importLesson(CourseCategory $category, array $lessonData): Lesson
    {
        if (empty($lessonData['title'])) {
            throw new Exception('Lesson title is required');
        }

        $lesson = Lesson::updateOrCreate(
            [
                'category_id' => $category->id,
                'title' => $lessonData['title'],
            ],
            [
                'description' => $lessonData['description'] ?? '',
                'content' => $lessonData['content'] ?? '',
                'order' => $lessonData['order'] ?? 0,
                'duration' => $lessonData['duration'] ?? 0,
                'is_published' => $lessonData['is_published'] ?? false,
            ]
        );

        // Import YouTube videos
        if (! empty($lessonData['youtube_list']) && is_array($lessonData['youtube_list'])) {
            foreach ($lessonData['youtube_list'] as $youtubeData) {
                $this->importYoutubeVideo($lesson, $youtubeData);
            }
        }

        return $lesson;
    }

    /**
     * Import a YouTube video
     *
     * @throws Exception
     */
    private function importYoutubeVideo(Lesson $lesson, array $youtubeData): YoutubeList
    {
        if (empty($youtubeData['youtube_url'])) {
            throw new Exception('YouTube URL is required');
        }

        return YoutubeList::updateOrCreate(
            [
                'lesson_id' => $lesson->id,
                'youtube_url' => $youtubeData['youtube_url'],
            ],
            [
                'title' => $youtubeData['title'] ?? '',
                'description' => $youtubeData['description'] ?? '',
                'order' => $youtubeData['order'] ?? 0,
                'is_published' => $youtubeData['is_published'] ?? false,
            ]
        );
    }

    /**
     * Export a course to JSON array
     */
    public function exportCourse(Course $course): array
    {
        return [
            'title' => $course->title,
            'description' => $course->description,
            'slug' => $course->slug,
            'is_published' => $course->is_published,
            'categories' => $course->categories->map(function (CourseCategory $category) {
                return $this->exportCategory($category);
            })->toArray(),
        ];
    }

    /**
     * Export a course category to array
     */
    private function exportCategory(CourseCategory $category): array
    {
        return [
            'title' => $category->title,
            'description' => $category->description,
            'order' => $category->order,
            'is_published' => $category->is_published,
            'lessons' => $category->lessons->map(function (Lesson $lesson) {
                return $this->exportLesson($lesson);
            })->toArray(),
        ];
    }

    /**
     * Export a lesson to array
     */
    private function exportLesson(Lesson $lesson): array
    {
        return [
            'title' => $lesson->title,
            'description' => $lesson->description,
            'content' => $lesson->content,
            'order' => $lesson->order,
            'duration' => $lesson->duration,
            'is_published' => $lesson->is_published,
            'youtube_list' => $lesson->youtubeVideos->map(function (YoutubeList $video) {
                return $this->exportYoutubeVideo($video);
            })->toArray(),
        ];
    }

    /**
     * Export a YouTube video to array
     */
    private function exportYoutubeVideo(YoutubeList $video): array
    {
        return [
            'youtube_url' => $video->youtube_url,
            'title' => $video->title,
            'description' => $video->description,
            'order' => $video->order,
            'is_published' => $video->is_published,
        ];
    }
}
