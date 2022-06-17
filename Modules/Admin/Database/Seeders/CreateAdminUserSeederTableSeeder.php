<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\SuperUser;

//spatie
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeederTableSeeder extends Seeder
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
            'username' => 'superadmin', 
            'email' => 'admin@admin.com',
            'password' => 'teste123',
            'terms' => '1'
        ]);
    
        $role = Role::create(['name' => 'SuperAdmin','guard_name' => 'admin'],);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
    }
}
