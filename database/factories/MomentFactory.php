<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MomentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(),
            'location_id' => function() {
                $location = Location::inRandomOrder()->first();
                return $location ? $location->id : Location::factory()->create()->id;
            },
            'author_id' => function() {
                $location = Author::inRandomOrder()->first();
                return $location ? $location->id : Author::factory()->create()->id;
            },
            'source' => fake()->text(10),
            'date_taken' => fake()->dateTime('now'),
            'image' => fake()->imageUrl(),
            'direction' => 'N',
            'description' => fake()->realText(200)
        ];
    }
}
