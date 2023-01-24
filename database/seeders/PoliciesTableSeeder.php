<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PoliciesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('policies')->delete();
        
        \DB::table('policies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'description' => 'Students can borrow thesis hardbound and take them home from the Computer Science 
Department.',
                'is_borrowable' => 1,
                'borrow_count' => 0,
                'borrow_time' => 'Unlimited',
                'is_viewable' => 1,
                'view_count' => 7,
                'view_time' => 'Day',
                'is_within' => 0,
                'department_id' => 1,
                'created_at' => '2023-01-18 19:55:06',
                'updated_at' => '2023-01-18 19:55:06',
            ),
            1 => 
            array (
                'id' => 2,
                'description' => 'The Engineering Department allows students to borrow thesis hardbound and take them 
home.',
                'is_borrowable' => 1,
                'borrow_count' => 0,
                'borrow_time' => 'Unlimited',
                'is_viewable' => 1,
                'view_count' => 7,
                'view_time' => 'Day',
                'department_id' => 2,
                'is_within' => 0,
                'created_at' => '2023-01-18 20:09:19',
                'updated_at' => '2023-01-18 20:09:19',
            ),
            2 => 
            array (
                'id' => 3,
                'description' => 'The Mathematics Department permits students to view and read within the confines of 
the office.',
                'is_borrowable' => 1,
                'borrow_count' => 4,
                'borrow_time' => 'Hour',
                'is_viewable' => 0,
                'view_count' => 0,
                'view_time' => NULL,
                'is_within' => 1,
                'department_id' => 3,
                'created_at' => '2023-01-18 20:16:50',
                'updated_at' => '2023-01-18 20:16:50',
            ),
            3 => 
            array (
                'id' => 4,
                'description' => 'The Natural Sciences Department permits students to view and read within the confines 
of the laboratory.',
                'is_borrowable' => 1,
                'borrow_count' => 4,
                'borrow_time' => 'Hour',
                'is_viewable' => 0,
                'view_count' => 0,
                'view_time' => NULL,
                'is_within' => 1,
                'department_id' => 4,
                'created_at' => '2023-01-18 20:22:33',
                'updated_at' => '2023-01-18 20:22:33',
            ),
        ));
        
        
    }
}