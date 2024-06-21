<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuestCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('guest_categories')->insert([
            'id' => 1,
            'name' => 'admin',
            'event_id' => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
