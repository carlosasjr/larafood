<?php

namespace App\Tenant\Observers;

use App\Tenant\ManagerTenant;
use Illuminate\Database\Eloquent\Model;

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class TenantObserver
{
    /**
     * @param Model $model
     */
    public function creating(Model $model)
    {
        $managerTenant = app(ManagerTenant::class);

        $model->tenant_id = $managerTenant->getTenantIdentify();
    }

}