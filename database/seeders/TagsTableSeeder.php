<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tags')->delete();
        
        \DB::table('tags')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Web',
                'created_at' => '2023-01-20 20:59:09',
                'updated_at' => '2023-01-20 20:59:09',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Mobile',
                'created_at' => '2023-01-20 20:59:16',
                'updated_at' => '2023-01-20 20:59:16',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Rfid',
                'created_at' => '2023-01-20 20:59:34',
                'updated_at' => '2023-01-20 20:59:34',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Ticketing',
                'created_at' => '2023-01-20 20:59:44',
                'updated_at' => '2023-01-20 20:59:44',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Raspberry Pi',
                'created_at' => '2023-01-20 23:30:09',
                'updated_at' => '2023-01-20 23:30:09',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Recognition',
                'created_at' => '2023-01-20 23:30:18',
                'updated_at' => '2023-01-20 23:30:18',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Detection',
                'created_at' => '2023-01-20 23:30:23',
                'updated_at' => '2023-01-20 23:30:23',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Dtr',
                'created_at' => '2023-01-20 23:35:11',
                'updated_at' => '2023-01-20 23:35:11',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Enhancement',
                'created_at' => '2023-01-20 23:35:23',
                'updated_at' => '2023-01-20 23:35:23',
            ),
        ));
        
        
    }
}