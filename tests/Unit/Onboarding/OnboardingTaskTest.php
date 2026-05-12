<?php

use App\Models\Onboarding\OnboardingTask;
use App\Models\Onboarding\OnboardingTaskCompletion;
use App\Models\User;

test('isCompletedBy returns false when user has not completed the task', function () {
    $user = User::factory()->create();
    $task = OnboardingTask::factory()->create();

    expect($task->isCompletedBy($user))->toBeFalse();
});

test('isCompletedBy returns true when user has completed the task', function () {
    $user = User::factory()->create();
    $task = OnboardingTask::factory()->create();

    OnboardingTaskCompletion::factory()->create([
        'user_id'            => $user->id,
        'onboarding_task_id' => $task->id,
        'completed_at'       => now(),
    ]);

    expect($task->isCompletedBy($user))->toBeTrue();
});

test('isCompletedBy only checks the given user', function () {
    $userA = User::factory()->create();
    $userB = User::factory()->create();
    $task  = OnboardingTask::factory()->create();

    OnboardingTaskCompletion::factory()->create([
        'user_id'            => $userB->id,
        'onboarding_task_id' => $task->id,
        'completed_at'       => now(),
    ]);

    expect($task->isCompletedBy($userA))->toBeFalse();
    expect($task->isCompletedBy($userB))->toBeTrue();
});

test('active scope returns only active tasks', function () {
    OnboardingTask::factory()->create(['is_active' => true]);
    OnboardingTask::factory()->create(['is_active' => false]);

    $active = OnboardingTask::active()->get();

    expect($active)->toHaveCount(1)
        ->and($active->first()->is_active)->toBeTrue();
});

test('active scope excludes inactive tasks', function () {
    OnboardingTask::factory()->count(2)->create(['is_active' => false]);

    expect(OnboardingTask::active()->count())->toBe(0);
});

test('tasks are ordered by order column', function () {
    OnboardingTask::factory()->create(['order' => 3, 'title' => 'Third']);
    OnboardingTask::factory()->create(['order' => 1, 'title' => 'First']);
    OnboardingTask::factory()->create(['order' => 2, 'title' => 'Second']);

    $tasks = OnboardingTask::orderBy('order')->get();

    expect($tasks->pluck('title')->toArray())
        ->toBe(['First', 'Second', 'Third']);
});
