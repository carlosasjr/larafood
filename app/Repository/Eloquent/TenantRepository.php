<?php

namespace App\Repository\Eloquent;

use App\Models\Tenant;
use App\Repository\Contract\TenantRepositoryInterface;
use App\Tenant\Scopes\TenantScope;

class TenantRepository implements TenantRepositoryInterface
{

    /**
     * @var Tenant
     */
    private $entity;

    public function __construct(Tenant $tenant)
    {

        $this->entity = $tenant;
    }

    public function getAll(int $per_page)
    {
        return $this->entity->paginate($per_page);
    }

    public function getTenantByUuid(string $uuid)
    {
        return $this->entity->where('uuid', $uuid)->first();
    }


}

