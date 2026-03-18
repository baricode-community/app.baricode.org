<?php

namespace Database\Seeders;

use App\Models\DailyCommitTracker;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DailyCommitTrackerSeeder extends Seeder
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
            for ($i = 0; $i < 7; $i++) {
                DailyCommitTracker::create([
                    'id' => Str::random(5),
                    'user_id' => $user->id,
                    'title' => 'Learning Progress Day '.($i + 1),
                    'message' => 'Today I worked on implementing new features and fixing bugs. The productivity level was quite good.',
                    'impression' => 'It was a good day. I managed to complete most of the planned tasks and learned some new concepts.',
                    'success_level' => rand(6, 10),
                    'tracked_date' => now()->subDays(6 - $i)->toDateString(),
                ]);
            }
        }
    }
}
