<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \DB::table('users')->insert([
        //     'username' => 'administrator',
        //     'email' => 'admin@adzu.com',
        //     'password' => bcrypt('adzuattms'),
        //     'role' => 'Super Administrator',
        //     'is_active' => 1,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     'email_verified_at' => now(),
        // ]);

        // \DB::table('user_profiles')->insert([
        //     'firstname' => 'Ra-ouf',
        //     'lastname' => 'Jumli',
        //     'middlename' => 'Indanan',
        //     'gender' => 'Male',
        //     'user_id' => 1,
        //     'mobile' => '09557650801',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UserProfilesTableSeeder::class);
        $this->call(PoliciesTableSeeder::class);
        $this->call(OfficesTableSeeder::class);
        $this->call(DropdownsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(NamesTableSeeder::class);
        $this->call(ThesesTableSeeder::class);
        $this->call(ThesisAdvisersTableSeeder::class);
        $this->call(ThesisHardboundsTableSeeder::class);
        $this->call(ThesisPanelistsTableSeeder::class);
        $this->call(ThesisResearchersTableSeeder::class);
        $this->call(ThesisTagsTableSeeder::class);
    }
}
