<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fullName = fake()->firstName . ' ' . fake()->lastName;
        $password = static::$password ??= Hash::make('password');

        return [
            'name' => $fullName,
            'email' => fake()->unique()->safeEmail(),
            'username' => fake()->unique()->userName(), // Ensures unique usernames
            'password' => $password, // Ensure this is properly hashed in seeding
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'phone' => fake()->regexify('0[1,6-9][0-9]-[0-9]{3}-[0-9]{3,4}'), // Improved regex formatting
            'avatar' => UploadedFile::fake()->image('avatar.jpg', 300, 300), // More realistic avatar dimensions
            'salary' => fake()->randomFloat(2, 3000, 15000), // Defines salary range with 2 decimal places
            'address' => fake()->streetAddress(), // Shorter and more structured address
            'shop_name' => fake()->company(), // More relevant for shop names
            'bank_name' => fake()->company(), // Uses company name for a more realistic bank name
            'account_holder' => $fullName,
            'account_number' => fake()->bankAccountNumber(), // Generates a valid-looking bank account number
            'type_code' => fake()->regexify('0[0-9]{5}'), // Keeps the type code format
            'position_code' => fake()->regexify('0[0-9]{5}'), // Keeps the position code format
        ];

    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
