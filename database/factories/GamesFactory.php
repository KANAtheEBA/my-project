<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GamesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' =>fake()->text(15),
            'platform' =>fake()->text(10),
            'genre' =>fake()->text(10),
            'launch_date' =>fake()->date('Y/m/d'),
            'purchase_date' =>fake()->date('Y/m/d'),
            'developer' =>fake()->text(15),
            'publisher' =>fake()->text(15),
            'user_id' =>\App\Models\User::factory(),
        ];
    }
}
