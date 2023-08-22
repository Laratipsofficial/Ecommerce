<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Define roles
        $roles = [
            'superadmin' => 'Super Admin',
            'admin' => 'Admin',
            'cashier' => 'Cashier',
            'waiter' => 'Waiter',
            'desktop' => 'Desktop',
            'editor' => 'Content Editor',
            'tablet' => 'Tablet'
        ];

        // Define permissions per resource
        $permissions = [
            'menu' => [
                'view menu module',
                'view menu list',
                'view menu',
                'create menu',
                'edit menu',
                'delete menu',
            ],
            'discount' => [
                'view discounts module',
                'view discounts list',
                'view discount',
                'create discount',
                'edit discount',
                'delete discount',
            ],
            'orders' => [
                'view orders module',
                'view orders list',
                'create order',
                'edit order',
                'delete order',
            ],
            'tables' => [
                'view tables module',
                'view tables list',
                'create table',
                'edit table',
                'delete table',
            ],
            'content' => [
                'view content module',
                'view content list',
                'create content',
                'edit content',
                'delete content',
            ],
            'users' => [
                'view users module',
                'view users list',
                'create user',
                'edit user',
                'delete user',
            ],
            'roles' => [
                'view roles module',
                'view roles list',
                'create role',
                'edit role',
                'delete role',
            ],
            'permissions' => [
                'view permissions module',
                'view permissions list',
                'create permission',
                'edit permission',
                'delete permission',
            ],
        ];

        // Create roles and associated permissions
        foreach ($roles as $slug => $name) {
            $role = Role::create(['name' => $slug]);
        }

        foreach ($permissions as $resource => $perms) {
            foreach ($perms as $permission) {
                Permission::create(['name' => $permission]);
            }
        }

        //create users for each role
        foreach ($roles as $slug => $name) {
            $user = User::factory()->create([
                'name' => $name,
                'email' => $slug . '@goudendraak.com',
                'password' => 'password',
            ]);

            $user->assignRole($slug);
        }

        // give permissions to roles
        $role = Role::findByName('superadmin');

        // give all permissions to superadmin
        $permissions = Permission::all();

        $role->syncPermissions($permissions);

        // give all permissions to admin, except permissions, users and roles
        $role = Role::findByName('admin');

        $permissions = Permission::where('name', 'not like', 'view permissions%')
            ->where('name', 'not like', 'view users%')
            ->where('name', 'not like', 'view roles%')
            ->get();

        $role->syncPermissions($permissions);

        // give all permissions for orders and discounts to cashier
        $role = Role::findByName('cashier');

        $permissions = Permission::where('name', 'like', 'view orders%')
            ->orWhere('name', 'like', 'view discounts%')
            ->orWhere('name', 'like', 'create order%')
            ->orWhere('name', 'like', 'edit order%')
            ->orWhere('name', 'like', 'delete order%')
            ->orWhere('name', 'like', 'create discount%')
            ->orWhere('name', 'like', 'edit discount%')
            ->orWhere('name', 'like', 'delete discount%')
            ->get();

        $role->syncPermissions($permissions);

        // give all view permissions for orders and menu to waiter
        $role = Role::findByName('waiter');

        $permissions = Permission::where('name', 'like', 'view orders%')
            ->orWhere('name', 'like', 'view menu%')
            ->get();


        // give content editor permissions
        $role = Role::findByName('editor');

        $permissions = Permission::where('name', 'like', 'view content%')
            ->orWhere('name', 'like', 'create content%')
            ->orWhere('name', 'like', 'edit content%')
            ->orWhere('name', 'like', 'delete content%')
            ->get();

    }
}
