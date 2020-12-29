<?php

namespace App\Repository\Contract;

interface ProductRepositoryInterface
{
    public function getProductsByTenantId(int $tenantID, array $filterCategories);
    public function getProductByUuid(string $uuid);
}

