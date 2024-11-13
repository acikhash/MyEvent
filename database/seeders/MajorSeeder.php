<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Majors')->insert([
            'id' => 1,
            'name' => 'PENGAJARAN',
            'credit' => 10,
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('Majors')->insert([
            'id' => 2,
            'name' => 'PENYELIDIKAN DAN AMALAN PROFESIONAL',
            'credit' => 6,
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('Majors')->insert([
            'id' => 3,
            'name' => 'KEPIMPINAN AKADEMIK',
            'credit' => 3,
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('Majors')->insert([
            'id' => 4,
            'name' => 'AMAL BAKTI',
            'credit' => 0,
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('Majors')->insert([
            'id' => 5,
            'name' => 'LATIHAN IKTHISAS',
            'credit' => 0,
            'created_by' => 'admin',
            'created_at' => now()
        ]);
    }
}
