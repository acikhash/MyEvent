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
        \App\Models\Guest::factory(25)->create();
        DB::table('guests')->insert(
            [
                'event_id' => '1',
                'guest_category_id' => '1',
                'name' => 'Aaron',
                'email' => 'aron@utm.edu',
                'salutations' => 'Dato',
                'guesttype' => 'Invitation',
                'created_at' => now(),
                'created_by' => '1',
            ]
        );
        DB::table('guests')->insert(
            [
                'event_id' => '1',
                'guest_category_id' => '1',
                'name' => 'Lyu',
                'email' => 'lyu@utm.edu',
                'salutations' => 'Mr',
                'guesttype' => 'Representative',
                'created_at' => now(),
                'created_by' => '1',
            ]
        );
        DB::table('guests')->insert(
            [
                'event_id' => '1',
                'guest_category_id' => '1',
                'name' => 'Yang',
                'email' => 'yang@utm.edu',
                'salutations' => 'Mr',
                'guesttype' => 'Walk-in',
                'created_at' => now(),
                'created_by' => '1',
            ]
        );
    }
}
