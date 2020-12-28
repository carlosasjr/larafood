<?php

namespace App\Repository\Contract;

interface TenantRepositoryInterface
{
    public function getAll(int $per_page);
    public function getTenantByUuid(string $uuid);
}

