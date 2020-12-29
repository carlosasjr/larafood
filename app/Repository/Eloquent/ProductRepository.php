<?php

namespace App\Repository\Eloquent;

use App\Models\Product;
use App\Repository\Contract\ProductRepositoryInterface;
use App\Tenant\Scopes\TenantScope;

class ProductRepository implements ProductRepositoryInterface
{
    private $entity;

    public function __construct(Product $product)
    {
        $this->entity = $product;
    }

    public function getProductsByTenantId(int $tenantID, array $filterCategories)
    {
        return $this->entity
                    ->where('tenant_id', $tenantID)
                    ->where(function ($query) use ($filterCategories) {
                        if ($filterCategories != []) {
                            $query->whereHas('categories', function ($queryCat) use ($filterCategories) {
                                $queryCat->withoutGlobalScope(new TenantScope());
                                $queryCat->whereIn('categories.url', $filterCategories);
                            });
                        }
                    })
                    ->withoutGlobalScope(new TenantScope())
                    ->get();
    }

    public function getProductByUrl(string $url)
    {
        return $this->entity
                    ->withoutGlobalScope(new TenantScope())
                    ->where('url', $url)
                    ->first();
    }
}
