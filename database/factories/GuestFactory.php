<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GuestCategory>
 */
class GuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'event_id' => '1',
            'guest_category_id' => '1',
            'name' => fake()->name(),
            'email' => fake()->email(),
            'organization' => fake()->company(),
            'address' => fake()->address(),
            'contactNumber' => fake()->phoneNumber(),
            'guesttype' => 'Invitation',
            'created_at' => now(),
            'created_by' => '1',
        ];
    }
}
