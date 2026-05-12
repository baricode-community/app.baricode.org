<?php

namespace App\Http\Controllers\Web\General;

use App\Http\Controllers\Controller;
use App\Models\Onboarding\OnboardingTask;
use App\Models\Onboarding\OnboardingTaskCompletion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OnboardingController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $tasks = OnboardingTask::active()
            ->orderBy('order')
            ->get()
            ->map(fn ($task) => $task->setAttribute('is_completed', $task->isCompletedBy($user)));

        return view('pages.general.dashboard.onboarding.index', compact('tasks'));
    }

    public function show(OnboardingTask $task): View
    {
        $user = Auth::user();
        $isCompleted = $task->isCompletedBy($user);

        return view('pages.general.dashboard.onboarding.show', compact('task', 'isCompleted'));
    }

    public function toggle(OnboardingTask $task): RedirectResponse
    {
        $user = Auth::user();

        $completion = OnboardingTaskCompletion::where('user_id', $user->id)
            ->where('onboarding_task_id', $task->id)
            ->first();

        if ($completion) {
            $completion->delete();
        } else {
            OnboardingTaskCompletion::create([
                'user_id'             => $user->id,
                'onboarding_task_id'  => $task->id,
                'completed_at'        => now(),
            ]);
        }

        return redirect()->back();
    }
}
