<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        DB::table('admin_roles')->truncate();

        DB::table('admin_roles')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Administrator',
                'slug' => 'administrator',
                'created_at' => '2021-01-13 09:29:54',
                'updated_at' => '2021-01-13 09:29:54',
            ),
        ));


    }
}
