<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;  

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Define permissions
        $permissions = [
            'create proposal',
            'view proposal',
            'edit proposal',
            'delete proposal',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign permissions to roles
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();
        $managerRole = Role::where('name', 'manager')->first();

        if ($adminRole) {
            $adminRole->givePermissionTo(Permission::all());
        }

        if ($userRole) {
            $userRole->givePermissionTo(['create proposal', 'view proposal']);
        }

        if ($managerRole) {
            $managerRole->givePermissionTo(['view proposal', 'edit proposal', 'delete proposal']);
        }
    }
}