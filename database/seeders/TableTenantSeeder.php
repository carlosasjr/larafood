<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;


class TableTenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();

        $plan->tenants()->create([
            'cnpj' => '23882706000120',
            'name' => 'SoftPro Sistemas',
            'email' => 'carlos@theplace.com.br',
        ]);
    }
}
