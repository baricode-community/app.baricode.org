<?php

use App\Models\DailyCommitTracker;
use App\Models\User;
use Illuminate\Support\Facades\DB;

test('daily commit tracker index requires authentication', function () {
    $this->get(route('daily-commit-tracker.index'))
        ->assertRedirect(route('login'));
});

test('daily commit tracker index loads for authenticated user', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('daily-commit-tracker.index'))
        ->assertOk();
});

test('daily commit tracker index redirects to show if entry exists today', function () {
    $user = User::factory()->create();
    $today = now()->toDateString();

    DB::table('daily_commit_trackers')->insert([
        'id' => 'test1',
        'user_id' => $user->id,
        'tracked_date' => $today,
        'title' => 'Test Entry',
        'message' => 'Test message',
        'impression' => 'Good',
        'success_level' => 8,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $this->actingAs($user)
        ->get(route('daily-commit-tracker.index'))
        ->assertRedirect(route('daily-commit-tracker.show', $today));
});

test('daily commit tracker show requires authentication', function () {
    $this->get(route('daily-commit-tracker.show', now()->toDateString()))
        ->assertRedirect(route('login'));
});

test('daily commit tracker show loads for authenticated user', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('daily-commit-tracker.show', now()->toDateString()))
        ->assertOk();
});

test('daily commit tracker history requires authentication', function () {
    $this->get(route('daily-commit-tracker.history'))
        ->assertRedirect(route('login'));
});

test('daily commit tracker history loads for authenticated user', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('daily-commit-tracker.history'))
        ->assertOk();
});

test('daily commit tracker history shows only current user entries', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();

    DailyCommitTracker::factory()->for($user)->create(['title' => 'Entri Saya']);
    DailyCommitTracker::factory()->for($otherUser)->create(['title' => 'Entri Orang Lain']);

    $this->actingAs($user)
        ->get(route('daily-commit-tracker.history'))
        ->assertSee('Entri Saya')
        ->assertDontSee('Entri Orang Lain');
});
