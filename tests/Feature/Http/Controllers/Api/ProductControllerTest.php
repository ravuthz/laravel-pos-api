<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\User;
use App\Models\Product;
use App\Traits\HasCrudTest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;
    use HasCrudTest;

    protected string $route = 'api/products';

    protected function setUp(): void
    {
        parent::setUp();
        Passport::actingAs(User::factory()->create());
        Product::factory(5)->create();
    }

    public function requestPayload($id = null): array
    {
        $payload = Product::factory()->make()->toArray();

        return [
            'id' => $id,
            ...$payload
        ];
    }
}
