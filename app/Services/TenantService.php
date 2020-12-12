<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\Tenant;
use Exception;
use Illuminate\Database\Eloquent\Model;

/**
 * TenantService.class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class TenantService
{
    /**
     * @var Plan
     */
    protected $plan;

    /**
     * @var array
     */
    protected $data;

    /**
     * @param Plan $plan
     * @param array $data
     * @return array
     * @throws Exception
     */
    public function make(Plan $plan, array $data)
    {
        $this->plan = $plan;
        $this->data = $data;

        try {
            $tenant = $this->storeTenant();
            $user = $this->storeUser($tenant);

            return [
                'success' => true,
                'user' => $user
            ];

        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => "Falha ao registrar-se! {$e->getMessage()} "
            ];
       }
    }

    /**
     * @return Model
     * @throws Exception
     */
    private function storeTenant()
    {
        $tenant = $this->plan->tenants()->create([
            'cnpj' => $this->data['cnpj'],
            'name' => $this->data['tenant'],
            'email' => $this->data['email'],
        ]);

        if (!$tenant) {
            throw new Exception('Falha ao criar o tenant');
        }

        return $tenant;
    }


    /**
     * @param Tenant $tenant
     * @return Model
     * @throws Exception
     */
    private function storeUser(Tenant $tenant)
    {
        $user = $tenant->users()->create([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => bcrypt($this->data['password']),
        ]);

        if (!$user) {
            throw new Exception('Falha ao criar o usuário');
        }

        return $user;
    }


}
