<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\User;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Ravuthz\LaravelCrud\TestCrud;

class StoreControllerTest extends TestCrud
{
    use RefreshDatabase;

    protected string $route = 'api/stores';

    protected function setUp(): void
    {
        parent::setUp();
        Passport::actingAs(User::factory()->create());
        Store::factory()->create();
    }

    public function requestPayload($id = null): array
    {
        $parent  = Store::factory()->create();
        $payload = Store::factory()->make([
            'parent_id' => $parent->id,
        ])->toArray();

        return [
            'id' => $id,
            ...$payload
        ];
    }
}
