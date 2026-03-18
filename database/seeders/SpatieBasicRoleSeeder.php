<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SpatieBasicRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'user',
        ];
        collect($roles)->each(function ($role) {
            Role::firstOrCreate(['name' => $role]);
        });
    }
}
