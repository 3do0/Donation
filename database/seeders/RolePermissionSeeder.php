<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // إنشاء صلاحيات
        $permissions = ['view posts', 'edit posts', 'delete posts'];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // إنشاء أدوار وربط الصلاحيات
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo($permissions);

        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo(['view posts']);
    }
}

