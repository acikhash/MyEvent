<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'PGAM',
            'email' => 'admin@softui.com',
            'password' => Hash::make('secret'),
            'department_id' => 1,
            'role' => 'pgam',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Director1',
            'email' => 'test@utm.com',
            'password' => Hash::make('secret'),
            'role' => 'director',
            'department_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'id' => 3,
            'name' => 'Coordinator1',
            'email' => 'test1@utm.com',
            'password' => Hash::make('secret'),
            'department_id' => 1,
            'role' => 'coordinator',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'id' => 4,
            'name' => 'Coordinator2',
            'email' => 'tes2t@utm.com',
            'password' => Hash::make('secret'),
            'department_id' => 3,
            'role' => 'coordinator',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
