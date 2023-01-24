<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ThesisPanelistsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('thesis_panelists')->delete();
        
        \DB::table('thesis_panelists')->insert(array (
            0 => 
            array (
                'id' => 1,
                'thesis_id' => 1,
                'panelist_id' => 6,
                'created_at' => '2023-01-24 16:29:52',
                'updated_at' => '2023-01-24 16:29:52',
            ),
            1 => 
            array (
                'id' => 2,
                'thesis_id' => 2,
                'panelist_id' => 10,
                'created_at' => '2023-01-24 16:32:11',
                'updated_at' => '2023-01-24 16:32:11',
            ),
            2 => 
            array (
                'id' => 3,
                'thesis_id' => 2,
                'panelist_id' => 9,
                'created_at' => '2023-01-24 16:32:11',
                'updated_at' => '2023-01-24 16:32:11',
            ),
            3 => 
            array (
                'id' => 4,
                'thesis_id' => 2,
                'panelist_id' => 6,
                'created_at' => '2023-01-24 16:32:11',
                'updated_at' => '2023-01-24 16:32:11',
            ),
            4 => 
            array (
                'id' => 5,
                'thesis_id' => 3,
                'panelist_id' => 6,
                'created_at' => '2023-01-24 16:33:59',
                'updated_at' => '2023-01-24 16:33:59',
            ),
        ));
        
        
    }
}