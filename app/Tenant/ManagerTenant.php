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
    public function getTenantIdentify()
    {
        return ($this->isAuthenticated()) ? auth()->user()->tenant_id : '';
    }

    public function getTenant()
    {
        return ($this->isAuthenticated()) ? auth()->user()->tenant : '';
    }

    public function isAdmin() : bool
    {
        return in_array(auth()->user()->email, config('tenant.admins'));
    }

    /**
     * @return bool
     */
    private function isAuthenticated(): bool
    {
        return auth()->check();
    }
}
