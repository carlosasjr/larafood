<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function search($filter)
    {
        return $this->where('name', 'like', "%$filter%")
                    ->OrWhere('description', 'like', "%$filter%")
                    ->latest()
                    ->paginate();

    }

    public function permissionsAvailable($filter = null)
    {
        return Permission::WhereNotIn('permissions.id', function ($query)  {
            $query->select('permission_role.permission_id');
            $query->from('permission_role');
            $query->whereRaw("permission_role.role_id = {$this->id}");
        })->when($filter, function ($queryFilter) use ($filter) {
            $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
        })->get();
    }


    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

}
