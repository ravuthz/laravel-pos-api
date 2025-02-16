<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Ravuthz\LaravelCrud\TestCrud;

class SettingControllerTest extends TestCrud
{
    protected string $route = 'api/settings';

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Passport::actingAs(User::factory()->create());

        Setting::create([
            'name' => $this->faker->name(),
            'desc' => $this->faker->sentence(),
            'value' => $this->faker->randomNumber(),
            'options' => [
                [
                    'key' => 'S',
                    'value' => 1,
                ],
                [
                    'key' => 'M',
                    'value' => 2,
                ],
                [
                    'key' => 'L',
                    'value' => 3,
                ]
            ]
        ]);
    }

    public function requestPayload($id = null): array
    {
        // $time = now()->format('Y-m-d_H:m:s.u');
        // some related data, attachment with some unique value with time here

        return [
            'id' => $id,
            'name' => $this->faker->name(),
            'desc' => $this->faker->sentence(),
        ];
    }
}
