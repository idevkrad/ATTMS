<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NamesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('names')->delete();
        
        \DB::table('names')->insert(array (
            0 => 
            array (
                'id' => 1,
                'firstname' => 'Kenneth Dwight',
                'lastname' => 'Francisco',
                'is_researcher' => 1,
                'created_at' => '2023-01-20 21:07:28',
                'updated_at' => '2023-01-20 21:07:28',
            ),
            1 => 
            array (
                'id' => 2,
                'firstname' => 'Kharnelle Eyrand Sade',
                'lastname' => 'Lim',
                'is_researcher' => 1,
                'created_at' => '2023-01-20 21:07:46',
                'updated_at' => '2023-01-20 21:07:46',
            ),
            2 => 
            array (
                'id' => 3,
                'firstname' => 'Rhania  Sherlyn',
                'lastname' => 'Pandangan',
                'is_researcher' => 1,
                'created_at' => '2023-01-20 21:08:14',
                'updated_at' => '2023-01-20 21:08:14',
            ),
            3 => 
            array (
                'id' => 4,
                'firstname' => 'Jolicar',
                'lastname' => 'Maranga',
                'is_researcher' => 0,
                'created_at' => '2023-01-20 21:08:36',
                'updated_at' => '2023-01-20 21:08:36',
            ),
            4 => 
            array (
                'id' => 5,
                'firstname' => 'Louie Virgil',
                'lastname' => 'Gallardo',
                'is_researcher' => 0,
                'created_at' => '2023-01-20 21:08:56',
                'updated_at' => '2023-01-20 21:08:56',
            ),
            5 => 
            array (
                'id' => 6,
                'firstname' => 'Genner',
                'lastname' => 'Cerna',
                'is_researcher' => 0,
                'created_at' => '2023-01-20 21:10:44',
                'updated_at' => '2023-01-20 21:10:44',
            ),
            6 => 
            array (
                'id' => 7,
                'firstname' => 'Criz Elaine',
                'lastname' => 'Paytone',
                'is_researcher' => 1,
                'created_at' => '2023-01-20 23:27:35',
                'updated_at' => '2023-01-20 23:27:35',
            ),
            7 => 
            array (
                'id' => 8,
                'firstname' => 'Edric Rainier',
                'lastname' => 'Villanueva',
                'is_researcher' => 1,
                'created_at' => '2023-01-20 23:27:55',
                'updated_at' => '2023-01-20 23:27:55',
            ),
            8 => 
            array (
                'id' => 9,
                'firstname' => 'Janet',
                'lastname' => 'Tan',
                'is_researcher' => 0,
                'created_at' => '2023-01-20 23:28:30',
                'updated_at' => '2023-01-20 23:28:30',
            ),
            9 => 
            array (
                'id' => 10,
                'firstname' => 'Fe Grace',
                'lastname' => 'Tubog',
                'is_researcher' => 0,
                'created_at' => '2023-01-20 23:28:49',
                'updated_at' => '2023-01-20 23:28:49',
            ),
            10 => 
            array (
                'id' => 11,
                'firstname' => 'Zaeefa',
                'lastname' => 'Pandangan',
                'is_researcher' => 0,
                'created_at' => '2023-01-20 23:29:51',
                'updated_at' => '2023-01-20 23:29:51',
            ),
            11 => 
            array (
                'id' => 12,
                'firstname' => 'Reiner Philip',
                'lastname' => 'Manuel',
                'is_researcher' => 1,
                'created_at' => '2023-01-20 23:33:58',
                'updated_at' => '2023-01-20 23:33:58',
            ),
        ));
        
        
    }
}