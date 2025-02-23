<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
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
            'username' => fake()->unique()->username(),
            'password' => $password,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'phone' => fake()->regexify('0[1,6-9]{1}[0-9]{1}-[0-9]{3}-[0-9]{3,4}'),
            'avatar' => fake()->imageUrl(640, 480, 'human', true, 'Faker'),
            'salary' => fake()->randomFloat(),
            'address' => fake()->address(),
            'shop_name' => fake()->name,
            'bank_name' => fake()->name,
            'account_holder' => $fullName,
            'account_number' => fake()->numerify('###-###-###-###'),
            'type_code' => fake()->regexify('0[0-9]{5}'),
            'position_code' => fake()->regexify('0[0-9]{5}'),
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
