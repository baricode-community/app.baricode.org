<?php

namespace App\Http\Controllers\Web\General;

use App\Enums\LMS\EnrollmentStatus;
use App\Http\Controllers\Controller;
use App\Models\LMS\Enrollment;
use App\Models\Onboarding\OnboardingTask;
use App\Models\Timeline;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalCommits = $user->dailyCommitTrackers()->count();
        $commitStreak = $this->calculateStreak($user);
        $recentCommit = $user->dailyCommitTrackers()->latest('tracked_date')->first();

        $activeEnrollments = Enrollment::with('course')
            ->where('user_id', $user->id)
            ->whereIn('status', [EnrollmentStatus::Active->value, EnrollmentStatus::Pending->value])
            ->latest()
            ->take(3)
            ->get();

        $completedEnrollments = Enrollment::where('user_id', $user->id)
            ->where('status', EnrollmentStatus::Completed->value)
            ->count();

        $totalMembers = User::count();

        $timelines = [
            'ongoing' => Timeline::where('status', 'ongoing')->count(),
            'completed' => Timeline::where('status', 'completed')->count(),
        ];

        $onboardingTasks = OnboardingTask::active()
            ->orderBy('order')
            ->get()
            ->map(fn ($task) => $task->setAttribute('is_completed', $task->isCompletedBy($user)));

        $onboardingTotal     = $onboardingTasks->count();
        $onboardingCompleted = $onboardingTasks->filter(fn ($t) => $t->is_completed)->count();

        return view('pages.general.dashboard.index', compact(
            'user',
            'totalCommits',
            'commitStreak',
            'recentCommit',
            'activeEnrollments',
            'completedEnrollments',
            'totalMembers',
            'timelines',
            'onboardingTasks',
            'onboardingTotal',
            'onboardingCompleted',
        ));
    }

    private function calculateStreak(User $user): int
    {
        $dates = $user->dailyCommitTrackers()
            ->orderByDesc('tracked_date')
            ->pluck('tracked_date')
            ->map(fn ($d) => $d->toDateString())
            ->unique()
            ->values();

        if ($dates->isEmpty()) {
            return 0;
        }

        $streak = 0;
        $current = now()->toDateString();

        foreach ($dates as $date) {
            if ($date === $current) {
                $streak++;
                $current = now()->subDays($streak)->toDateString();
            } else {
                break;
            }
        }

        return $streak;
    }

    public function analytics()
    {
        return view('pages.general.dashboard.analytics');
    }

    public function settings()
    {
        return view('pages.general.dashboard.settings');
    }

    public function fun()
    {
        return view('pages.general.dashboard.fun');
    }

    public function memes()
    {
        return view('pages.general.dashboard.memes');
    }
}
