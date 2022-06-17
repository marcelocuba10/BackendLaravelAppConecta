<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Permission;

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

            'super_user-list',
            'super_user-create',
            'super_user-edit',
            'super_user-delete',

            'movement-list',
            'movement-create',
            'movement-edit',
            'movement-delete',

            'report-list',
            'report-create',
            'report-edit',
            'report-delete',
         ];
      
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission,'guard_name'=>'admin']);
         }
    }
}
