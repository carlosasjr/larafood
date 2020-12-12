<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class TableUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first();

        $tenant->users()->create([
           'name'    => 'Carlos A. Santos Júnior',
           'email'   => 'carlos@theplace.com.br',
           'password'=> bcrypt('pl4c32k')
        ]);
    }
}
