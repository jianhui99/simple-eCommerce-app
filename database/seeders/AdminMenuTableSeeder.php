<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_menu')->truncate();

        DB::table('admin_menu')->insert(array (
            0 =>
            array (
                'id' => 1,
                'parent_id' => 0,
                'order' => 1,
                'title' => 'Dashboard',
                'icon' => 'fa-bar-chart',
                'uri' => '/',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-02-11 02:19:47',
            ),
            1 =>
            array (
                'id' => 2,
                'parent_id' => 0,
                'order' => 4,
                'title' => 'Admin',
                'icon' => 'fa-tasks',
                'uri' => '',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-07-08 17:37:25',
            ),
            2 =>
            array (
                'id' => 3,
                'parent_id' => 2,
                'order' => 5,
                'title' => 'Users',
                'icon' => 'fa-users',
                'uri' => 'auth/users',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-07-08 17:37:25',
            ),
            3 =>
            array (
                'id' => 4,
                'parent_id' => 2,
                'order' => 6,
                'title' => 'Roles',
                'icon' => 'fa-user',
                'uri' => 'auth/roles',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-07-08 17:37:25',
            ),
            4 =>
            array (
                'id' => 5,
                'parent_id' => 2,
                'order' => 7,
                'title' => 'Permission',
                'icon' => 'fa-ban',
                'uri' => 'auth/permissions',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-07-08 17:37:25',
            ),
            5 =>
            array (
                'id' => 6,
                'parent_id' => 2,
                'order' => 8,
                'title' => 'Menu',
                'icon' => 'fa-bars',
                'uri' => 'auth/menu',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-07-08 17:37:25',
            ),
            6 =>
            array (
                'id' => 7,
                'parent_id' => 2,
                'order' => 9,
                'title' => 'Operation log',
                'icon' => 'fa-history',
                'uri' => 'auth/logs',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2021-07-08 17:37:25',
            ),
            7 =>
            array (
                'id' => 10,
                'parent_id' => 0,
                'order' => 2,
                'title' => 'Wp Product',
                'icon' => 'fa-product-hunt',
                'uri' => '/wp-products',
                'permission' => NULL,
                'created_at' => '2021-01-29 21:52:18',
                'updated_at' => '2021-06-26 01:28:48',
            ),
            8 =>
            array (
                'id' => 11,
                'parent_id' => 0,
                'order' => 3,
                'title' => 'Order',
                'icon' => 'fa-reorder',
                'uri' => '/order',
                'permission' => NULL,
                'created_at' => '2021-01-29 21:52:40',
                'updated_at' => '2021-06-26 01:28:48',
            ),
        ));


    }
}
