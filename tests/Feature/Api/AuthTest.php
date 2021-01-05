<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * Error Auth
     *
     * @return void
     */
    public function testErrorAuth()
    {
        $response = $this->postJson('/api/auth/token');

        $response->assertStatus(422);
    }

    /**
     * Auth Invalid
     *
     * @return void
     */
    public function testAuthInvalid()
    {
        $payload = [
          'email' => 'invalid@invalid.com',
          'password' => 'invalid',
          'device_name' => 'invalid'
        ];

        $response = $this->postJson('/api/auth/token', $payload);

        $response->assertStatus(404)
                 ->assertExactJson([
                    'message' => trans('message.invalid_credentials')
                 ]);
    }

    /**
     * Auth
     *
     * @return void
     */
    public function testAuth()
    {
        $client = Client::factory()->create();

        $payload = [
            'email'         => $client->email,
            'password'      => 'password',
            'device_name'   => Str::random(10)
        ];

        $response = $this->postJson('/api/auth/token', $payload);
        $response->dump();

        $response->assertStatus(200)
            ->assertJsonStructure(['token']);
    }
}
