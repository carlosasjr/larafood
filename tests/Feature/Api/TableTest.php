<?php

namespace Tests\Feature\Api;

use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TableTest extends TestCase
{
    /**
     * Erro Get Tables by Tenant
     *
     * @return void
     */
    public function testErrorGetTablesByTenant()
    {
        $response = $this->getJson("/api/v1/tables");

        $response->assertStatus(422);
    }

    /**
     * Get Tables by Tenant
     *
     * @return void
     */
    public function testGetTablesByTenant()
    {
        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/tables?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }

    /**
     * Error Get Tables by Tenant
     *
     * @return void
     */
    public function testErrorTablesByTenant()
    {
        $tenant = Tenant::factory()->create();
        $table = 'fake_value';

        $response = $this->getJson("/api/v1/tables/{$table}?token_company={$tenant->uuid}");

        $response->assertStatus(404);
    }

    /**
     * Get Table by Tenant
     *
     * @return void
     */
    public function testGetTableByTenant()
    {
        $tenant = Tenant::factory()->create();
        $table = Table::factory()->create();

        $response = $this->getJson("/api/v1/tables/{$table->uuid}?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }
}
