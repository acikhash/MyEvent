<?php

namespace Database\Seeders;

use App\Models\Semester;
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
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            FacultySeeder::class,
            DepartmentSeeder::class,
            TitleSeeder::class,
            MajorSeeder::class,
            GredSeeder::class,
            StaffSeeder::class,
            ProgramSeeder::class,
            CourseSeeder::class,
            SemesterSeeder::class,
            AssignmentSeeder::class,
            EventSeeder::class
        ]);
    }
}
