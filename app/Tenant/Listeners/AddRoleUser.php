<?php

namespace App\Tenant\Listeners;

use App\Models\Role;
use App\Tenant\Events\TenantCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddRoleUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param TenantCreated $event
     * @return void
     */
    public function handle(TenantCreated $event)
    {
        if (!$role = Role::first()) {
            return;
        }

        $user = $event->user();

        $user->roles()->attach($role);

        return 1;
    }
}
