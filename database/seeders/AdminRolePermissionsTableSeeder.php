<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminRolePermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        DB::table('admin_role_permissions')->truncate();

        DB::table('admin_role_permissions')->insert(array (
            0 =>
            array (
                'role_id' => 1,
                'permission_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));

    }
}
