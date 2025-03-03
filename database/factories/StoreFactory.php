<?php

namespace Database\Factories;

use App\Helpers\MyFake;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_id' => fake()->optional()->numberBetween(1, 100), // Allows null values for top-level stores
            'name' => fake()->company(), // More appropriate for store names
            'status' => fake()->randomElement([0, 1]), // Ensures status is either active (1) or inactive (0)
            'thumbnail' => UploadedFile::fake()->image('thumbnail.jpg', 640, 480), // Generates a fake image with given dimensions
            'phone' => fake()->regexify('0[1,6-9][0-9]-[0-9]{3}-[0-9]{3,4}'), // Valid phone number format
            'address' => fake()->streetAddress(), // More realistic address format
            'description' => fake()->paragraph(3), // Structured store description
        ];
    }
}
