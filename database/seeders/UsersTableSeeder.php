<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'username' => 'administrator',
                'email' => 'admin@adzu.com',
                'email_verified_at' => '2023-01-17 21:57:01',
                'password' => '$2y$10$X6FKn.vmltiGR6SSAF5WiuvAyuHMoxfqwPL.Y/DdVdy0sSKNpBq8a',
                'avatar' => 'avatar.jpg',
                'role' => 'Super Administrator',
                'is_active' => 1,
                'welcome_valid_until' => NULL,
                'remember_token' => NULL,
                'created_at' => '2023-01-17 21:57:01',
                'updated_at' => '2023-01-17 21:57:01',
            ),
            1 => 
            array (
                'id' => 2,
                'username' => '120000',
                'email' => 'rexor@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$z0VWF5/vGkL13f5Q.rBuPOQFrs8KdjAzQkLtE8UOclceMsXbP8tTa',
                'avatar' => 'avatar.jpg',
                'role' => 'Thesis Handler',
                'is_active' => 1,
                'welcome_valid_until' => NULL,
                'remember_token' => NULL,
                'created_at' => '2023-01-18 11:46:25',
                'updated_at' => '2023-01-18 12:28:23',
            ),
            2 => 
            array (
                'id' => 3,
                'username' => '120001',
                'email' => 'rey@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$k2kLu0mTsKzgrilmvLWRMuIke1B2qmgJ.bnsYZTmX5fJbj21KPmgO',
                'avatar' => 'avatar.jpg',
                'role' => 'Thesis Handler',
                'is_active' => 1,
                'welcome_valid_until' => NULL,
                'remember_token' => NULL,
                'created_at' => '2023-01-18 13:49:43',
                'updated_at' => '2023-01-18 13:49:50',
            ),
            3 => 
            array (
                'id' => 4,
                'username' => '120002',
                'email' => 'gallardo@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$G.1y2ucn7ZPDiCz/DN.uC.iywTsBC9//KFc19lPjZ..nkh1ZIAN/S',
                'avatar' => 'avatar.jpg',
                'role' => 'Thesis Handler',
                'is_active' => 0,
                'welcome_valid_until' => NULL,
                'remember_token' => NULL,
                'created_at' => '2023-01-18 13:54:00',
                'updated_at' => '2023-01-18 13:54:00',
            ),
            4 => 
            array (
                'id' => 5,
                'username' => '120003',
                'email' => 'deles@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$3QNT.NyOU4GrmsN7j/b60e0hg9xWyO3sY2HmtL1pr/FoVs/m5oJZS',
                'avatar' => 'avatar.jpg',
                'role' => 'Thesis Handler',
                'is_active' => 0,
                'welcome_valid_until' => NULL,
                'remember_token' => NULL,
                'created_at' => '2023-01-18 14:06:50',
                'updated_at' => '2023-01-18 14:06:50',
            ),
        ));
        
        
    }
}