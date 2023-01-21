<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserProfilesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_profiles')->delete();
        
        \DB::table('user_profiles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'firstname' => 'Ra-ouf',
                'lastname' => 'Jumli',
                'middlename' => 'Indanan',
                'suffix' => NULL,
                'gender' => 'Male',
                'mobile' => '09557650801',
                'course_id' => NULL,
                'department_id' => NULL,
                'user_id' => 1,
                'created_at' => '2023-01-17 21:57:01',
                'updated_at' => '2023-01-17 21:57:01',
            ),
            1 => 
            array (
                'id' => 2,
                'firstname' => 'rexor',
                'lastname' => 'miravite',
                'middlename' => 'A',
                'suffix' => NULL,
                'gender' => 'M',
                'mobile' => '09123654987',
                'course_id' => NULL,
                'department_id' => 1,
                'user_id' => 2,
                'created_at' => '2023-01-18 11:46:25',
                'updated_at' => '2023-01-18 11:46:25',
            ),
            2 => 
            array (
                'id' => 3,
                'firstname' => 'rey',
                'lastname' => 'reyes',
                'middlename' => 's',
                'suffix' => NULL,
                'gender' => 'M',
                'mobile' => '09123456987',
                'course_id' => NULL,
                'department_id' => 3,
                'user_id' => 3,
                'created_at' => '2023-01-18 13:49:43',
                'updated_at' => '2023-01-18 13:49:43',
            ),
            3 => 
            array (
                'id' => 4,
                'firstname' => 'Louie Virgil',
                'lastname' => 'gallardo',
                'middlename' => 'a',
                'suffix' => NULL,
                'gender' => 'M',
                'mobile' => '09321654987',
                'course_id' => NULL,
                'department_id' => 2,
                'user_id' => 4,
                'created_at' => '2023-01-18 13:54:00',
                'updated_at' => '2023-01-18 13:54:00',
            ),
            4 => 
            array (
                'id' => 5,
                'firstname' => 'Maria Adeliza',
                'lastname' => 'deles',
                'middlename' => 'f',
                'suffix' => NULL,
                'gender' => 'F',
                'mobile' => '09321654788',
                'course_id' => NULL,
                'department_id' => 4,
                'user_id' => 5,
                'created_at' => '2023-01-18 14:06:50',
                'updated_at' => '2023-01-18 14:06:50',
            ),
        ));
        
        
    }
}