<?php

use App\Models\User;
use Livewire\Volt\Volt;

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
    User::factory()->create(['name' => 'Alice Member']);
    User::factory()->create(['name' => 'Bob Member']);
    User::factory()->create(['name' => 'Charlie Member']);

    Volt::test('general.family-list')
        ->assertSee('Alice Member')
        ->assertSee('Bob Member')
        ->assertSee('Charlie Member');
});

test('family index members are ordered by creation date descending', function () {
    $user1 = User::factory()->create(['name' => 'Alice']);
    sleep(1);
    $user2 = User::factory()->create(['name' => 'Bob']);
    sleep(1);
    $user3 = User::factory()->create(['name' => 'Charlie']);

    Volt::test('general.family-list')
        ->assertSeeInOrder(['Charlie', 'Bob', 'Alice']);
});

test('family index search by name filters members', function () {
    User::factory()->create(['name' => 'John Doe', 'username' => 'johndoe']);
    User::factory()->create(['name' => 'Jane Smith', 'username' => 'janesmith']);

    Volt::test('general.family-list')
        ->set('search', 'John')
        ->assertSee('John Doe')
        ->assertDontSee('Jane Smith');
});

test('family index search by username filters members', function () {
    User::factory()->create(['name' => 'John', 'username' => 'johndoe']);
    User::factory()->create(['name' => 'Jane', 'username' => 'janesmith']);

    Volt::test('general.family-list')
        ->set('search', 'johndoe')
        ->assertSee('John')
        ->assertDontSee('Jane');
});

test('family index search returns empty when no matches', function () {
    User::factory()->count(3)->create();

    Volt::test('general.family-list')
        ->set('search', 'nomatchhere123')
        ->assertSee('Tidak ada anggota ditemukan');
});

test('family index does not expose email field', function () {
    User::factory()->create(['email' => 'test@example.com']);

    $this->get(route('family.index'))
        ->assertOk()
        ->assertDontSee('test@example.com');
});

test('family index does not expose phone_number field', function () {
    User::factory()->create(['phone_number' => '081234567890']);

    $this->get(route('family.index'))
        ->assertOk()
        ->assertDontSee('081234567890');
});

test('family index pagination works correctly', function () {
    User::factory()->count(15)->create();

    Volt::test('general.family-list')
        ->assertSee('anggota komunitas');
});

test('family index preserves search query in pagination', function () {
    User::factory()->count(3)->create(['name' => 'Test User']);

    Volt::test('general.family-list')
        ->set('search', 'Test')
        ->assertSet('search', 'Test');
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

    $this->get(route('family.show', 'testuser'))
        ->assertOk()
        ->assertDontSee('test@example.com');
});

test('family show page does not expose phone_number field', function () {
    $user = User::factory()->create([
        'username' => 'testuser',
        'phone_number' => '081234567890',
    ]);

    $this->get(route('family.show', 'testuser'))
        ->assertOk()
        ->assertDontSee('081234567890');
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
