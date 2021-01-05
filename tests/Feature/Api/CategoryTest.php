<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * Erro Get Categories by Tenant
     *
     * @return void
     */
    public function testErrorGetCategoriesByTenant()
    {
        $response = $this->getJson("/api/v1/categories");

        $response->assertStatus(422);
    }

    /**
     * Get Categories by Tenant
     *
     * @return void
     */
    public function testGetCategoriesByTenant()
    {
        $tenant = Tenant::factory()->create();

        $response = $this->getJson("/api/v1/categories?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }

    /**
     * Error Get Category by Tenant
     *
     * @return void
     */
    public function testErrorCategoryByTenant()
    {
        $tenant = Tenant::factory()->create();
        $category = 'fake_value';

        $response = $this->getJson("/api/v1/categories/{$category}?token_company={$tenant->uuid}");

        $response->assertStatus(404);
    }

    /**
     * Get Category by Tenant
     *
     * @return void
     */
    public function testGetCategoryByTenant()
    {
        $tenant = Tenant::factory()->create();
        $category = Category::factory()->create();

        $response = $this->getJson("/api/v1/categories/{$category->uuid}?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }
}
