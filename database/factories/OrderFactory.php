<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Order;
use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tenant_id' => Tenant::factory(),
            'client_id' => Client::factory(),
            'table_id' => Table::factory(),
            'identify' => uniqid() . Str::random(10),
            'total' => 80.0,
            'status' => 'open',
            'comment' => $this->faker->sentence

        ];
    }
}
