<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('assignments')->insert([
            'course_id' => 1, // Assuming a course with ID 1 exists
            'staff_id' => 1,  // Assuming a staff member with ID 1 exists
            'semester_id' => 1, // Assuming a semester with ID 1 exists
            'course_code' => 'MRTB1113',
            'staff_name' => 'PM. Ts. DR.NOR ZAIRAH BINTI AB RAHIM',
            'year' => '2023',
            'semester' => 'SEMESTER 3 2023/2024',
            'credit' => '3',
            'notes' => 'Complete the exercises from chapter 5.',
            'created_by' => 'admin',
            'created_at' => now(),
        ]);
        DB::table('assignments')->insert([
            'course_id' => 1, // Assuming a course with ID 1 exists
            'staff_id' => 2,  // Assuming a staff member with ID 1 exists
            'semester_id' => 1, // Assuming a semester with ID 1 exists
            'course_code' => 'MRTB1113',
            'staff_name' => 'DR. AZIZUL BIN AZIZAN',
            'year' => '2023',
            'semester' => 'SEMESTER 3 2023/2024',
            'credit' => 3,
            'notes' => 'Complete the exercises from chapter 5.',
            'created_by' => 'admin',
            'created_at' => now(),
        ]);
        DB::table('assignments')->insert([
            'course_id' => 7, // Assuming a course with ID 1 exists
            'staff_id' => 3,  // Assuming a staff member with ID 1 exists
            'semester_id' => 1, // Assuming a semester with ID 1 exists
            'course_code' => 'MRTB1143',
            'staff_name' => 'PM. Ts. DR. AZRI BIN AZMI',
            'year' => '2023',
            'semester' => 'SEMESTER 3 2023/2024',
            'credit' => 3,
            'notes' => 'Complete the exercises from chapter 5.',
            'created_by' => 'admin',
            'created_at' => now(),
        ]);
    }
}
