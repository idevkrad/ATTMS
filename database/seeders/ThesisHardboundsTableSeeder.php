<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ThesisHardboundsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('thesis_hardbounds')->delete();
        
        \DB::table('thesis_hardbounds')->insert(array (
            0 => 
            array (
                'id' => 1,
                'location' => '1',
                'is_borrowable' => 1,
                'office_id' => 1,
                'thesis_id' => 1,
                'is_available' => 1,
                'created_at' => '2023-01-20 21:11:03',
                'updated_at' => '2023-01-20 21:11:03',
            ),
            1 => 
            array (
                'id' => 2,
                'location' => '2',
                'is_borrowable' => 0,
                'office_id' => 2,
                'thesis_id' => 1,
                'is_available' => 1,
                'created_at' => '2023-01-20 21:11:03',
                'updated_at' => '2023-01-20 21:11:03',
            ),
            2 => 
            array (
                'id' => 3,
                'location' => 'storage 1',
                'is_borrowable' => 1,
                'office_id' => 1,
                'thesis_id' => 2,
                'is_available' => 1,
                'created_at' => '2023-01-20 23:31:01',
                'updated_at' => '2023-01-20 23:31:01',
            ),
            3 => 
            array (
                'id' => 4,
                'location' => 'storage 2',
                'is_borrowable' => 0,
                'office_id' => 2,
                'thesis_id' => 2,
                'is_available' => 1,
                'created_at' => '2023-01-20 23:31:01',
                'updated_at' => '2023-01-20 23:31:01',
            ),
            4 => 
            array (
                'id' => 5,
                'location' => 'box 1',
                'is_borrowable' => 1,
                'office_id' => 1,
                'thesis_id' => 3,
                'is_available' => 1,
                'created_at' => '2023-01-20 23:35:25',
                'updated_at' => '2023-01-20 23:35:25',
            ),
        ));
        
        
    }
}