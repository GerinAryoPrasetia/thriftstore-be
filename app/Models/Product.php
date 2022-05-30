<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $tables = 'products';
    protected $fillable = [
        'product_name',
        'size',
        'price',
        'sold_number',
        'rating',
        'image',
        'description'
    ];

    public function seller()
    {
        return $this->belongsTo('App\Models\Seller');
    }
}
