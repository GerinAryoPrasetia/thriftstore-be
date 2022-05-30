<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Seller extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = 'sellers';
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
