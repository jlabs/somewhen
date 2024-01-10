<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->streetAddress(),
            'colour' => fake()->hexColor(),
            'button_label' => fake()->word(),
            'coordinates' => [
                'lat' => fake()->latitude($min = -90, $max = 90),
                'lng' => fake()->longitude($min = -180, $max = 180),
            ],
            'gmaps_url' => fake()->url()
        ];
    }
}
