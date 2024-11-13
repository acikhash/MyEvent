<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('titles')->insert([
            'id' => 1,
            'name' => 'PROF. EMERITUS DATO\' Ir. Ts. DR.',
            'code' => 'PROF. EMERITUS DATO\' Ir. Ts. DR.',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('titles')->insert([
            'id' => 2,
            'name' => 'DATO\' Ir. Ts. DR.',
            'code' => 'DATO\' Ir. Ts. DR.',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('titles')->insert([
            'id' => 3,
            'name' => 'PROF. EMERITUS',
            'code' => 'PROF. EMERITUS',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('titles')->insert([
            'id' => 4,
            'name' => 'Ir. Ts. DR.',
            'code' => 'Ir. Ts. DR.',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('titles')->insert([
            'id' => 5,
            'name' => 'Ts. DR.',
            'code' => 'Ts. DR.',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('titles')->insert([
            'id' => 6,
            'name' => 'DR.',
            'code' => 'DR.',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('titles')->insert([
            'id' => 7,
            'name' => 'Ts.',
            'code' => 'Ts.',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('titles')->insert([
            'id' => 8,
            'name' => 'Ir. DR.',
            'code' => 'Ir. DR.',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('titles')->insert([
            'id' => 9,
            'name' => 'Prof. Ts. DR.',
            'code' => 'Prof. Ts. DR.',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('titles')->insert([
            'id' => 10,
            'name' => 'PM. Ts. DR.',
            'code' => 'PM. Ts. DR.',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('titles')->insert([
            'id' => 11,
            'name' => 'PM. Ir. Ts. DR.',
            'code' => 'PM. Ir. Ts. DR.',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('titles')->insert([
            'id' => 12,
            'name' => 'PM. DR.',
            'code' => 'PM. DR.',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('titles')->insert([
            'id' => 13,
            'name' => 'Puan',
            'code' => 'Pn',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('titles')->insert([
            'id' => 14,
            'name' => 'Encik',
            'code' => 'En',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('titles')->insert([
            'id' => 15,
            'name' => 'Cik',
            'code' => 'Cik',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('titles')->insert([
            'id' => 16,
            'name' => 'PM. Ts.',
            'code' => 'PM. Ts.',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
    }
}
