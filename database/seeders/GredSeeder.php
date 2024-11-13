<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GredSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('greds')->insert([
            'id' => 1,
            'name' => 'DS51',
            'code' => 'DS51',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('greds')->insert([
            'id' => 2,
            'name' => 'DS52',
            'code' => 'DS52',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('greds')->insert([
            'id' => 3,
            'name' => 'DS54',
            'code' => 'DS54',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('greds')->insert([
            'id' => 4,
            'name' => 'VK05',
            'code' => 'VK05',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
        DB::table('greds')->insert([
            'id' => 5,
            'name' => 'VK07',
            'code' => 'VK07',
            'created_by' => 'admin',
            'created_at' => now()
        ]);
    }
}
