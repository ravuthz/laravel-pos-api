<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\User;
use App\Models\SettingType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Ravuthz\LaravelCrud\TestCrud;

class SettingTypeControllerTest extends TestCrud
{
    use RefreshDatabase;

    protected string $route = 'api/setting-types';

    protected function setUp(): void
    {
        parent::setUp();
        Passport::actingAs(User::factory()->create());

        SettingType::create([
            'name' => $this->faker->name(),
            'desc' => $this->faker->sentence(),
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
