<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => 123,
        ]);

        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'user@example.com',
            'password' => 123,
        ]);

        $super_admin = User::factory()->create([
            'name' => 'super_admin',
            'email' => 'super_admin@example.com',
            'password' => 123,
        ]);

        $this->call([
            RolePermissionSeeder::class,
        ]);

    }
}
