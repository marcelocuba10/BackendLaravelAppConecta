<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $faker = Faker::create();
        // foreach(range(1,100) as $index){
        //     DB::table('posts')->insert([
        //         'title' => $faker->text(40),
        //         'body' => $faker->text(299),
        //     ]);
        // }

        Model::unguard();

        $this->call(PermissionTableSeederTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(CreateUserAdminTableSeeder::class);
    }
}
