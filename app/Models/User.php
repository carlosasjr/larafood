<?php

namespace App\Models;

use App\Models\Traits\UserACLTrait;
use App\Tenant\Traits\TenantTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, UserACLTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tenant_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function rolesAvailable($filter = null)
    {
        return Role::WhereNotIn('roles.id', function ($query) {
           $query->select('role_user.role_id');
           $query->from('role_user');
           $query->whereRaw("role_user.user_id={$this->id}");
        })->when($filter, function ($queryFilter) use ($filter) {
            $queryFilter->where('name', 'like', "%{$filter}%");
        })->get();
    }



    public function scopeTenantUser($query)
    {
        return $query->where('tenant_id', auth()->user()->tenant_id);
    }

    public function search($filter)
    {
        return $this->where('name', 'like', "%{$filter}%")
                    ->orWhere('email', 'like', "%{$filter}%")
                    ->tenantUser()
                    ->paginate();
    }
}
