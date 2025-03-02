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
            'parent_id' => fake()->randomDigit(),
            'name' => fake()->name(),
            'status' => fake()->randomDigit(),
//            'thumbnail' => fake()->imageUrl(640, 480, 'shop', true, 'Faker'),
//            'thumbnail' => fake()->image(storage_path('app/stores'),640,480, null, true),
//            'thumbnail' => fake()->image(storage_path('app/public/images'),640,480, 'shop', false),
            'thumbnail' => UploadedFile::fake()->image('thumbnail.jpg'),
            'phone' => fake()->regexify('0[1,6-9]{1}[0-9]{1}-[0-9]{3}-[0-9]{3,4}'),
            'address' => fake()->address(),
            'description' => fake()->text(),
        ];
    }
}
