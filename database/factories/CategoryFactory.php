<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_id' => fake()->optional()->numberBetween(1, 100), // Nullable parent category ID
            'name' => fake()->company(), // More suitable for a category name
            'status' => fake()->randomElement([0, 1]), // Ensures status is either active (1) or inactive (0)
            'thumbnail' => UploadedFile::fake()->image('thumbnail.jpg', 300, 300), // Simulated image with dimensions
            'phone' => fake()->regexify('0[1,6-9]{1}[0-9]{1}-[0-9]{3}-[0-9]{3,4}'), // Valid phone number pattern
            'address' => fake()->streetAddress(), // Generates a shorter, realistic street address
            'excerpt' => fake()->sentence(10), // Short and meaningful excerpt
            'description' => fake()->paragraph(3), // More structured description
        ];
    }
}
