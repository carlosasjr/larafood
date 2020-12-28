<?php

namespace App\Services;

use App\Repository\Contract\TableRepositoryInterface;
use App\Repository\Contract\TenantRepositoryInterface;

class TableService
{
    /**
     * @var TableRepositoryInterface
     */
    private $tableRepository;
    /**
     * @var TenantRepositoryInterface
     */
    private $tenantRepository;

    public function __construct(TableRepositoryInterface $tableRepository,
TenantRepositoryInterface $tenantRepository)
    {

        $this->tableRepository = $tableRepository;
        $this->tenantRepository = $tenantRepository;
    }

    public function getTablesByTenantUuid(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);

        return $this->tableRepository->getTablesByTenantId($tenant->id);
    }

    public function getTableByUuid(string $Uuid)
    {
        return $this->tableRepository->getTableByUuid($Uuid);
    }
}
