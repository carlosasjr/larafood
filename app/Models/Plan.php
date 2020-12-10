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

    public function search($filter = null)
    {
        return $this->where('name', 'like', "%$filter%")
                    ->orWhere('description', 'like', "$filter")
                    ->paginate();
    }
}
