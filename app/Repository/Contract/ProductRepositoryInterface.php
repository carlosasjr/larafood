<?php

namespace App\Repository\Contract;

interface ProductRepositoryInterface
{
    public function getProductsByTenantId(int $tenantID, array $filterCategories);
    public function getProductByUrl(string $url);
}

