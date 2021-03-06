<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAllProducts()
    {
        return Product::all();
    }

    public function searchProduct($product_name)
    {
        return Product::where('product_name', 'like', '%' . $product_name . '%')->get();
    }
}
