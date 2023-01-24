<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DropdownsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('dropdowns')->delete();
        
        \DB::table('dropdowns')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'n/a',
                'classification' => 'n/a',
                'type' => 'n/a',
                'color' => 'n/a',
                'others' => 'n/a',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Pending',
                'classification' => 'Status',
                'type' => 'Request',
                'color' => 'warning',
                'others' => 'n/a',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Approved',
                'classification' => 'Status',
                'type' => 'Request',
                'color' => 'info',
                'others' => 'n/a',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Ongoing',
                'classification' => 'Status',
                'type' => 'Request',
                'color' => 'primary',
                'others' => 'n/a',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Completed',
                'classification' => 'Status',
                'type' => 'Request',
                'color' => 'success',
                'others' => 'n/a',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Cancelled',
                'classification' => 'Status',
                'type' => 'Request',
                'color' => 'danger',
                'others' => 'n/a',
            ),
        ));
        
        
    }
}