<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ThesisResearchersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('thesis_researchers')->delete();
        
        \DB::table('thesis_researchers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'thesis_id' => 1,
                'researcher_id' => 1,
                'created_at' => '2023-01-24 16:29:52',
                'updated_at' => '2023-01-24 16:29:52',
            ),
            1 => 
            array (
                'id' => 2,
                'thesis_id' => 1,
                'researcher_id' => 2,
                'created_at' => '2023-01-24 16:29:52',
                'updated_at' => '2023-01-24 16:29:52',
            ),
            2 => 
            array (
                'id' => 3,
                'thesis_id' => 1,
                'researcher_id' => 3,
                'created_at' => '2023-01-24 16:29:52',
                'updated_at' => '2023-01-24 16:29:52',
            ),
            3 => 
            array (
                'id' => 4,
                'thesis_id' => 2,
                'researcher_id' => 7,
                'created_at' => '2023-01-24 16:32:11',
                'updated_at' => '2023-01-24 16:32:11',
            ),
            4 => 
            array (
                'id' => 5,
                'thesis_id' => 2,
                'researcher_id' => 8,
                'created_at' => '2023-01-24 16:32:11',
                'updated_at' => '2023-01-24 16:32:11',
            ),
            5 => 
            array (
                'id' => 6,
                'thesis_id' => 3,
                'researcher_id' => 12,
                'created_at' => '2023-01-24 16:33:59',
                'updated_at' => '2023-01-24 16:33:59',
            ),
            6 => 
            array (
                'id' => 7,
                'thesis_id' => 4,
                'researcher_id' => 13,
                'created_at' => '2023-01-26 13:37:49',
                'updated_at' => '2023-01-26 13:37:49',
            ),
            7 => 
            array (
                'id' => 8,
                'thesis_id' => 4,
                'researcher_id' => 14,
                'created_at' => '2023-01-26 13:37:49',
                'updated_at' => '2023-01-26 13:37:49',
            ),
        ));
        
        
    }
}