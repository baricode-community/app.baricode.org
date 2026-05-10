<?php

use App\Models\Fun\Meme;
use App\Models\User;

test('meme index page loads successfully', function () {
    $this->get(route('meme.index'))
        ->assertOk();
});

test('meme user list page loads successfully', function () {
    $this->get(route('meme.users'))
        ->assertOk();
});

test('meme user page loads for existing user', function () {
    $user = User::factory()->create();

    $this->get(route('meme.user', $user->username))
        ->assertOk();
});

test('meme user page shows create button for own profile', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('meme.user', $user->username))
        ->assertSee(route('meme.create'));
});

test('meme user page does not show create button for other profiles', function () {
    $viewer = User::factory()->create();
    $owner = User::factory()->create();

    $this->actingAs($viewer)
        ->get(route('meme.user', $owner->username))
        ->assertDontSee(route('meme.create'));
});

test('meme create page requires authentication', function () {
    $this->get(route('meme.create'))
        ->assertRedirect(route('login'));
});

test('meme create page loads for authenticated users', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('meme.create'))
        ->assertOk();
});

test('meme show page loads for existing meme', function () {
    $user = User::factory()->create();
    $meme = Meme::create([
        'user_id' => $user->id,
        'caption' => 'Test meme caption',
    ]);

    $this->get(route('meme.show', $meme->id))
        ->assertOk();
});
