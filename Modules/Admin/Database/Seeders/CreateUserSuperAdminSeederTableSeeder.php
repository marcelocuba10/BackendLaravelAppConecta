<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\SuperUser;

//spatie
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateUserSuperAdminSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $user = SuperUser::create([
            'name' => 'Super User', 
            'last_name' => 'superadmin', 
            'ci' => '1234567', 
            'email' => 'admin@admin.com',
            'password' => 'teste123',
            'status' => '1',
            'email_verified_at' => now(),
        ]);
    
        $role = Role::create([
            'name' => 'SuperAdmin',
            'guard_name' => 'admin',
            'system_role' => '1'
        ],);
        
        $permissions = Permission::where('guard_name', '=', 'admin')->pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->syncRoles(['SuperAdmin']);
        $user->assignRole([$role->id]);
    }
}
