<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\Permission;

class PermissionTableSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            
            'movement-list',
            'movement-create',
            'movement-edit',
            'movement-delete',

            'report-list',
            'report-create',
            'report-edit',
            'report-delete',

            'notification-list',
            'notification-create',
            'notification-edit',
            'notification-delete',
         ];
      
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission,'guard_name'=>'web']);
         }
    }
}
