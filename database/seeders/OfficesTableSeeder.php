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
            2 => 
            array (
                'id' => 3,
                'name' => 'Electronics Circuit Laboratory ',
                'department_id' => 2,
                'created_at' => '2023-01-24 16:17:56',
                'updated_at' => '2023-01-24 16:17:56',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'CSIT Office',
                'department_id' => 3,
                'created_at' => '2023-01-24 16:18:35',
                'updated_at' => '2023-01-24 16:18:35',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Library',
                'department_id' => 3,
                'created_at' => '2023-01-24 16:18:35',
                'updated_at' => '2023-01-24 16:18:35',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Biology Stock Room',
                'department_id' => 4,
                'created_at' => '2023-01-24 16:19:12',
                'updated_at' => '2023-01-24 16:19:12',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'CSIT Office',
                'department_id' => 4,
                'created_at' => '2023-01-24 16:19:12',
                'updated_at' => '2023-01-24 16:19:12',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Library',
                'department_id' => 4,
                'created_at' => '2023-01-24 16:19:49',
                'updated_at' => '2023-01-24 16:19:49',
            ),
        ));
        
        
    }
}