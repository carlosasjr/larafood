<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url', 'price', 'description'];

    public function details()
    {
        return $this->hasMany(PlanDetail::class);
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'plan_profile');
    }

    public function profilesAvailable($filter = null)
    {
        return Profile::whereNotIn('profiles.id', function ($query) {
            $query->select('plan_profile.profile_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.plan_id={$this->id}");
        })->when($filter, function ($queryFilter) use ($filter) {
            $queryFilter->where('profiles.name', 'LIKE', "%{$filter}%");
        })->get();
    }


    public function search($filter = null)
    {
        return $this->where('name', 'like', "%$filter%")
                    ->orWhere('description', 'like', "$filter")
                    ->paginate();
    }
}
