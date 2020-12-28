<?php

namespace App\Repository\Contract;

interface CategoryRepositoryInterface
{
    public function getCategoriesByTenantId(int $idTenant);
    public function getCategoryByUrl($url);

}

