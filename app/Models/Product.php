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

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }


    public function categoriesAvailable($filter = null)
    {
        return Category::whereNotIn('categories.id', function ($query) {
            $query->select('category_product.category_id');
            $query->from('category_product');
            $query->whereRaw("category_product.product_id={$this->id}");
        })->when($filter, function ($queryFilter) use ($filter) {
            $queryFilter->where('name', 'like', "%{$filter}%");
        })->get();
    }

    public function search($filter)
    {
        return $this->where('name', 'like', "%{$filter}%")
                    ->orWhere('description', 'like', "%{$filter}%")
                    ->latest()
                    ->paginate();
    }
}
