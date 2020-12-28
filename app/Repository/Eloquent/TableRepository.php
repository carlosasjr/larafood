<?php

namespace App\Repository\Eloquent;

use App\Repository\Contract\TableRepositoryInterface;
use App\Models\Table;
use App\Tenant\Scopes\TenantScope;

class TableRepository implements TableRepositoryInterface
{

    /**
     * @var Table
     */
    private $entity;

    public function __construct(Table $table)
    {

        $this->entity = $table;
    }

    public function getTablesByTenantId(int $idTenant)
    {
        return $this->entity
            ->where('tenant_id', $idTenant)
            ->withoutGlobalScope(new TenantScope())
            ->get();
    }

    public function getTableByUuid(string $Uuid)
    {
        return $this->entity
                    ->withoutGlobalScope(new TenantScope())
                    ->where('uuid', $Uuid)
                    ->first();

    }
}
