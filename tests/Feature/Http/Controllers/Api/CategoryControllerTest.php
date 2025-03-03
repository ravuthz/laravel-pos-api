<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\User;
use App\Models\Category;
use App\Traits\HasCrudTest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;
    use HasCrudTest;

    protected string $route = 'api/categories';

    protected function setUp(): void
    {
        parent::setUp();
        Passport::actingAs(User::factory()->create());
        Category::factory(5)->create();
    }

    public function requestPayload($id = null): array
    {
        $payload = User::factory()->make()->toArray();

        return [
            'id' => $id,
            ...$payload
        ];
    }

    public function test_store(): void
    {
        $res = $this->postJson($this->requestRoute(), $this->requestPayload());
        $res->assertStatus(200);
    }
}
