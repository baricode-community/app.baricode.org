<?php

namespace App\Http\Controllers\Web\General;

use App\Http\Controllers\Controller;
use App\Models\DailyCommitTracker;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DailyCommitTrackerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = now()->toDateString();

        $existingTracker = DailyCommitTracker::where('user_id', $user->id)
            ->where('tracked_date', $today)
            ->first();

        if ($existingTracker) {
            return redirect()->route('daily-commit-tracker.show', $today);
        }

        return view('pages.daily-commit-tracker.index');
    }

    public function show($date = null)
    {
        $user = Auth::user();
        $trackedDate = $date ? Carbon::createFromFormat('Y-m-d', $date)->toDateString() : now()->toDateString();

        $tracker = DailyCommitTracker::where('user_id', $user->id)
            ->where('tracked_date', $trackedDate)
            ->first();

        return view('pages.daily-commit-tracker.show', [
            'tracker' => $tracker,
            'trackedDate' => $trackedDate,
        ]);
    }

    public function history()
    {
        $user = Auth::user();
        $trackers = DailyCommitTracker::where('user_id', $user->id)
            ->orderBy('tracked_date', 'desc')
            ->paginate(10);

        return view('pages.daily-commit-tracker.history', [
            'trackers' => $trackers,
        ]);
    }
}
