<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class TablePlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
           'name'           => 'Trial',
           'description'    => 'Plano de teste de 30 dias',
           'price'          => 0.00,
        ]);
    }
}
