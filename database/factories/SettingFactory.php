<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->name();

        return [
            'name' => $name,
            'code' => fake()->unique()->regexify('0[0-9]{5}'), // Ensures a unique 6-digit numeric code starting with 0
            'value' => strtoupper($name), // Converts the name to uppercase for consistency
        ];
    }
}
