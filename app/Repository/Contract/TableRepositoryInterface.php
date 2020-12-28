<?php

namespace App\Repository\Contract;

interface TableRepositoryInterface
{
    public function getTablesByTenantId(int $idTenant);
    public function getTableByUuid(string $Uuid);

}

