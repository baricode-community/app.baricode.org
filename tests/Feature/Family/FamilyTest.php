<?php

use App\Models\User;

// --- Index ---

test('family index page loads successfully', function () {
    $this->get(route('family.index'))
        ->assertOk()
        ->assertViewIs('pages.general.family.index');
});

test('family index is accessible by guests', function () {
    $this->get(route('family.index'))
        ->assertOk();
});

test('family index is accessible by authenticated users', function () {
    $user = User::factory()->create();
    $this->actingAs($user)
        ->get(route('family.index'))
        ->assertOk();
});

test('family index returns all members', function () {
    User::factory()->count(5)->create();

    $response = $this->get(route('family.index'));

    $members = $response->viewData('members');
    expect($members)->toHaveCount(5);
});

test('family index members are ordered by creation date descending', function () {
    $user1 = User::factory()->create(['name' => 'Alice']);
    sleep(1);
    $user2 = User::factory()->create(['name' => 'Bob']);
    sleep(1);
    $user3 = User::factory()->create(['name' => 'Charlie']);

    $response = $this->get(route('family.index'));
    $members = $response->viewData('members');

    expect($members->first()->name)->toBe('Charlie')
        ->and($members->last()->name)->toBe('Alice');
});

test('family index search by name filters members', function () {
    User::factory()->create(['name' => 'John Doe', 'username' => 'johndoe']);
    User::factory()->create(['name' => 'Jane Smith', 'username' => 'janesmith']);

    $response = $this->get(route('family.index', ['q' => 'John']));

    $members = $response->viewData('members');
    expect($members->pluck('name')->toArray())->toContain('John Doe')
        ->and($members->pluck('name')->toArray())->not->toContain('Jane Smith');
});

test('family index search by username filters members', function () {
    User::factory()->create(['name' => 'John', 'username' => 'johndoe']);
    User::factory()->create(['name' => 'Jane', 'username' => 'janesmith']);

    $response = $this->get(route('family.index', ['q' => 'johndoe']));

    $members = $response->viewData('members');
    expect($members->pluck('username')->toArray())->toContain('johndoe')
        ->and($members->pluck('username')->toArray())->not->toContain('janesmith');
});

test('family index search returns empty when no matches', function () {
    User::factory()->count(3)->create();

    $response = $this->get(route('family.index', ['q' => 'nomatchhere123']));

    $members = $response->viewData('members');
    expect($members)->toHaveCount(0);
});

test('family index does not expose email field', function () {
    User::factory()->create(['email' => 'test@example.com']);

    $response = $this->get(route('family.index'));

    $response->assertOk();
    $response->assertDontSee('test@example.com');
});

test('family index does not expose phone_number field', function () {
    User::factory()->create(['phone_number' => '081234567890']);

    $response = $this->get(route('family.index'));

    $response->assertOk();
    $response->assertDontSee('081234567890');
});

test('family index pagination works correctly', function () {
    User::factory()->count(15)->create();

    $response = $this->get(route('family.index'));

    $members = $response->viewData('members');
    expect($members)->toHaveCount(12);
    expect($members->hasPages())->toBeTrue();
});

test('family index preserves search query in pagination', function () {
    User::factory()->count(3)->create(['name' => 'Test User']);
    User::factory()->count(15)->create(['name' => 'Other User']);

    $response = $this->get(route('family.index', ['q' => 'Test']));

    $response->assertOk();
    $response->assertViewHas('search', 'Test');
});

// --- Show ---

test('family show page loads for existing user', function () {
    $user = User::factory()->create(['username' => 'testuser']);

    $this->get(route('family.show', 'testuser'))
        ->assertOk()
        ->assertViewIs('pages.general.family.show')
        ->assertViewHas('user', fn ($u) => $u->id === $user->id);
});

test('family show page returns 404 for non-existent username', function () {
    $this->get(route('family.show', 'nonexistent'))
        ->assertNotFound();
});

test('family show page loads user relationships', function () {
    $user = User::factory()->create(['username' => 'testuser']);

    $response = $this->get(route('family.show', 'testuser'));

    $userData = $response->viewData('user');
    expect($userData->relationLoaded('meme'))->toBeTrue()
        ->and($userData->relationLoaded('dailyCommitTrackers'))->toBeTrue()
        ->and($userData->relationLoaded('meets'))->toBeTrue();
});

test('family show page displays user profile data correctly', function () {
    $user = User::factory()->create([
        'username' => 'testuser',
        'name' => 'Test User',
        'bio' => 'This is a test bio',
    ]);

    $response = $this->get(route('family.show', 'testuser'));

    $response->assertOk()
        ->assertSee('Test User')
        ->assertSee('This is a test bio');

    $userData = $response->viewData('user');
    expect($userData->username)->toBe('testuser');
});

test('family show page does not expose email field', function () {
    $user = User::factory()->create([
        'username' => 'testuser',
        'email' => 'test@example.com',
    ]);

    $response = $this->get(route('family.show', 'testuser'));

    $response->assertOk();
    $response->assertDontSee('test@example.com');
});

test('family show page does not expose phone_number field', function () {
    $user = User::factory()->create([
        'username' => 'testuser',
        'phone_number' => '081234567890',
    ]);

    $response = $this->get(route('family.show', 'testuser'));

    $response->assertOk();
    $response->assertDontSee('081234567890');
});

test('family show page displays daily commit count', function () {
    $user = User::factory()->create();
    $user->dailyCommitTrackers()->saveMany([
        \App\Models\DailyCommitTracker::factory()->make(['tracked_date' => now()]),
        \App\Models\DailyCommitTracker::factory()->make(['tracked_date' => now()->subDay()]),
    ]);

    $response = $this->get(route('family.show', $user->username));

    $response->assertOk();
    $userData = $response->viewData('user');
    expect($userData->dailyCommitTrackers)->toHaveCount(2);
});

test('family show page displays meets count', function () {
    $user = User::factory()->create();

    $response = $this->get(route('family.show', $user->username));

    $userData = $response->viewData('user');
    expect($userData->meets)->toHaveCount(0);
});
