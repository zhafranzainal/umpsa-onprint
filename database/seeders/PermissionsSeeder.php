<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list campuses']);
        Permission::create(['name' => 'view campuses']);
        Permission::create(['name' => 'create campuses']);
        Permission::create(['name' => 'update campuses']);
        Permission::create(['name' => 'delete campuses']);

        Permission::create(['name' => 'list categories']);
        Permission::create(['name' => 'view categories']);
        Permission::create(['name' => 'create categories']);
        Permission::create(['name' => 'update categories']);
        Permission::create(['name' => 'delete categories']);

        Permission::create(['name' => 'list complaints']);
        Permission::create(['name' => 'view complaints']);
        Permission::create(['name' => 'create complaints']);
        Permission::create(['name' => 'update complaints']);
        Permission::create(['name' => 'delete complaints']);

        Permission::create(['name' => 'list deliveries']);
        Permission::create(['name' => 'view deliveries']);
        Permission::create(['name' => 'create deliveries']);
        Permission::create(['name' => 'update deliveries']);
        Permission::create(['name' => 'delete deliveries']);

        Permission::create(['name' => 'list deliveryoptions']);
        Permission::create(['name' => 'view deliveryoptions']);
        Permission::create(['name' => 'create deliveryoptions']);
        Permission::create(['name' => 'update deliveryoptions']);
        Permission::create(['name' => 'delete deliveryoptions']);

        Permission::create(['name' => 'list feedbacks']);
        Permission::create(['name' => 'view feedbacks']);
        Permission::create(['name' => 'create feedbacks']);
        Permission::create(['name' => 'update feedbacks']);
        Permission::create(['name' => 'delete feedbacks']);

        Permission::create(['name' => 'list inventories']);
        Permission::create(['name' => 'view inventories']);
        Permission::create(['name' => 'create inventories']);
        Permission::create(['name' => 'update inventories']);
        Permission::create(['name' => 'delete inventories']);

        Permission::create(['name' => 'list orders']);
        Permission::create(['name' => 'view orders']);
        Permission::create(['name' => 'create orders']);
        Permission::create(['name' => 'update orders']);
        Permission::create(['name' => 'delete orders']);

        Permission::create(['name' => 'list outlets']);
        Permission::create(['name' => 'view outlets']);
        Permission::create(['name' => 'create outlets']);
        Permission::create(['name' => 'update outlets']);
        Permission::create(['name' => 'delete outlets']);

        Permission::create(['name' => 'list packages']);
        Permission::create(['name' => 'view packages']);
        Permission::create(['name' => 'create packages']);
        Permission::create(['name' => 'update packages']);
        Permission::create(['name' => 'delete packages']);

        Permission::create(['name' => 'list riders']);
        Permission::create(['name' => 'view riders']);
        Permission::create(['name' => 'create riders']);
        Permission::create(['name' => 'update riders']);
        Permission::create(['name' => 'delete riders']);

        Permission::create(['name' => 'list transactions']);
        Permission::create(['name' => 'view transactions']);
        Permission::create(['name' => 'create transactions']);
        Permission::create(['name' => 'update transactions']);
        Permission::create(['name' => 'delete transactions']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
