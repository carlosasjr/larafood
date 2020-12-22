<?php

namespace App\Models\Traits;

use App\Models\Tenant;

trait UserACLTrait
{

    public function permissions(): array
    {
        $permissionsPlan = $this->permissionsPlan();
        $permissionsRole = $this->permissionsRole();

        return array_intersect($permissionsRole, $permissionsPlan);
    }

    private function permissionsRole(): array
    {
        $roles = $this->roles()->with('permissions')->get();

        $permissions = [];

        foreach ($roles as $role) {
            $permissions = $this->getPermissionsOfRoles($role, $permissions);
        }

        return $permissions;
    }

    /**
     * @param $role
     * @param array $permissions
     * @return array
     */
    private function getPermissionsOfRoles($role, array $permissions): array
    {
        foreach ($role->permissions as $permission) {
            array_push($permissions, $permission->name);
        }
        return $permissions;
    }

    private function permissionsPlan(): array
    {
        $tenant = Tenant::with('plan.profiles.permissions')
            ->where('id', $this->tenant_id)
            ->first();
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

    public function hasPermission(string $permission): bool
    {
        return in_array($permission, $this->permissions());
    }

    public function isAdmin(): bool
    {
        return in_array($this->email, config('tenant.admins'));
    }


}

