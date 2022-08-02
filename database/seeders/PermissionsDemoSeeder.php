<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit employee']);
        Permission::create(['name' => 'delete employee']);
        Permission::create(['name' => 'create employee']);
        Permission::create(['name' => 'read employee']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'manager']);
        $role1->givePermissionTo('edit employee');
        $role1->givePermissionTo('read employee');

        $role2 = Role::create(['name' => 'users']);
        $role2->givePermissionTo('read employee');

        $role3 = Role::create(['name' => 'admin']);
        $role3->givePermissionTo('edit employee');
        $role3->givePermissionTo('read employee');
        $role3->givePermissionTo('create employee');
        $role3->givePermissionTo('delete employee');


        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'manager test',
            'email' => 'manager@test.com',
            'password' => bcrypt('manager123'),
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'user test',
            'email' => 'user@test.com',
            'password' => bcrypt('user123'),
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'admin test',
            'email' => 'admin@test.com',
            'password' => bcrypt('admin123'),

        ]);
        $user->assignRole($role3);
    }}
