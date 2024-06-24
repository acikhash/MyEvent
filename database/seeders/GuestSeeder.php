<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //run factory for dummyevent
        // \App\Models\Event::factory(5)->create();
        DB::table('guests')->insert(
            [
                'eventid' => '1',
                'salutations' => 'Dato',
                'guesttype' => '3',
                'created_at' => now(),
                'created_by' => '1',
            ]
        );
    }
}
