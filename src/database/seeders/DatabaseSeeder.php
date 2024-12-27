<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Schema;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->seedUsers();

        $this->call([
            TaskSeeder::class,
        ]);

    }

    private function seedUsers()
    {
        Schema::disableForeignKeyConstraints();
        Task::truncate();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        $adminRole = Role::findOrCreate(RolesEnum::ADMIN->value);
        $userRole = Role::findOrCreate(RolesEnum::User->value);
        $superAdmin = Role::findOrCreate(RolesEnum::SUPER_ADMIN->value);

        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => 123,
        ])->assignRole($adminRole);

        $user = User::factory()->create([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => 123,
        ])->assignRole($userRole);

        $super_admin = User::factory()->create([
            'name' => 'super_admin',
            'email' => 'super_admin@example.com',
            'password' => 123,
        ])->assignRole($superAdmin);

        User::factory(10)->create()->each(function (User $user) use ($userRole) {
            $user->assignRole($userRole);
        });
    }
}
