<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\Location::factory()->create([
            'title' => 'Newport Rail Tunnel',
            'colour' => '#ff0000',
            'button_label' => 'Newport Rail Tunnel',
            'coordinates' => [
                'lat' => '50.701870298467696',
                'lng' => '-1.2895803407729292',
            ],
            'gmaps_url' => fake()->url()
        ]);
        \App\Models\Location::factory()->create([
            'title' => 'Ventnor Rail Tunnel',
            'colour' => '#ff0000',
            'button_label' => 'Newport Rail Tunnel',
            'coordinates' => [
                'lat' => '50.59802389332379',
                'lng' => '-1.2083137035369875',
            ],
            'gmaps_url' => fake()->url()
        ]);
    }
}
