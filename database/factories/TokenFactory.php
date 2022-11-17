<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class TokenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->realText(),
            'location' => json_encode([
                'ip' => fake()->localIpv4(),
                'country' => fake()->country(),
                'countryCode' => fake()->countryCode(),
                'region' => 'California',
                'timezone' => fake()->locale(),
                'latitude' => fake()->latitude(),
                'longitude' => fake()->longitude(),
            ]),
            ];
    }
}
