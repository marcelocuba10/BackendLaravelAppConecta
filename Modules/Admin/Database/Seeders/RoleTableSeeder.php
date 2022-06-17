<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

//spatie
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleTableSeeder extends Seeder
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

        Model::unguard();

        //Create role
        $role = Role::create([
            'name' => 'Guest',
            'guard_name' => 'admin'
        ]);

        //Assign permissions
        $role->givePermissionTo('user-list');
        $role->givePermissionTo('user-create');
        $role->givePermissionTo('user-edit');
        $role->givePermissionTo('user-delete');
        
    }
}
