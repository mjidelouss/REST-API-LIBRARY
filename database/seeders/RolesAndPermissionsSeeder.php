<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

//use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions for books
        Permission::create(['name' => 'add book']);
        Permission::create(['name' => 'edit every book']);
        Permission::create(['name' => 'edit my book']);
        Permission::create(['name' => 'delete every book']);
        Permission::create(['name' => 'delete my book']);

        // Create permissions for genres
        Permission::create(['name' => 'show genre']);
        Permission::create(['name' => 'add genre']);
        Permission::create(['name' => 'edit genre']);
        Permission::create(['name' => 'delete genre']);

        // Create permissions for Roles
        Permission::create(['name' => 'show role']);
        Permission::create(['name' => 'add role']);
        Permission::create(['name' => 'edit role']);
        Permission::create(['name' => 'delete role']);
        Permission::create(['name' => 'assign role']);

        // Create permissions for Profile
        Permission::create(['name' => 'edit my profile']);
        Permission::create(['name' => 'edit every profile']);
        Permission::create(['name' => 'delete my profile']);
        Permission::create(['name' => 'delete every profile']);

        // Create permission for assigning permissions to roles
        Permission::create(['name' => 'assign permission']);

        Role::create(['name' => 'admin'])
            ->givePermissionTo(Permission::all());

        Role::create(['name' => 'receptionist'])
            ->givePermissionTo(
                'add book',
                'edit my book',
                'delete my book',
                'edit my profile',
                'delete my profile'
            );

        Role::create(['name' => 'user'])
            ->givePermissionTo(
                'edit my profile',
                'delete my profile'
            );
    }
}
