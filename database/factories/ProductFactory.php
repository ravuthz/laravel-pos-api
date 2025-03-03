<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_id' => fake()->optional()->numberBetween(1, 100), // Nullable parent ID
            'name' => fake()->words(3, true), // Generates a product-like name
            'status' => fake()->randomElement([0, 1]), // Assuming status is active (1) or inactive (0)
            'thumbnail' => UploadedFile::fake()->image('thumbnail.jpg', 300, 300), // Simulated image with dimensions
            'sku' => fake()->unique()->bothify('SKU-###??'), // Generates SKU like SKU-123AB
            'barcode' => fake()->unique()->ean13(), // Generates a valid 13-digit barcode
            'excerpt' => fake()->sentence(10), // Short excerpt with 10 words
            'description' => fake()->paragraph(3), // More detailed description with 3 sentences
            'tax_id' => fake()->numberBetween(1, 10), // Assuming tax ID ranges from 1 to 10
            'type_id' => fake()->numberBetween(1, 5), // Assuming type ID ranges from 1 to 5
        ];
    }
}
