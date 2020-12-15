<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory, TenantTrait;

    protected $fillable = [
        'tenant_id',
        'uuid',
        'identify',
        'description'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function search($filter)
    {
        return $this->where('identify', 'like', "%{$filter}%")
            ->orWhere('description', 'like', "%{$filter}%")
            ->latest()
            ->paginate();
    }
}
