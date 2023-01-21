<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('departments')->delete();
        
        \DB::table('departments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Computer Science Department',
                'shortcut' => 'CSD',
                'is_active' => 1,
                'created_at' => '2023-01-17 21:47:14',
                'updated_at' => '2023-01-17 21:47:14',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Engineering Department',
                'shortcut' => 'n/a',
                'is_active' => 1,
                'created_at' => '2023-01-17 21:47:47',
                'updated_at' => '2023-01-17 21:47:47',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Mathematics Department',
                'shortcut' => 'n/a',
                'is_active' => 1,
                'created_at' => '2023-01-17 21:48:05',
                'updated_at' => '2023-01-17 21:48:05',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Natural Sciences Department',
                'shortcut' => 'n/a',
                'is_active' => 1,
                'created_at' => '2023-01-17 21:48:22',
                'updated_at' => '2023-01-17 21:48:22',
            ),
        ));
        
        
    }
}