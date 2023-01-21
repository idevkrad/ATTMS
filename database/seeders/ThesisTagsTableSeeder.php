<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ThesisTagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('thesis_tags')->delete();
        
        \DB::table('thesis_tags')->insert(array (
            0 => 
            array (
                'id' => 1,
                'thesis_id' => 1,
                'tag_id' => 2,
                'created_at' => '2023-01-20 21:11:03',
                'updated_at' => '2023-01-20 21:11:03',
            ),
            1 => 
            array (
                'id' => 2,
                'thesis_id' => 1,
                'tag_id' => 1,
                'created_at' => '2023-01-20 21:11:03',
                'updated_at' => '2023-01-20 21:11:03',
            ),
            2 => 
            array (
                'id' => 3,
                'thesis_id' => 1,
                'tag_id' => 3,
                'created_at' => '2023-01-20 21:11:03',
                'updated_at' => '2023-01-20 21:11:03',
            ),
            3 => 
            array (
                'id' => 4,
                'thesis_id' => 1,
                'tag_id' => 4,
                'created_at' => '2023-01-20 21:11:03',
                'updated_at' => '2023-01-20 21:11:03',
            ),
            4 => 
            array (
                'id' => 5,
                'thesis_id' => 2,
                'tag_id' => 5,
                'created_at' => '2023-01-20 23:31:01',
                'updated_at' => '2023-01-20 23:31:01',
            ),
            5 => 
            array (
                'id' => 6,
                'thesis_id' => 2,
                'tag_id' => 6,
                'created_at' => '2023-01-20 23:31:01',
                'updated_at' => '2023-01-20 23:31:01',
            ),
            6 => 
            array (
                'id' => 7,
                'thesis_id' => 2,
                'tag_id' => 7,
                'created_at' => '2023-01-20 23:31:01',
                'updated_at' => '2023-01-20 23:31:01',
            ),
            7 => 
            array (
                'id' => 8,
                'thesis_id' => 3,
                'tag_id' => 8,
                'created_at' => '2023-01-20 23:35:25',
                'updated_at' => '2023-01-20 23:35:25',
            ),
            8 => 
            array (
                'id' => 9,
                'thesis_id' => 3,
                'tag_id' => 9,
                'created_at' => '2023-01-20 23:35:25',
                'updated_at' => '2023-01-20 23:35:25',
            ),
        ));
        
        
    }
}