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
                'location' => 'Cabinet 1',
                'is_borrowable' => 1,
                'office_id' => 3,
                'thesis_id' => 1,
                'is_available' => 1,
                'created_at' => '2023-01-24 16:29:52',
                'updated_at' => '2023-01-24 16:29:52',
            ),
            1 => 
            array (
                'id' => 2,
                'location' => 'cabinet 2',
                'is_borrowable' => 1,
                'office_id' => 3,
                'thesis_id' => 2,
                'is_available' => 1,
                'created_at' => '2023-01-24 16:32:11',
                'updated_at' => '2023-01-24 16:32:11',
            ),
            2 => 
            array (
                'id' => 3,
                'location' => 'cabinet 2',
                'is_borrowable' => 1,
                'office_id' => 3,
                'thesis_id' => 3,
                'is_available' => 1,
                'created_at' => '2023-01-24 16:33:59',
                'updated_at' => '2023-01-24 16:33:59',
            ),
        ));
        
        
    }
}