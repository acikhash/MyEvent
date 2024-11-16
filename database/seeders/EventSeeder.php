<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //run factory for dummyevent
        // \App\Models\Event::factory(5)->create();

        DB::table('events')->insert(
            [
                'name' => 'Jamuan Raya',
                'theme' => 'Batik',
                'dateStart' => '2024-07-06',
                'dateEnd' => '2024-07-09',
                'timeStart' => fake()->time(),
                'timeEnd' => fake()->time(),
                'veneu' => fake()->address(),
                'maxGuest' => fake()->numberBetween(1, 500),
                'organizer' => fake()->company(),
                'created_at' => now(),
                'created_by' => '1',
            ]
        );
        DB::table('events')->insert(
            [
                'name' => 'Seminar AI',
                'theme' => 'formal',
                'dateStart' => '2024-07-08',
                'dateEnd' => '2024-07-15',
                'timeStart' => fake()->time(),
                'timeEnd' => fake()->time(),
                'veneu' => fake()->address(),
                'maxGuest' => fake()->numberBetween(1, 500),
                'organizer' => fake()->company(),
                'created_at' => now(),
                'created_by' => '1',
            ]
        );
        DB::table('events')->insert(
            [
                'name' => 'Students Registration ',
                'theme' => 'formal',
                'dateStart' => '2024-07-06',
                'dateEnd' => '2024-07-15',
                'timeStart' => fake()->time(),
                'timeEnd' => fake()->time(),
                'veneu' => fake()->address(),
                'maxGuest' => fake()->numberBetween(1, 500),
                'organizer' => fake()->company(),
                'created_at' => now(),
                'created_by' => '1',
            ]

        );
        DB::table('events')->insert(
            [
                'name' => 'Hands On Building Your Own AI Chatbox',
                'theme' => 'formal',
                'dateStart' => '2024-07-11',
                'dateEnd' => '2024-07-20',
                'timeStart' => fake()->time(),
                'timeEnd' => fake()->time(),
                'veneu' => fake()->address(),
                'maxGuest' => fake()->numberBetween(1, 500),
                'organizer' => fake()->company(),
                'created_at' => now(),
                'created_by' => '1',
            ]

        );
    }
}
