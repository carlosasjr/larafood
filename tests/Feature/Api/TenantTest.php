<?php

namespace Tests\Feature\Api;

use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TenantTest extends TestCase
{
    /**
     * Test Get All Tenants.
     *
     * @return void
     */
    public function testGetAllTenants()
    {
        Tenant::factory()->count(10)->create();

        $response = $this->getJson('/api/v1/tenants');

        $response->assertStatus(200)
                 ->assertJsonCount(10, 'data');
    }

    /**
     * Test Error Get Tenant.
     *
     * @return void
     */
    public function testErrorGetTenant()
    {
        $identify = 'faker_value';

        $response = $this->getJson("/api/v1/tenants/{$identify}");

        $response->assertStatus(404);
    }

    /**
     * Test Get Tenant by Identify.
     *
     * @return void
     */
    public function testGetTenantByIdentify()
    {
        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/tenants/{$tenant->uuid}");

        $response->assertStatus(200);
    }

}
