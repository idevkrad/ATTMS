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
                'created_at' => '2023-01-24 16:29:52',
                'updated_at' => '2023-01-24 16:29:52',
            ),
            1 => 
            array (
                'id' => 2,
                'thesis_id' => 2,
                'adviser_id' => 11,
                'created_at' => '2023-01-24 16:32:11',
                'updated_at' => '2023-01-24 16:32:11',
            ),
            2 => 
            array (
                'id' => 3,
                'thesis_id' => 3,
                'adviser_id' => 4,
                'created_at' => '2023-01-24 16:33:59',
                'updated_at' => '2023-01-24 16:33:59',
            ),
        ));
        
        
    }
}