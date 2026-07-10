<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // // 1. Create Permissions
        // Permission::create(['name' => 'suspend users']);
        // Permission::create(['name' => 'delete posts']);
        // Permission::create(['name' => 'disable comments']);
        // Permission::create(['name' => 'view dashboard']);

        // // 2. Create Roles and Assign Permissions
        // $adminRole = Role::create(['name' => 'admin']);
        // $adminRole->givePermissionTo(Permission::all());

        // $userRole = Role::create(['name' => 'user']);
        $bannedRole = Role::create(['name' => 'banned']);
        // Normal users don't need special permissions explicitly assigned;
        // they just won't have the admin ones.
    }
}