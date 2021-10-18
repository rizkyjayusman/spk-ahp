<?php

namespace App\Repositories;

use App\Product;

class ProductRepository
{
    public function __construct()
    {
    }

    public function create($request = [])
    {
        return Product::create($request);
    }

    public function getProductList()
    {
        return Product::where('status', true)->get();
    }

    public function getProductById($id)
    {
        return Product::where('id', $id)->first();
    }
}
