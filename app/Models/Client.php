<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
    ];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    public function evaluations()
    {
        return $this->hasMany(OrderEvaluation::class);
    }

}
