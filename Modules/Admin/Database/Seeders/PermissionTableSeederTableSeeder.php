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
            'role-sa-list',
            'role-sa-create',
            'role-sa-edit',
            'role-sa-delete',

            'plan-sa-list',
            'plan-sa-create',
            'plan-sa-edit',
            'plan-sa-delete',

            'permission-sa-list',
            'permission-sa-create',
            'permission-sa-edit',
            'permission-sa-delete',

            'user-sa-list',
            'user-sa-create',
            'user-sa-edit',
            'user-sa-delete',

            'movement-sa-list',
            'movement-sa-create',
            'movement-sa-edit',
            'movement-sa-delete',

            'schedule-sa-list',
            'schedule-sa-create',
            'schedule-sa-edit',
            'schedule-sa-delete',

            'report-sa-list',
            'report-sa-create',
            'report-sa-edit',
            'report-sa-delete',

            'machine-sa-list',
            'machine-sa-create',
            'machine-sa-edit',
            'machine-sa-delete',

            'customer-sa-list',
            'customer-sa-create',
            'customer-sa-edit',
            'customer-sa-delete',

            'notification-sa-list',
            'notification-sa-create',
            'notification-sa-edit',
            'notification-sa-delete',
         ];
      
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission,'guard_name'=>'admin']);
         }
    }
}
