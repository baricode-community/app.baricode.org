<?php

namespace Database\Seeders\LMS;

use App\Models\LMS\Course;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            return;
        }

        foreach ($users as $user) {
            for ($i = 0; $i < 5; $i++) {
                Course::create([
                    'title' => 'Course Title '.Str::random(5),
                    'description' => 'This is a description for course '.Str::random(5),
                    'slug' => Str::slug('course-title-'.Str::random(5)).'-'.Str::random(5),
                    'is_published' => (bool) rand(0, 1),
                ]);
            }
        }
    }
}
