<?php

namespace Database\Seeders\RepoHub;

use App\Models\RepoHub\RepoHub;
use App\Models\RepoHub\RepoHubTag;
use Illuminate\Database\Seeder;

class RepoHubSeeder extends Seeder
{
    public function run(): void
    {
        $tags = RepoHubTag::factory(10)->create();

        RepoHub::factory(15)->create()->each(function (RepoHub $repoHub) use ($tags) {
            $repoHub->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')
            );
        });
    }
}
