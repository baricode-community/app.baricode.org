<?php

namespace Database\Seeders\LMS;

use App\Models\LMS\Course;
use App\Models\LMS\CourseCategory;
use App\Models\LMS\Lesson;
use Illuminate\Database\Seeder;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();

        if ($courses->isEmpty()) {
            return;
        }

        foreach ($courses as $course) {
            // Create 3-5 categories for each course
            for ($i = 1; $i <= rand(3, 5); $i++) {
                $category = CourseCategory::create([
                    'course_id' => $course->id,
                    'title' => 'Module '.$i,
                    'description' => "This is module {$i} for course: {$course->title}",
                    'order' => $i,
                    'is_published' => true,
                ]);

                // Create 4-8 lessons for each category
                for ($j = 1; $j <= rand(4, 8); $j++) {
                    Lesson::create([
                        'category_id' => $category->id,
                        'title' => "Lesson {$j}: ".ucwords(str_replace('-', ' ', fake()->slug(3))),
                        'description' => fake()->sentence(),
                        'content' => fake()->paragraphs(3, true),
                        'order' => $j,
                        'is_published' => true,
                    ]);
                }
            }
        }
    }
}
