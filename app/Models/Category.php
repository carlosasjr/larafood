<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = ['name', 'description', 'tenant_id'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function search($filter)
    {
        return $this->where('name', 'like', "%{$filter}%")
                    ->orWhere('description', 'like', "%{$filter}%")
                    ->latest()
                    ->paginate();
    }
}
