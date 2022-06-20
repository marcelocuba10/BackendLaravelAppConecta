<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;

//spatie
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $user =  User::create([
            'name' => 'User teste', 
            'last_name' => 'teste', 
            'phone' => '168451212', 
            'address' => 'av mensu 521',
            'ci' => '1234567',
            'email' => 'user@user.com',
            'password' => 'teste123',

            'company_name' => 'empresa one', 
            'manager' => 'roberto carlos',
            'ruc' => '45255-2', 
            'location_iframe' => 'url maps aqui',
            'terms' => '1',
            'status' => '1'
        ]);

        $role = Role::create(['name' => 'Admin','guard_name' => 'web'],);
     
        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->syncRoles(['Admin']);
     
        $user->assignRole([$role->id]);
    }
}
