<?php

namespace App\Models\Traits;

trait UserACLTrait
{
    public function permissions()
    {
        $tenant = $this->tenant;
        $plan = $tenant->plan;

        $permissions = [];

        foreach ($plan->profiles as $profile) {
            $permissions = $this->getPermissionsOfProfile($profile, $permissions);
        }

        return $permissions;
    }

    /**
     * @param $profile
     * @param array $permissions
     * @return array
     */
    private function getPermissionsOfProfile($profile, array $permissions): array
    {
        foreach ($profile->permissions as $permission) {
            array_push($permissions, $permission->name);
        }

        return $permissions;
    }
}

