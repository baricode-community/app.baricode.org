<?php

use App\Models\RepoHub\RepoHub;
use App\Models\RepoHub\RepoHubTag;

// --- Model ---

test('repohub factory creates valid model', function () {
    $repo = RepoHub::factory()->create();

    expect($repo->title)->not->toBeEmpty()
        ->and($repo->slug)->not->toBeEmpty()
        ->and($repo->description)->not->toBeEmpty()
        ->and($repo->repo_url)->not->toBeEmpty()
        ->and($repo->why_recommended)->not->toBeEmpty();
});

test('repohub published scope returns only published repos', function () {
    RepoHub::factory()->published()->create(['title' => 'Visible']);
    RepoHub::factory()->published()->create(['title' => 'Also Visible']);
    RepoHub::factory()->draft()->create(['title' => 'Hidden']);

    $result = RepoHub::published()->get();

    expect($result)->toHaveCount(2)
        ->and($result->pluck('title')->toArray())->not->toContain('Hidden');
});

test('repohub published factory state sets is_published to true', function () {
    $repo = RepoHub::factory()->published()->make();

    expect($repo->is_published)->toBeTrue();
});

test('repohub draft factory state sets is_published to false', function () {
    $repo = RepoHub::factory()->draft()->make();

    expect($repo->is_published)->toBeFalse();
});

test('repohub demo_url is nullable', function () {
    $repo = RepoHub::factory()->make(['demo_url' => null]);

    expect($repo->demo_url)->toBeNull();
});

test('repohub is_published casts to boolean', function () {
    $repo = RepoHub::factory()->make(['is_published' => 1]);

    expect($repo->is_published)->toBeBool()->toBeTrue();
});

test('repohub tags relationship returns correct tags', function () {
    $repo = RepoHub::factory()->create();
    $tags = RepoHubTag::factory()->count(3)->create();
    $repo->tags()->attach($tags->pluck('id'));

    expect($repo->tags)->toHaveCount(3);
});

test('repohub detaching tags works correctly', function () {
    $repo = RepoHub::factory()->create();
    $tags = RepoHubTag::factory()->count(2)->create();
    $repo->tags()->attach($tags->pluck('id'));
    $repo->tags()->detach($tags->first()->id);

    expect($repo->fresh()->tags)->toHaveCount(1);
});

// --- RepoHubTag Model ---

test('repohub tag factory creates valid model', function () {
    $tag = RepoHubTag::factory()->create();

    expect($tag->name)->not->toBeEmpty()
        ->and($tag->slug)->not->toBeEmpty();
});

test('repohub tag repoHubs relationship returns correct repos', function () {
    $tag = RepoHubTag::factory()->create();
    $repos = RepoHub::factory()->count(2)->create();
    $tag->repoHubs()->attach($repos->pluck('id'));

    expect($tag->repoHubs)->toHaveCount(2);
});

test('repohub tag slug is unique', function () {
    RepoHubTag::factory()->create(['slug' => 'laravel']);

    expect(fn () => RepoHubTag::factory()->create(['slug' => 'laravel']))
        ->toThrow(\Illuminate\Database\QueryException::class);
});

test('repohub slug is unique', function () {
    RepoHub::factory()->create(['slug' => 'my-repo']);

    expect(fn () => RepoHub::factory()->create(['slug' => 'my-repo']))
        ->toThrow(\Illuminate\Database\QueryException::class);
});
