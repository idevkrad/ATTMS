<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('courses')->delete();
        
        \DB::table('courses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Bachelor of Science in Computer Science',
                'shortcut' => 'BSCS',
                'is_active' => 1,
                'department_id' => 1,
                'created_at' => '2023-01-17 21:50:38',
                'updated_at' => '2023-01-17 21:50:38',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Bachelor of Science in Information Technology',
                'shortcut' => 'BSIT',
                'is_active' => 1,
                'department_id' => 1,
                'created_at' => '2023-01-17 21:50:38',
                'updated_at' => '2023-01-17 21:50:38',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Bachelor of Science in New Media & Computer Animation',
                'shortcut' => 'BSNMCA',
                'is_active' => 1,
                'department_id' => 1,
                'created_at' => '2023-01-17 21:51:39',
                'updated_at' => '2023-01-17 21:51:39',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Bachelor of Science in Electronics Engineering',
                'shortcut' => 'BSECE',
                'is_active' => 1,
                'department_id' => 2,
                'created_at' => '2023-01-17 21:52:10',
                'updated_at' => '2023-01-17 21:52:10',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Bachelor of Science in Civil Engineering',
                'shortcut' => 'BSCE',
                'is_active' => 1,
                'department_id' => 2,
                'created_at' => '2023-01-17 21:52:10',
                'updated_at' => '2023-01-17 21:52:10',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Bachelor of Science in Computer Engineering',
                'shortcut' => 'BSCoE',
                'is_active' => 1,
                'department_id' => 2,
                'created_at' => '2023-01-17 21:53:08',
                'updated_at' => '2023-01-17 21:53:08',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Bachelor of Science in Bio-Medical Engineering',
                'shortcut' => 'BSBioMed',
                'is_active' => 1,
                'department_id' => 2,
                'created_at' => '2023-01-17 21:53:08',
                'updated_at' => '2023-01-17 21:53:08',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Associate in Electronics Engineering Technology',
                'shortcut' => 'AEET',
                'is_active' => 1,
                'department_id' => 2,
                'created_at' => '2023-01-17 21:54:06',
                'updated_at' => '2023-01-17 21:54:06',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Bachelor of Science in Mathematics',
                'shortcut' => 'BSM',
                'is_active' => 1,
                'department_id' => 3,
                'created_at' => '2023-01-17 21:54:32',
                'updated_at' => '2023-01-17 21:54:32',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Bachelor of Science in Statistics',
                'shortcut' => 'BSS',
                'is_active' => 1,
                'department_id' => 3,
                'created_at' => '2023-01-17 21:54:32',
                'updated_at' => '2023-01-17 21:54:32',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Bachelor of Science in Biology',
                'shortcut' => 'BSBio',
                'is_active' => 1,
                'department_id' => 4,
                'created_at' => '2023-01-17 21:55:30',
                'updated_at' => '2023-01-17 21:55:30',
            ),
        ));
        
        
    }
}