<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'plan_profile');
    }

    public function permissionsAvailable($filter = null)
    {
        return Permission::WhereNotIn('permissions.id', function ($query)  {
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id = {$this->id}");
        })->when($filter, function ($queryFilter) use ($filter) {
                $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
        })->get();
    }


    public function search($filter)
    {
        return $this->where('name', 'like', "%{$filter}%")
                    ->orWhere('description', 'like', "%{$filter}%")
                    ->paginate();
    }
}
