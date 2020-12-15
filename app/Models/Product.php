<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = ['tenant_id', 'name', 'description', 'price', 'image', 'url'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


    public function search($filter)
    {
        return $this->where('name', 'like', "%{$filter}%")
            ->orWhere('description', 'like', "%{$filter}%")
            ->latest()
            ->paginate();
    }
}
