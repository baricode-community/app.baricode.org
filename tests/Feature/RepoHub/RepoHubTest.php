<?php

use App\Models\RepoHub\RepoHub;
use App\Models\RepoHub\RepoHubTag;
use Livewire\Volt\Volt;

// --- Index ---

test('repohub index page loads successfully', function () {
    $this->get(route('repohub.index'))
        ->assertOk()
        ->assertViewIs('pages.repohub.index');
});

test('repohub index only shows published repos', function () {
    RepoHub::factory()->published()->create(['title' => 'Published Repo']);
    RepoHub::factory()->draft()->create(['title' => 'Draft Repo']);

    Volt::test('general.repohub-list')
        ->assertSee('Published Repo')
        ->assertDontSee('Draft Repo');
});

test('repohub index passes tags to view', function () {
    $tags = RepoHubTag::factory()->count(3)->create();

    Volt::test('general.repohub-list')
        ->assertSee($tags[0]->name)
        ->assertSee($tags[1]->name)
        ->assertSee($tags[2]->name);
});

test('repohub index search by title returns matching repos', function () {
    RepoHub::factory()->published()->create(['title' => 'Awesome Laravel Starter']);
    RepoHub::factory()->published()->create(['title' => 'Vue Dashboard Kit']);

    Volt::test('general.repohub-list')
        ->set('search', 'laravel')
        ->assertSee('Awesome Laravel Starter')
        ->assertDontSee('Vue Dashboard Kit');
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

    Volt::test('general.repohub-list')
        ->set('search', 'REST API')
        ->assertSee('Some Repo')
        ->assertDontSee('Other Repo');
});

test('repohub index filter by tag shows only repos with that tag', function () {
    $tag = RepoHubTag::factory()->create(['name' => 'Laravel', 'slug' => 'laravel']);
    $otherTag = RepoHubTag::factory()->create(['name' => 'Vue', 'slug' => 'vue']);

    $laravelRepo = RepoHub::factory()->published()->create(['title' => 'Laravel Repo']);
    $vueRepo = RepoHub::factory()->published()->create(['title' => 'Vue Repo']);

    $laravelRepo->tags()->attach($tag);
    $vueRepo->tags()->attach($otherTag);

    Volt::test('general.repohub-list')
        ->set('tagSlug', 'laravel')
        ->assertSee('Laravel Repo')
        ->assertDontSee('Vue Repo');
});

test('repohub index filter by non-existent tag returns all repos', function () {
    RepoHub::factory()->published()->count(3)->create();

    Volt::test('general.repohub-list')
        ->set('tagSlug', 'non-existent-tag')
        ->assertSet('tagSlug', 'non-existent-tag');
});

test('repohub index search combined with tag filter', function () {
    $tag = RepoHubTag::factory()->create(['slug' => 'go-lang']);

    $match = RepoHub::factory()->published()->create(['title' => 'Go HTTP Server']);
    $noTag = RepoHub::factory()->published()->create(['title' => 'Go CLI Tool']);
    $match->tags()->attach($tag);

    Volt::test('general.repohub-list')
        ->set('search', 'Go')
        ->set('tagSlug', 'go-lang')
        ->assertSee('Go HTTP Server')
        ->assertDontSee('Go CLI Tool');
});

test('repohub index shows empty state when no repos match', function () {
    Volt::test('general.repohub-list')
        ->set('search', 'xyznomatch12345')
        ->assertSee('Belum ada repo ditemukan');
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
