<?php

namespace App\MCP\Tools\Analytics;

use App\Models\DailyCommitTracker;
use App\Models\Fun\Meme;
use App\Models\LMS\Course;
use App\Models\LMS\Enrollment;
use App\Models\User;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Content\Text;

class GetPlatformStatsTool extends Tool
{
    public function name(): string
    {
        return 'get_platform_stats';
    }

    public function description(): string
    {
        return 'Get overall platform statistics including member count, active enrollments, courses, memes, and daily commits tracked';
    }

    public function handle(array $input): Text
    {
        $stats = [
            'total_members' => User::count(),
            'total_active_enrollments' => Enrollment::whereIn('status', ['active', 'pending'])->count(),
            'total_enrollments' => Enrollment::count(),
            'total_published_courses' => Course::where('is_published', true)->count(),
            'total_courses' => Course::count(),
            'total_memes' => Meme::count(),
            'total_daily_commits' => DailyCommitTracker::count(),
            'active_users_with_commits' => DailyCommitTracker::distinct('user_id')->count('user_id'),
        ];

        return Text::make(json_encode($stats, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}
