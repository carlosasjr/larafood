<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * Error Create New Client.
     *
     * @return void
     */
    public function testErrorCreateNewClient()
    {
        $payload = [
            'name'  => 'Carlos Client',
            'email' =>  'carlos@client.com.br'
        ];

        $response = $this->postJson('/api/auth/register', $payload);

        $response->assertStatus(422);
    }

    /**
     * Create New Client.
     *
     * @return void
     */
    public function testCreateNewClient()
    {
        $payload = [
            'name'  => 'Carlos Client',
            'email' =>  'carlos@client.com.br',
            'password' => '12345678'
        ];

        $response = $this->postJson('/api/auth/register', $payload);

        $response->assertStatus(201)
                 ->assertExactJson(
                     [
                         'data' => [
                             'name' => $payload['name'],
                             'email' => $payload['email']
                         ]
                     ]
                 );
    }
}
