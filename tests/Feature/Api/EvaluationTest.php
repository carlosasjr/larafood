<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class EvaluationTest extends TestCase
{
    /**
     * Error Create New Evaluation Order
     *
     * @return void
     */
    public function testErrorCreateNewEvaluationOrder()
    {
        $order = 'fake_value';

        $response = $this->postJson("/api/v1/auth/orders/{$order}/evaluations");

        $response->assertStatus(401);
    }


    /**
     * Create New Evaluation Order
     *
     * @return void
     */
    public function testCreateNewEvaluationOrder()
    {
        $client = Client::factory()->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;

        $order = Order::factory()->create(
            [
                'client_id' => $client->id
            ]
        );

        $payload = [
            'stars' => 5,
        ];

        $header = [
            'Authorization' => "Bearer {$token}"
        ];

        $response = $this->postJson("/api/v1/auth/orders/{$order->identify}/evaluations", $payload, $header);

        $response->assertStatus(201);
    }
}
