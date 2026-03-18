<?php

namespace Database\Seeders;

use App\Models\Meet;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserMeet;
use Database\Factories\LMS\CourseFactory;
use Database\Seeders\LMS\CourseSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SpatieBasicRoleSeeder::class);
        User::factory(10)->create();

        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'username' => 'testuser',
                'bio' => 'This is a test user.',
                'phone_number' => '123-456-7890',
                'password' => 'password',
                'email_verified_at' => now(),
            ]
        );
        $user->assignRole('admin');

        Meet::factory(5)->create();
        UserMeet::factory(15)->create();
        
        $this->call([
            DailyCommitTrackerSeeder::class,
            CourseSeeder::class,
            \Database\Seeders\LMS\CourseCategorySeeder::class,
            TimelineSeeder::class,
            \Database\Seeders\Quiz\QuizSeeder::class,
            ShortLinkSeeder::class,
        ]);
    }
}
