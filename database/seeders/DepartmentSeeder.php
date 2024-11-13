<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            'id' => 1,
            'name' => 'Intelligence Informatic',
            'code' => 'II',
            'faculty_id' => 1,
            'created_by' => 'admin',
            'created_at' => now(),
        ]);
        DB::table('departments')->insert([
            'id' => 2,
            'name' => 'Smart Engineering and Advance Technology',
            'code' => 'SEAT',
            'faculty_id' => 1,
            'created_by' => 'admin',
            'created_at' => now(),
        ]);
        DB::table('departments')->insert([
            'id' => 3,
            'name' => 'Business Intelligence, Humanities and Governance',
            'code' => 'BIHG',
            'faculty_id' => 1,
            'created_by' => 'admin',
            'created_at' => now(),
        ]);
        DB::table('departments')->insert([
            'id' => 4,
            'name' => 'Creative Artificial Intelligence',
            'code' => 'CAI',
            'faculty_id' => 1,
            'created_by' => 'admin',
            'created_at' => now(),
        ]);
    }
}
