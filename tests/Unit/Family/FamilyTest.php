<?php

use App\Models\User;

// --- User Model Fields ---

test('user has name field', function () {
    $user = User::factory()->make(['name' => 'John Doe']);
    expect($user->name)->toBe('John Doe');
});

test('user has username field', function () {
    $user = User::factory()->make(['username' => 'johndoe']);
    expect($user->username)->toBe('johndoe');
});

test('user has bio field', function () {
    $user = User::factory()->make(['bio' => 'I am a developer']);
    expect($user->bio)->toBe('I am a developer');
});

test('user has email field', function () {
    $user = User::factory()->make(['email' => 'john@example.com']);
    expect($user->email)->toBe('john@example.com');
});

test('user has phone_number field', function () {
    $user = User::factory()->make(['phone_number' => '081234567890']);
    // phone_number is cast to integer in model
    expect($user->phone_number)->toBe(81234567890);
});

test('user has created_at timestamp', function () {
    $user = User::factory()->create();
    expect($user->created_at)->toBeInstanceOf(\DateTime::class);
});

test('user initials method returns correct initials', function () {
    $user = User::factory()->make(['name' => 'John Doe']);
    expect($user->initials())->toBe('JD');
});

test('user initials method handles single name', function () {
    $user = User::factory()->make(['name' => 'John']);
    expect($user->initials())->toBe('J');
});

test('user initials method handles three names', function () {
    $user = User::factory()->make(['name' => 'John Michael Doe']);
    expect($user->initials())->toBe('JM');
});

// --- Query Selection Tests ---

test('user select query excludes email field', function () {
    $user = User::factory()->create(['email' => 'test@example.com']);

    $selected = User::select(['name', 'username', 'bio', 'created_at'])->find($user->id);

    expect($selected->name)->toBe($user->name);
    expect($selected->hasAttribute('email'))->toBeFalse();
});

test('user select query excludes phone_number field', function () {
    $user = User::factory()->create(['phone_number' => '081234567890']);

    $selected = User::select(['name', 'username', 'bio', 'created_at'])->find($user->id);

    // Check that phone_number is not in the selected attributes
    expect($selected->getAttributes())->not->toHaveKey('phone_number');
});

test('user select query includes safe fields', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'username' => 'testuser',
        'bio' => 'Test bio',
    ]);

    $selected = User::select(['name', 'username', 'bio', 'created_at'])->find($user->id);

    expect($selected->name)->toBe('Test User')
        ->and($selected->username)->toBe('testuser')
        ->and($selected->bio)->toBe('Test bio')
        ->and($selected->created_at)->toBeTruthy();
});

// --- Relationships ---

test('user has many daily commit trackers', function () {
    $user = User::factory()->create();
    $user->dailyCommitTrackers()->saveMany([
        \App\Models\DailyCommitTracker::factory()->make(['tracked_date' => now()]),
        \App\Models\DailyCommitTracker::factory()->make(['tracked_date' => now()->subDay()]),
    ]);

    expect($user->dailyCommitTrackers)->toHaveCount(2);
});

test('user can have one meme', function () {
    $user = User::factory()->create();

    expect($user->meme)->toBeNull();
});

test('user belongs to many meets', function () {
    $user = User::factory()->create();

    expect($user->meets)->toHaveCount(0);
});
