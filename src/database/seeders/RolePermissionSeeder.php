<?php

namespace Database\Seeders;

use App\Enums\PermissionEnums;
use App\Enums\RolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $persmissions = PermissionEnums::cases();

        $adminRole = Role::findOrCreate(RolesEnum::ADMIN->value);
        $userRole = Role::findOrCreate(RolesEnum::User->value);
        $superAdmin = Role::findOrCreate(RolesEnum::SUPER_ADMIN->value);

        foreach ($persmissions as $persmission) {
            Permission::findOrCreate(
                $persmission->value
            );
        }

        $adminRole->givePermissionTo($persmissions);

    }
}
