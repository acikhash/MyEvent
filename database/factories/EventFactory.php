<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        //auto generate data for dummyevent
        return [
            'name' => fake()->realText(200, 2),
            'theme' => fake()->realText(100, 1),
            'dateStart' => fake()->date(),
            'dateEnd' => fake()->date(),
            'timeStart' => fake()->time(),
            'timeEnd' => fake()->time(),
            'maxGuest' => fake()->numberBetween(10, 1000),
            'organizer' => fake()->company(),
            'created_at' => now(),
            'created_by' => '1',

        ];
    }
}
