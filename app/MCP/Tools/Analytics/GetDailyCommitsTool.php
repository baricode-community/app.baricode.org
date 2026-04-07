<?php

namespace App\MCP\Tools\Analytics;

use App\Models\DailyCommitTracker;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Content\Text;

class GetDailyCommitsTool extends Tool
{
    public function name(): string
    {
        return 'get_daily_commits';
    }

    public function description(): string
    {
        return 'Get recent daily commit tracker records with user info, success level, and tracked date. Limit to recent 50 records.';
    }

    public function handle(array $input): Text
    {
        $limit = min($input['limit'] ?? 50, 200);

        $commits = DailyCommitTracker::with('user:id,name,username')
            ->select('id', 'user_id', 'title', 'message', 'success_level', 'tracked_date', 'created_at')
            ->latest('tracked_date')
            ->limit($limit)
            ->get()
            ->map(fn ($commit) => [
                'id' => $commit->id,
                'user' => [
                    'name' => $commit->user->name,
                    'username' => $commit->user->username,
                ],
                'title' => $commit->title,
                'message' => $commit->message,
                'success_level' => $commit->success_level,
                'tracked_date' => $commit->tracked_date->format('Y-m-d'),
                'created_at' => $commit->created_at->format('Y-m-d H:i:s'),
            ]);

        return Text::make(json_encode($commits, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }
}
