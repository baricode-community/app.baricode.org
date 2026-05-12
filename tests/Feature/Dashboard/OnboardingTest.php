<?php

use App\Models\Onboarding\OnboardingTask;
use App\Models\Onboarding\OnboardingTaskCompletion;
use App\Models\User;

// ─── Access control ───────────────────────────────────────────────────────────

test('guest cannot access onboarding index', function () {
    $this->get(route('dashboard.onboarding.index'))
        ->assertRedirect(route('login'));
});

test('guest cannot access onboarding task detail', function () {
    $task = OnboardingTask::factory()->create();

    $this->get(route('dashboard.onboarding.show', $task->slug))
        ->assertRedirect(route('login'));
});

test('guest cannot toggle onboarding task', function () {
    $task = OnboardingTask::factory()->create();

    $this->post(route('dashboard.onboarding.toggle', $task->slug))
        ->assertRedirect(route('login'));
});

// ─── Index page ───────────────────────────────────────────────────────────────

test('authenticated user can view onboarding index', function () {
    $user = User::factory()->create();
    OnboardingTask::factory()->count(3)->create();

    $this->actingAs($user)
        ->get(route('dashboard.onboarding.index'))
        ->assertOk()
        ->assertViewIs('pages.general.dashboard.onboarding.index');
});

test('onboarding index only shows active tasks', function () {
    $user = User::factory()->create();
    $active = OnboardingTask::factory()->create(['is_active' => true]);
    $inactive = OnboardingTask::factory()->create(['is_active' => false]);

    $response = $this->actingAs($user)
        ->get(route('dashboard.onboarding.index'));

    $response->assertSee($active->title);
    $response->assertDontSee($inactive->title);
});

test('onboarding index marks completed tasks for the current user', function () {
    $user = User::factory()->create();
    $task = OnboardingTask::factory()->create();
    OnboardingTaskCompletion::factory()->create([
        'user_id'            => $user->id,
        'onboarding_task_id' => $task->id,
        'completed_at'       => now(),
    ]);

    $response = $this->actingAs($user)
        ->get(route('dashboard.onboarding.index'));

    $tasks = $response->viewData('tasks');
    expect($tasks->first()->is_completed)->toBeTrue();
});

// ─── Show page ────────────────────────────────────────────────────────────────

test('authenticated user can view task detail', function () {
    $user = User::factory()->create();
    $task = OnboardingTask::factory()->create();

    $this->actingAs($user)
        ->get(route('dashboard.onboarding.show', $task->slug))
        ->assertOk()
        ->assertViewIs('pages.general.dashboard.onboarding.show')
        ->assertSee($task->title);
});

test('task detail shows correct completion status', function () {
    $user = User::factory()->create();
    $task = OnboardingTask::factory()->create();

    $response = $this->actingAs($user)
        ->get(route('dashboard.onboarding.show', $task->slug));

    expect($response->viewData('isCompleted'))->toBeFalse();

    OnboardingTaskCompletion::factory()->create([
        'user_id'            => $user->id,
        'onboarding_task_id' => $task->id,
        'completed_at'       => now(),
    ]);

    $response = $this->actingAs($user)
        ->get(route('dashboard.onboarding.show', $task->slug));

    expect($response->viewData('isCompleted'))->toBeTrue();
});

test('viewing task detail by non-existent slug returns 404', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('dashboard.onboarding.show', 'tidak-ada'))
        ->assertNotFound();
});

// ─── Toggle ───────────────────────────────────────────────────────────────────

test('user can complete a task', function () {
    $user = User::factory()->create();
    $task = OnboardingTask::factory()->create();

    $this->actingAs($user)
        ->post(route('dashboard.onboarding.toggle', $task->slug))
        ->assertRedirect();

    expect(
        OnboardingTaskCompletion::where('user_id', $user->id)
            ->where('onboarding_task_id', $task->id)
            ->exists()
    )->toBeTrue();
});

test('user can uncomplete a completed task', function () {
    $user = User::factory()->create();
    $task = OnboardingTask::factory()->create();

    OnboardingTaskCompletion::factory()->create([
        'user_id'            => $user->id,
        'onboarding_task_id' => $task->id,
        'completed_at'       => now(),
    ]);

    $this->actingAs($user)
        ->post(route('dashboard.onboarding.toggle', $task->slug))
        ->assertRedirect();

    expect(
        OnboardingTaskCompletion::where('user_id', $user->id)
            ->where('onboarding_task_id', $task->id)
            ->exists()
    )->toBeFalse();
});

test('toggling task does not affect other users', function () {
    $userA = User::factory()->create();
    $userB = User::factory()->create();
    $task  = OnboardingTask::factory()->create();

    OnboardingTaskCompletion::factory()->create([
        'user_id'            => $userB->id,
        'onboarding_task_id' => $task->id,
        'completed_at'       => now(),
    ]);

    $this->actingAs($userA)
        ->post(route('dashboard.onboarding.toggle', $task->slug));

    expect(
        OnboardingTaskCompletion::where('user_id', $userB->id)
            ->where('onboarding_task_id', $task->id)
            ->exists()
    )->toBeTrue();
});

// ─── Dashboard banner ─────────────────────────────────────────────────────────

test('dashboard shows onboarding banner when active tasks exist', function () {
    $user = User::factory()->create();
    OnboardingTask::factory()->create(['is_active' => true]);

    $this->actingAs($user)
        ->get(route('dashboard'))
        ->assertOk()
        ->assertViewHas('onboardingTotal', 1);
});

test('dashboard passes correct completion count to view', function () {
    $user = User::factory()->create();
    $tasks = OnboardingTask::factory()->count(3)->create(['is_active' => true]);

    OnboardingTaskCompletion::factory()->create([
        'user_id'            => $user->id,
        'onboarding_task_id' => $tasks->first()->id,
        'completed_at'       => now(),
    ]);

    $response = $this->actingAs($user)->get(route('dashboard'));

    expect($response->viewData('onboardingCompleted'))->toBe(1);
    expect($response->viewData('onboardingTotal'))->toBe(3);
});
