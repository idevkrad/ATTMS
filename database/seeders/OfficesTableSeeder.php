<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OfficesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('offices')->delete();
        
        \DB::table('offices')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Animation Laboratory',
                'department_id' => 1,
                'created_at' => '2023-01-20 16:01:28',
                'updated_at' => '2023-01-20 16:01:28',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Research Laboratory',
                'department_id' => 1,
                'created_at' => '2023-01-20 16:01:28',
                'updated_at' => '2023-01-20 16:01:28',
            ),
        ));
        
        
    }
}