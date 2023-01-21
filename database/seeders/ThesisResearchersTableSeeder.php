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
                'researcher_id' => 2,
                'created_at' => '2023-01-20 21:11:03',
                'updated_at' => '2023-01-20 21:11:03',
            ),
            1 => 
            array (
                'id' => 2,
                'thesis_id' => 1,
                'researcher_id' => 1,
                'created_at' => '2023-01-20 21:11:03',
                'updated_at' => '2023-01-20 21:11:03',
            ),
            2 => 
            array (
                'id' => 3,
                'thesis_id' => 1,
                'researcher_id' => 3,
                'created_at' => '2023-01-20 21:11:03',
                'updated_at' => '2023-01-20 21:11:03',
            ),
            3 => 
            array (
                'id' => 4,
                'thesis_id' => 2,
                'researcher_id' => 7,
                'created_at' => '2023-01-20 23:31:01',
                'updated_at' => '2023-01-20 23:31:01',
            ),
            4 => 
            array (
                'id' => 5,
                'thesis_id' => 2,
                'researcher_id' => 8,
                'created_at' => '2023-01-20 23:31:01',
                'updated_at' => '2023-01-20 23:31:01',
            ),
            5 => 
            array (
                'id' => 6,
                'thesis_id' => 3,
                'researcher_id' => 12,
                'created_at' => '2023-01-20 23:35:25',
                'updated_at' => '2023-01-20 23:35:25',
            ),
        ));
        
        
    }
}