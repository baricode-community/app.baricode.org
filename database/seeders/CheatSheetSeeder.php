<?php

namespace Database\Seeders;

use App\Models\CheatSheet;
use App\Models\CheatSheetCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class CheatSheetSeeder extends Seeder
{
    public function run(): void
    {
        $categories = CheatSheetCategory::factory(8)->create();
        $users = User::inRandomOrder()->limit(10)->get();

        foreach ($users as $user) {
            CheatSheet::factory(rand(1, 4))
                ->for($user)
                ->recycle($categories)
                ->create();
        }
    }
}
