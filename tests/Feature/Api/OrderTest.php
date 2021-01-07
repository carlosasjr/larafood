<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * Error of Validation.
     *
     * @return void
     */
    public function testErrorOfValidation()
    {
        $payload = [];

        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(422)
            ->assertJsonPath('errors.token_company', [
                trans('validation.required', ['attribute' => 'token company'])
            ])
            ->assertJsonPath('errors.products', [
                trans('validation.required', ['attribute' => 'products'])
            ]);
    }

    /**
     * Create New Order
     *
     * @return void
     */
    public function testCreateNewOrder()
    {
        $tenant = Tenant::factory()->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'products' => []
        ];

        $products = Product::factory(2)->create();

        foreach ($products as $product) {
            array_push($payload['products'], [
               'identify' => $product->uuid,
               'qty' => 2
            ]);
        }

        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(201);
    }

    /**
     * Create New Order with Table
     *
     * @return void
     */
    public function testCreateNewOrderWithTable()
    {
        $tenant = Tenant::factory()->create();
        $table = Table::factory()->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'table' => $table->uuid,
            'products' => []
        ];

        $products = Product::factory(2)->create();

        foreach ($products as $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 2
            ]);
        }

        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(201);
    }



    /**
     * Total Order
     *
     * @return void
     */
    public function testTotalOrder()
    {
        $tenant = Tenant::factory()->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'products' => []
        ];

        $products = Product::factory(2)->create();

        foreach ($products as $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 1
            ]);
        }

        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(201)
            ->assertJsonPath('data.total', 23.8);
    }

    /**
     * Error Get Order by Identify
     *
     * @return void
     */
    public function testErrorGetOrderByIdentify()
    {
        $identify = 'fake_value';

        $response = $this->getJson("/api/v1/orders/{$identify}");

        $response->assertStatus(404);
    }

    /**
     * Get Order by Identify
     *
     * @return void
     */
    public function testGetOrderByIdentify()
    {
        $order = Order::factory()->create();

        $response = $this->getJson("/api/v1/orders/{$order->identify}");

        $response->assertStatus(200);
    }

    /**
     * Create New Order Authenticated
     *
     * @return void
     */
    public function testCreateNewOrderAuthenticated()
    {
        $tenant = Tenant::factory()->create();
        $client = Client::factory()->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;

        $payload = [
            'token_company' => $tenant->uuid,
            'products' => []
        ];

        $products = Product::factory(2)->create();

        foreach ($products as $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 2
            ]);
        }

        $response = $this->postJson('/api/v1/auth/orders', $payload, [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(201);
    }

    /**
     * Get My Orders
     *
     * @return void
     */

    public function testGetMyOrders()
    {
        $client = Client::factory()->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;

        Order::factory(2)->create(
            [
                'client_id' => $client->id
            ]
        );

        $response = $this->getJson("/api/v1/auth/my-orders", [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200)
                    ->assertJsonCount(2, 'data');
    }


}
