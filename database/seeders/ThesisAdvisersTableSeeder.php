<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ThesisAdvisersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('thesis_advisers')->delete();
        
        \DB::table('thesis_advisers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'thesis_id' => 1,
                'adviser_id' => 5,
                'created_at' => '2023-01-20 21:11:03',
                'updated_at' => '2023-01-20 21:11:03',
            ),
            1 => 
            array (
                'id' => 2,
                'thesis_id' => 2,
                'adviser_id' => 11,
                'created_at' => '2023-01-20 23:31:01',
                'updated_at' => '2023-01-20 23:31:01',
            ),
            2 => 
            array (
                'id' => 3,
                'thesis_id' => 3,
                'adviser_id' => 4,
                'created_at' => '2023-01-20 23:35:25',
                'updated_at' => '2023-01-20 23:35:25',
            ),
        ));
        
        
    }
}