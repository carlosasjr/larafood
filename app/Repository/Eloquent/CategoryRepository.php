<?php

namespace App\Repository\Eloquent;

use App\Models\Category;
use App\Repository\Contract\CategoryRepositoryInterface;
use App\Tenant\Scopes\TenantScope;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @var Category
     */
    private $entity;

    public function __construct(Category $category)
    {
        $this->entity = $category;
    }

    public function getCategoriesByTenantId(int $idTenant)
    {
        return $this->entity
            ->where('tenant_id', $idTenant)
            ->withoutGlobalScope(new TenantScope())
            ->get();
    }

    public function getCategoryByUuid(string $uuid)
    {
        return $this->entity
            ->where('uuid', $uuid)
            ->withoutGlobalScope(new TenantScope())
            ->first();
    }
}

