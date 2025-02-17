<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\User;
use App\Services\AuthService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\ClientRepository;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private string $password = "123123AbZ$";

    public function setUp(): void
    {
        parent::setUp();

        $url = config('app.url');

        $service = app(ClientRepository::class);
        $service->createPasswordGrantClient(null, 'Test Password Token', $url);
        $service->createPersonalAccessClient(null, 'Test Personal Token', $url);
    }

    public function testUserRegistration()
    {
        $input = User::factory()->make()->toArray();
        $input['password'] = $this->password;
        $input['password_confirmation'] = $this->password;

        $response = $this->json('POST', route('auth.register'), $input);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                   'user' => [
                       'id',
                       'email',
                       'created_at',
                       'updated_at',
                   ],
                    'token_type',
                    'access_token',
                    'expires_at'
                ],
                'status',
                'message',
                'success'
            ])
            ->assertJson([
                'success' => true,
            ]);
    }

    public function testUserLogin()
    {
        $input = (array)User::factory()->create([
            'password' => $this->password
        ])->only(['email']);

        $input['password'] = $this->password;

        $response = $this->json('POST', route('auth.login'), $input);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'user' => [
                        'id',
                        'email',
                        'created_at',
                        'updated_at',
                    ],
                    'token_type',
                    'access_token',
                    'expires_at'
                ],
                'status',
                'message',
                'success'
            ])
            ->assertJson([
                'success' => true,
            ]);
    }

    public function testUserLogout()
    {
        $auth = AuthService::login(User::factory()->create());

        $this->withHeaders([
            'Authorization' => $auth['token_type'] . ' ' . $auth['access_token'],
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ]);

        $response = $this->json('GET', route('auth.logout'));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data',
                'status',
                'message',
                'success'
            ])
            ->assertJson([
                'success' => true,
            ]);
    }

}
