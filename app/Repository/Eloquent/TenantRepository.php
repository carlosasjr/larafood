<?php

namespace App\Repository\Eloquent;

use App\Models\Tenant;
use App\Repository\Contract\TenantRepositoryInterface;

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

    public function getAll()
    {
        return $this->entity->get();
    }
}

