<?php

use App\Models\RepoHub\RepoHub;
use App\Models\RepoHub\RepoHubTag;

// --- Index ---

test('repohub index page loads successfully', function () {
    $this->get(route('repohub.index'))
        ->assertOk()
        ->assertViewIs('pages.repohub.index');
});

test('repohub index only shows published repos', function () {
    RepoHub::factory()->published()->create(['title' => 'Published Repo']);
    RepoHub::factory()->draft()->create(['title' => 'Draft Repo']);

    $response = $this->get(route('repohub.index'));

    $response->assertOk();
    $repos = $response->viewData('repos');

    expect($repos->pluck('title')->toArray())->toContain('Published Repo')
        ->and($repos->pluck('title')->toArray())->not->toContain('Draft Repo');
});

test('repohub index passes tags to view', function () {
    RepoHubTag::factory()->count(3)->create();

    $response = $this->get(route('repohub.index'));

    $response->assertOk();
    expect($response->viewData('tags'))->toHaveCount(3);
});

test('repohub index search by title returns matching repos', function () {
    RepoHub::factory()->published()->create(['title' => 'Awesome Laravel Starter']);
    RepoHub::factory()->published()->create(['title' => 'Vue Dashboard Kit']);

    $response = $this->get(route('repohub.index', ['q' => 'laravel']));

    $repos = $response->viewData('repos');

    expect($repos->pluck('title')->toArray())->toContain('Awesome Laravel Starter')
        ->and($repos->pluck('title')->toArray())->not->toContain('Vue Dashboard Kit');
});

test('repohub index search by description returns matching repos', function () {
    RepoHub::factory()->published()->create([
        'title' => 'Some Repo',
        'description' => 'Framework untuk membuat REST API dengan cepat',
    ]);
    RepoHub::factory()->published()->create([
        'title' => 'Other Repo',
        'description' => 'Library animasi yang ringan',
    ]);

    $response = $this->get(route('repohub.index', ['q' => 'REST API']));

    $repos = $response->viewData('repos');

    expect($repos->pluck('title')->toArray())->toContain('Some Repo')
        ->and($repos->pluck('title')->toArray())->not->toContain('Other Repo');
});

test('repohub index filter by tag shows only repos with that tag', function () {
    $tag = RepoHubTag::factory()->create(['name' => 'Laravel', 'slug' => 'laravel']);
    $otherTag = RepoHubTag::factory()->create(['name' => 'Vue', 'slug' => 'vue']);

    $laravelRepo = RepoHub::factory()->published()->create(['title' => 'Laravel Repo']);
    $vueRepo = RepoHub::factory()->published()->create(['title' => 'Vue Repo']);

    $laravelRepo->tags()->attach($tag);
    $vueRepo->tags()->attach($otherTag);

    $response = $this->get(route('repohub.index', ['tag' => 'laravel']));

    $repos = $response->viewData('repos');

    expect($repos->pluck('title')->toArray())->toContain('Laravel Repo')
        ->and($repos->pluck('title')->toArray())->not->toContain('Vue Repo');
});

test('repohub index filter by non-existent tag returns all repos', function () {
    RepoHub::factory()->published()->count(3)->create();

    $response = $this->get(route('repohub.index', ['tag' => 'non-existent-tag']));

    $response->assertOk();
    expect($response->viewData('activeTag'))->toBeNull();
});

test('repohub index search combined with tag filter', function () {
    $tag = RepoHubTag::factory()->create(['slug' => 'go-lang']);

    $match = RepoHub::factory()->published()->create(['title' => 'Go HTTP Server']);
    $noTag = RepoHub::factory()->published()->create(['title' => 'Go CLI Tool']);
    $match->tags()->attach($tag);

    $response = $this->get(route('repohub.index', ['q' => 'Go', 'tag' => 'go-lang']));

    $repos = $response->viewData('repos');

    expect($repos->pluck('title')->toArray())->toContain('Go HTTP Server')
        ->and($repos->pluck('title')->toArray())->not->toContain('Go CLI Tool');
});

test('repohub index shows empty state when no repos match', function () {
    $this->get(route('repohub.index', ['q' => 'xyznomatch12345']))
        ->assertOk()
        ->assertViewHas('repos', fn ($repos) => $repos->isEmpty());
});

// --- Show ---

test('repohub show page loads for published repo', function () {
    $repo = RepoHub::factory()->published()->create(['slug' => 'my-cool-repo']);

    $this->get(route('repohub.show', 'my-cool-repo'))
        ->assertOk()
        ->assertViewIs('pages.repohub.show')
        ->assertViewHas('repoHub', fn ($r) => $r->id === $repo->id);
});

test('repohub show page returns 404 for unpublished repo', function () {
    RepoHub::factory()->draft()->create(['slug' => 'hidden-repo']);

    $this->get(route('repohub.show', 'hidden-repo'))
        ->assertNotFound();
});

test('repohub show page returns 404 for non-existent slug', function () {
    $this->get(route('repohub.show', 'does-not-exist'))
        ->assertNotFound();
});

test('repohub show page loads tags relationship', function () {
    $tag = RepoHubTag::factory()->create(['name' => 'Docker']);
    $repo = RepoHub::factory()->published()->create(['slug' => 'docker-repo']);
    $repo->tags()->attach($tag);

    $response = $this->get(route('repohub.show', 'docker-repo'));

    $repoHub = $response->viewData('repoHub');

    expect($repoHub->tags)->toHaveCount(1)
        ->and($repoHub->tags->first()->name)->toBe('Docker');
});

test('repohub show page works for repo without demo url', function () {
    RepoHub::factory()->published()->create([
        'slug' => 'no-demo-repo',
        'demo_url' => null,
    ]);

    $this->get(route('repohub.show', 'no-demo-repo'))
        ->assertOk();
});
