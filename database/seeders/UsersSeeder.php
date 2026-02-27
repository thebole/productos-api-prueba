<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'products.view',
            'products.view.price',
            'products.create',
            'products.update',
            'products.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $editorRole = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);
        $viewerRole = Role::firstOrCreate(['name' => 'viewer', 'guard_name' => 'web']);

        $adminRole->syncPermissions($permissions);
        $editorRole->syncPermissions([
            'products.view',
            'products.view.price',
            'products.create',
            'products.update',
        ]);
        $viewerRole->syncPermissions([
            'products.view',
            'products.view.price',
        ]);

        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin User', 'password' => 'password']
        );

        $editor = User::updateOrCreate(
            ['email' => 'operator@example.com'],
            ['name' => 'Operator User', 'password' => 'password']
        );

        $viewer = User::updateOrCreate(
            ['email' => 'viewer@example.com'],
            ['name' => 'Viewer User', 'password' => 'password']
        );

        $admin->syncRoles([$adminRole]);
        $editor->syncRoles([$editorRole]);
        $viewer->syncRoles([$viewerRole]);
    }
}
