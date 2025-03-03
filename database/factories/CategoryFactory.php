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
            'parent_id' => fake()->randomDigit(),
            'name' => fake()->name(),
            'status' => fake()->randomDigit(),
            'thumbnail' => UploadedFile::fake()->image('thumbnail.jpg'),
            'phone' => fake()->regexify('0[1,6-9]{1}[0-9]{1}-[0-9]{3}-[0-9]{3,4}'),
            'address' => fake()->address(),
            'excerpt' => fake()->text(),
            'description' => fake()->text()
        ];
    }
}
