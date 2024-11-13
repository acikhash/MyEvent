<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('faculties')->insert([
            'id' => 1,
            'name' => 'Faculty of Artificial Intelligence',
            'code' => 'FAI',
            'created_at' => now(),
            'created_by' => 'admin'
        ]);
        DB::table('faculties')->insert([
            'id' => 2,
            'name' => 'Azman Hashim International Business School',
            'code' => 'AHIBS',
            'created_at' => now(),
            'created_by' => 'admin'
        ]);
        DB::table('faculties')->insert([
            'id' => 3,
            'name' => 'Malaysia - Japan International Institute of Technology',
            'code' => 'MJIIT',
            'created_at' => now(),
            'created_by' => 'admin'
        ]);
    }
}
