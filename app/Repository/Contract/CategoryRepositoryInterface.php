<?php

namespace App\Repository\Contract;

interface CategoryRepositoryInterface
{
    public function getCategoriesByTenantId(int $idTenant);
    public function getCategoryByUuid(string $uuid);

}

