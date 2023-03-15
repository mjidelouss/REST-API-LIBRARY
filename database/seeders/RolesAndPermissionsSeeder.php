<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // Reset cached roles and permissions
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    // Define permissions
    $permissions = [
        'add article',
        'edit my article',
        'edit every article',
        'delete my article',
        'delete every article',
        'show category',
        'add category',
        'edit category',
        'delete category',
        'show tag',
        'add tag',
        'edit tag',
        'delete tag',
        'add comment',
        'edit my comment',
        'edit every comment',
        'delete my comment',
        'delete every comment',
        'show role',
        'add role',
        'edit role',
        'delete role',
        'assign role',
    ];

    // Create permissions
    foreach ($permissions as $permission) {
        Permission::create(['name' => $permission]);
    }

    // Define roles and their permissions
    $roles = [
        'admin' => Permission::all(),
        'publisher' => [
            'add article',
            'edit my article',
            'delete my article',
            'add comment',
            'edit my comment',
            'delete my comment',
        ],
        'user' => [
            'add comment',
            'edit my comment',
            'delete my comment',
        ],
    ];

    // Create roles and assign permissions
    foreach ($roles as $name => $permissions) {
        $role = Role::create(['name' => $name]);
        $role->givePermissionTo($permissions);
    }
}

}
