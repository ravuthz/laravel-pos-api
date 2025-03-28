<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Ravuthz\LaravelCrud\TestCrud;

class UserControllerTest extends TestCrud
{
    use RefreshDatabase;

    protected string $route = 'api/users';

    protected function setUp(): void
    {
        parent::setUp();
        Passport::actingAs(User::factory()->create());
        User::factory(20)->create();
    }

    public function requestPayload($id = null): array
    {
        $payload = User::factory()->make()->toArray();
        $password = '123123123';

        return [
            'id' => $id,
            'password' => $password,
            'password_confirmation' => $password,
            ...$payload
        ];
    }
}
