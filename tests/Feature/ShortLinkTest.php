<?php

use App\Models\ShortLink;

test('active short link renders redirect page', function () {
    $shortLink = ShortLink::factory()->active()->create([
        'slug' => 'test-link',
        'real_url' => 'https://example.com',
    ]);

    $response = $this->get(route('short-link.redirect', 'test-link'));

    $response->assertStatus(200);
    $response->assertViewIs('pages.link.redirect');
    $response->assertViewHas('shortLink', fn ($link) => $link->id === $shortLink->id);
});

test('active short link increments click count on visit', function () {
    $shortLink = ShortLink::factory()->active()->create([
        'slug' => 'click-test',
        'click_count' => 0,
    ]);

    $this->get(route('short-link.redirect', 'click-test'));

    expect($shortLink->fresh()->click_count)->toBe(1);
});

test('inactive short link returns 404', function () {
    ShortLink::factory()->inactive()->create(['slug' => 'inactive-link']);

    $this->get(route('short-link.redirect', 'inactive-link'))
        ->assertNotFound();
});

test('expired short link returns 404', function () {
    ShortLink::factory()->expired()->create(['slug' => 'expired-link']);

    $this->get(route('short-link.redirect', 'expired-link'))
        ->assertNotFound();
});

test('non-existent short link slug returns 404', function () {
    $this->get(route('short-link.redirect', 'does-not-exist'))
        ->assertNotFound();
});

test('short link with future expiry is still accessible', function () {
    ShortLink::factory()->create([
        'slug' => 'future-expiry',
        'is_active' => true,
        'expired_at' => now()->addDays(7),
    ]);

    $this->get(route('short-link.redirect', 'future-expiry'))
        ->assertStatus(200);
});

test('short link with null expiry is accessible', function () {
    ShortLink::factory()->active()->create(['slug' => 'no-expiry']);

    $this->get(route('short-link.redirect', 'no-expiry'))
        ->assertStatus(200);
});

test('short link isAccessible returns true for active non-expired link', function () {
    $link = ShortLink::factory()->active()->make();
    expect($link->isAccessible())->toBeTrue();
});

test('short link isAccessible returns false when inactive', function () {
    $link = ShortLink::factory()->inactive()->make();
    expect($link->isAccessible())->toBeFalse();
});

test('short link isAccessible returns false when expired', function () {
    $link = ShortLink::factory()->expired()->make();
    expect($link->isAccessible())->toBeFalse();
});

test('short link isExpired returns true when expired_at is in the past', function () {
    $link = new ShortLink(['expired_at' => now()->subHour()]);
    expect($link->isExpired())->toBeTrue();
});

test('short link isExpired returns false when expired_at is null', function () {
    $link = new ShortLink(['expired_at' => null]);
    expect($link->isExpired())->toBeFalse();
});

test('short link active scope returns only active non-expired links', function () {
    ShortLink::factory()->active()->create(['slug' => 'visible-1']);
    ShortLink::factory()->active()->create(['slug' => 'visible-2']);
    ShortLink::factory()->inactive()->create(['slug' => 'hidden-inactive']);
    ShortLink::factory()->expired()->create(['slug' => 'hidden-expired']);

    $active = ShortLink::active()->get();

    expect($active)->toHaveCount(2)
        ->and($active->pluck('slug')->toArray())->toContain('visible-1', 'visible-2');
});

test('short link factory creates valid model', function () {
    $link = ShortLink::factory()->create();

    expect($link->title)->not->toBeEmpty()
        ->and($link->real_url)->not->toBeEmpty()
        ->and($link->slug)->not->toBeEmpty();
});
