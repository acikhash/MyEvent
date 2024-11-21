<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('semesters')->insert([
            'id' => 1,
            'name' => 'SEMESTER 3 2023/2024',
            'code' => 'S3 23',
            'year' => 2023,
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('semesters')->insert([
            'id' => 2,
            'name' => 'SEMESTER 1 2024/2025',
            'code' => 'S1 24',
            'year' => 2024,
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('semesters')->insert([
            'id' => 3,
            'name' => 'SEMESTER 2 2024/2025',
            'code' => 'S2 24',
            'year' => 2024,
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('semesters')->insert([
            'id' => 4,
            'name' => 'SEMESTER 3 2024/2025',
            'code' => 'S3 24',
            'year' => 2024,
            'created_by' => 'admin',
            'created_at' => now()
        ]);
    }
}
