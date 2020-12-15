<?php

namespace App\Tenant;

use App\Models\Tenant;

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class ManagerTenant
{
    public function getTenantIdentify() : int
    {
        return auth()->user()->tenant_id;
    }

    public function getTenant() : Tenant
    {
        return auth()->user()->tenant;
    }

    public function isAdmin() : bool
    {
        return in_array(auth()->user()->email, config('tenant.admins'));
    }
}
